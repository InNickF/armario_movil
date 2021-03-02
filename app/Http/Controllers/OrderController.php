<?php

namespace App\Http\Controllers;

use SEO;
use App\Models\Order;
use App\Models\Address;
use App\Models\Category;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {

        SEO::setTitle('Carrito de compras');
        SEO::setDescription('Carrito de compras');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');


        $isLoggedIn = Auth::check();
        $user = Auth::user();
        $continueToStep = request()->has('step') ? request()->get('step') : 1;
        $categories = Category::orderBy('order', 'asc')->where('parent_id', null)->get()->take(4);
        return view('checkout.index', compact('isLoggedIn', 'continueToStep', 'categories', 'user'));
    }

    public function cards($orderId)
    {

        SEO::setTitle('Checkout');
        SEO::setDescription('Pago de pedido');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');



        $order = Order::find($orderId);
        $categories = Category::orderBy('order', 'asc')->where('parent_id', null)->get()->take(4);

        if (!$order) {
            alert()->error('No se ha encontrado el pedido');
            return back();
        }

        if ($order->user_id != Auth::user()->id) {
            alert()->error('No tienes permiso para ver esto');
            return back();
        }

        if ($order->status->slug != 'new' && $order->status->slug != 'pending') {
            if ($order->status->slug == 'billing') {
                alert()->success('El pedido ha sido pagado, ingresa tus datos de facturación');
                return redirect(url('bill/' . $order->id));
            } else {
                alert()->error('Este pedido ya ha sido pagado y facturado');
                return redirect(url('account/orders'));
            }
        }


        if (!$order->productsHaveStock()) {
            alert()->info('No se puede realizar el pago, uno o varios productos de este pedido ya no se encuentran en stock');
            return redirect(url('account/orders'));
        }

        if (!$order->canOrderProducts()) {
            alert()->info('No se puede realizar el pago, los productos del pedido no cuentan con la cantidad requerida en stock');
            return redirect(url('account/orders'));
        }

        return view('checkout.pay', compact('order', 'categories'));
    }




    // Select billing data form
    public function bill($orderId)
    {
        $order = Order::find($orderId);
        $categories = Category::orderBy('order', 'asc')->where('parent_id', null)->get()->take(4);

        if (!$order) {
            alert()->error('No se ha encontrado el pedido');
            return redirect(url('account/orders'));
        }


        SEO::setTitle('Facturación');
        SEO::setDescription('Generación de facturación de pedido');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');



        if ($order->user_id != Auth::user()->id) {
            \Log::info('Usuario intentado pagar pedido que no es suyo');
            \Log::info(Auth::user());
            alert()->error('No tienes permiso para ver esto');
            return redirect(url('account/orders'));
        }

        if ($order->status->slug != 'billing') {
            if ($order->status->slug == 'delivery') {
                alert()->error('Este pedido ya ha sido facturado');
                return redirect(url('account/orders'));
            }

            alert()->info('No se puede facturar este pedido');
            return redirect(url('account/orders'));
        }

        return view('checkout.bill', compact('order', 'categories'));
    }


    // Generate the bill
    public function generateBill($id)
    {
        $order = Order::find($id);
        if (!$order || !$order->status->slug == 'billing') {
            alert()->error('Ha ocurrido un error al finalizar la compra', 'Por favor revisa tu conexión a internet y que todos tus datos personales estén ingresados correctamente, si el problema persiste comunícate con nuestros equipo de asistencia para ayudarte con tu problema.');
            return redirect(url('bill/' . $order->id));
        }

        if ($order->user_id != Auth::user()->id) {
            alert()->error('No tienes permiso para ver esto');
            return redirect(url('account/orders'));
        }

        $isConsumidorFinal = request('is_consumidor_final');

        if (!$isConsumidorFinal) {
            $billingAddress = Address::find(request('billing_address_id'));
            if (!$billingAddress) {
                alert()->error('Ha ocurrido un error al generar la factura', 'Por favor revisa tu conexión a internet y que todos tus datos personales estén ingresados correctamente, si el problema persiste comunícate con nuestros equipo de asistencia para ayudarte con tu problema.');
                return redirect(url('bill/' . $order->id));
            } else {
                // Bill
                $order->billing_address_id = $billingAddress->id;
                $order->save();
            }
        }

        // Handle Consumidor Final in model method
        $factura = $order->generateBill();
        if (isset($factura['error'])) {
            \Log::error($factura['error']);
            alert()->error('Ha ocurrido un error al generar la factura: ' . $factura['error']);
            return redirect(url('bill/' . $order->id));
        }

        $order->status_id = OrderStatus::whereSlug('shipping')->first()->id;
        $order->save();

        // alert()->success('Se ha generado la factura exitosamente, tu pedido se encuentra en camino');
        return redirect(url('ship/' . $order->id));
    }

    public function ship($id)
    {


        // Handle shipping
        $order = Order::find($id);
        if (!$order || !$order->status->slug == 'shipping') {
            alert()->error('Ha ocurrido un error al finalizar la compra', 'Por favor revisa tu conexión a internet y que todos tus datos personales estén ingresados correctamente, si el problema persiste comunícate con nuestros equipo de asistencia para ayudarte con tu problema.');
            return redirect(url('account/orders'));
        }

        if ($order->user_id != Auth::user()->id) {
            alert()->error('No tienes permiso para ver esto');
            return redirect(url('account/orders'));
        }


        if ($order->getLocalItems()) {
            $local = $order->generateLocalShippingOrder();
            // dd($local);
            if (isset($local['error'])) {
                alert()->info($local['error']);
                return redirect(url('account/orders'));
            }
        }
        if ($order->getNationalItems()) {
            $national = $order->generateNationalShippingOrder();
            // dd($national);
            if (isset($national['error'])) {
                alert()->error($national['error']);
                return redirect(url('account/orders'));
            }
        }

        $order->status_id = OrderStatus::whereSlug('delivery')->first()->id;
        $order->save();

        alert()->success('Tu pedido fue despachado exitosamente. Recibirás los detalles en tu correo electrónico.');

        return redirect(url('account/orders'));
    }
}