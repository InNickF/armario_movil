<?php

namespace App\Http\Controllers\Account;

use App\Models\Coupon;

use App\Models\Address;
use App\Models\CartModel;
use Laracasts\Flash\Flash;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\SubscribedToCloset;
use App\Mail\SubscribedToRopero;
use App\Mail\SubscribedToArmario;
use App\Services\PaymentezService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Rinvex\Subscriptions\Models\Plan;
use App\Http\Controllers\AppBaseController;

class PlanController extends \App\Http\Controllers\Controller
{
   public function index()
   {
      $planArmario = app('rinvex.subscriptions.plan')->whereSlug('armario')->first();
      $planCloset = app('rinvex.subscriptions.plan')->whereSlug('closet')->first();
      $planRopero = app('rinvex.subscriptions.plan')->whereSlug('ropero')->first();


      return view('account.plans.index', compact('planArmario', 'planCloset', 'planRopero'));
   }


   public function store(Request $request)
   {
      $plan = app('rinvex.subscriptions.plan')->find($request->plan_id);
      Auth::user()->newSubscription('main', $plan);
      $plans = app('rinvex.subscriptions.plan')->all();
      return view('account.plans.index', compact('plans'));
   }


   public function show($id)
   {
      $plan = app('rinvex.subscriptions.plan')->find($id);

      if (auth()->user()->subscribedTo($id)) {
         alert()->error('Ya tienes el plan seleccionado');
         return redirect('/account/plans');
      }

      // if (auth()->user()->subscription('main')->plan_id > $id) {
      //    dalert()->error('No puedes cambiar a un plan de menor categoría');
      //    return redirect('/account/plans');
      // }

      return view('account.plans.show', compact('plan'));
   }


   public function checkout($planId)
   {
      $plan = app('rinvex.subscriptions.plan')->find($planId);
      if (!$plan) {
         alert()->error('No se ha encontrado el plan');
         return redirect(url('account/plans'));
      }

      if (!auth()->user()->canUpgradeToPlan($plan)) {
         alert()->error('No se puede actualizar el producto al plan seleccionado');
         return redirect(url('account/plans'));
      }

      $couponCode = request()->get('coupon');
      $coupon = null;

      if ($couponCode) {
         $coupon = Coupon::whereCode($couponCode)->first();
         if (!$coupon) {
            alert()->error('No se ha encontrado el cupón');
            return back();
         }

         if (!$coupon->isValid('plans')) {
            alert()->error('El cupón no es válido');
            return back();
         }

         // If is specific plan only
         if ($coupon->plans()->count()) {
            // dd($planId);
            // dd($coupon->plans);
            if (!$coupon->plans->firstWhere('id', $planId)) {
               alert()->error('El cupón no es válido para el plan seleccionado');
               return back();
            }
         }

         $plan->discount = $coupon->getCalculatedDiscountValue($plan->price); // Change but dont save
         $plan->price = max($plan->price - $plan->discount, 0); // Change but dont save
      }

      return view('plans.pay', compact('plan', 'coupon'));
   }


   public function pay(Request $request)
   {
      $input = $request->all();
      $plan = app('rinvex.subscriptions.plan')->find($input['plan_id']);

      if (!$plan) {
         alert()->error('No se ha encontrado el plan');
         return redirect(url('account/plans'));
      }

      if (!auth()->user()->canUpgradeToPlan($plan)) {
         alert()->error('No se puede actualizar el producto al plan seleccionado');
         return redirect(url('account/plans'));
      }

      $card_token = request()->get('token');

      if (!$card_token) {
         alert()->error('Error al procesar pago.');
         return redirect(url('account/plans'));
      }

      $coupon = null;
      if ($input['coupon_id']) {
         $coupon = Coupon::find($input['coupon_id']);
         if (!$coupon) {
            alert()->error('No se ha encontrado el cupón');
            return redirect(url('account/plans'));
         }
      }

      $transaction = auth()->user()->payPlanSubscription($input['token'], $plan, $coupon);

      if (isset($transaction['error'])) {
         alert()->error($transaction['error']);
         \Log::error($transaction['error']);
         return redirect(url('account/plans/'));
      }

      // Get the first not cancelled subscription
      $subscription = app('rinvex.subscriptions.plan_subscription')
         ->where('user_type', 'App\User')
         ->where('user_id', auth()->user()->id)
         ->where('name->es', 'main')
         ->whereNull('canceled_at')
         ->first();

      if ($subscription) {
         $subscription->changePlan($plan);
      } else {
         $subscription = auth()->user()->newSubscription('main', $plan);
      }

      $transaction->content_id = $subscription->id;
      $transaction->save();


      if ($plan->slug == 'armario') {
         Mail::to(auth()->user())->send(new SubscribedToArmario(auth()->user()));
      } else if ($plan->slug == 'closet') {
         Mail::to(auth()->user())->send(new SubscribedToCloset(auth()->user()));
      } else if ($plan->slug == 'ropero') {
         Mail::to(auth()->user())->send(new SubscribedToRopero(auth()->user()));
      }


      alert()->success('Has realizado tu nueva suscripción al plan ' . $plan->name . " exitosamente");
      return redirect(url('account/subscription/bill'));
   }




   public function bill()
   {
      $subscription = app('rinvex.subscriptions.plan_subscription')
         ->where('user_type', 'App\User')
         ->where('user_id', auth()->user()->id)
         ->where('name->es', 'main')
         ->whereNull('canceled_at')
         ->latest()
         ->first();

      if (!$subscription) {
         alert()->error('No se ha encontrado la suscripción');
         return redirect(url('account/plans'));
      }

      // * A transaction must exist and have NULL billing_document_id
      $transaction = Transaction::where('is_refund', false)->where('content_type', 'plan_subscription')->where('content_id', $subscription->id)->latest()->first();

      if (!$transaction) {
         alert()->error('No se ha encontrado la transacción para generar una factura');
         return redirect(url('account/subscription/pay'));
      }

      //  If is paid but and has bill
      if ($transaction->billing_document_id != null) {
         alert()->error('Ya se ha facturado tu suscripción');
         return redirect(url('account/plans'));
      }

      if ($transaction->transaction_id == null) {
         alert()->error('No requiere generar factura');
         return redirect(url('account/subscription/pay'));
      }

      return view('plans.bill', compact('subscription', 'transaction'));
   }



   public function generateBill(Request $request)
   {


      $isConsumidorFinal = request('is_consumidor_final');
      $address = null;

      if (!$isConsumidorFinal) {
         $address = Address::find(request('address_id'));
         if (!$address) {
            alert()->error('No se ha completado los datos de facturación');
            return redirect(url('account/subscription/bill'));
         }
      }

      $subscription = app('rinvex.subscriptions.plan_subscription')
         ->where('user_type', 'App\User')
         ->where('user_id', auth()->user()->id)
         ->where('name->es', 'main')
         ->whereNull('canceled_at')
         ->latest()
         ->first();


      if (!$subscription) {
         alert()->error('No se ha encontrado la suscripción');
         return redirect(url('account/plans'));
      }

      // * A transaction must exist and have NULL billing_document_id
      $transaction = Transaction::where('is_refund', false)->where('content_type', 'plan_subscription')->where('content_id', $subscription->id)->latest()->first();

      if (!$transaction) {
         alert()->error('No se ha encontrado la transacción para generar una factura');
         return redirect(url('account/subscription/pay'));
      }

      //  If has bill
      if ($transaction->billing_document_id != null) {
         alert()->error('Ya se ha facturado tu suscripción');
         return redirect(url('account/plans'));
      }

      if ($transaction->transaction_id == null) {
         alert()->error('No requiere generar factura');
         return redirect(url('account/subscription/pay'));
      }


      $factura = auth()->user()->generateBill($address ?? null, $transaction);
      if (isset($factura['error'])) {
         alert()->error('Error al generar factura: ' . $factura['error']);
         return redirect(url('account/subscription/bill'));
      }

      if ($address) {
         $transaction->address_id = $address->id;
         $transaction->save();
      }

      alert()->success('Se ha generado la factura exitosamente');
      return redirect(url('account/plans'));
   }



   public function cancel()
   {
      $user = auth()->user();
      if (!$user->getSubscription()) {
         alert()->error('No tienes ninguna suscripción activa para cancelar');
         return redirect(url('account/plans/'));
      }
      // dd($user->getSubscription()->toArray());

      $user->getSubscription()->cancel();
      alert()->success('Se ha cancelado tu plan exitosamente');
      return redirect('account/plans');
   }
}
