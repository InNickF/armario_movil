<?php

namespace App\Http\Controllers\Account;

use App\DataTables\Account\ProductDataTable;
use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\UserStore;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class ProductController extends \App\Http\Controllers\Controller
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
        // $this->authorizeResource(Product::class, Product::class);
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = \App\Models\Category::whereNull('parent_id')->get();

        $products = Product::where([
            'store_id' => Auth::user()->store->id,
        ])->orderBy('created_at', 'desc');

        if ($request->has('category') && !empty($request->query('category'))) {
            $products->where('category_id', $request->query('category'));
        }

        $searchFilter = request('search');

        if ($searchFilter) {
            $products->where(function ($query) use ($searchFilter) {
                $query->where('name', 'LIKE', '%'.$searchFilter.'%')
                    ->orWhere('description', 'LIKE', '%'.$searchFilter.'%')
                    ->orWhere('id', 'LIKE', '%'.$searchFilter.'%')
                ;
            });
        }

        return view('account.products.index', [
            'filtered_category' => $request->query('category'),
            'categories' => $categories,
            'products' => $products->get(),
            'searchFilter' => $searchFilter,
        ]);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        if (!auth()->user()->canCreateProduct()) {
            alert()->info('No puedes crear más productos con tu plan actual, actualiza tu suscripción para crear más productos');

            return redirect(url('account/plans'));
        }
        $categories = Category::all();
        $stores = UserStore::all();

        return view('account.products.create')->withCategories($categories)->withStores($stores)->withUser(Auth::user());
    }

    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            alert()->error('Producto no encontrado');

            return redirect($product->url);
        }

        if (Auth::user()->isNotA('super-user')) {
            if ($product->store_id != Auth::user()->store->id) {
                abort(403);
            }
        }

        $categories = \App\Models\Category::nested()->get();

        return view('account.products.edit')
            ->with('product', $product)
            ->with('categories', $categories)
        ;
    }

    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            alert()->error('Producto no encontrado');

            return redirect(url('account/products'));
        }

        if ($product->store->user->id != auth()->user()->id) {
            abort(403);
        }

        $this->productRepository->delete($id);

        alert()->success('Producto eliminado exitosamente');

        return redirect(url('account/products'));
    }

    public function planCheckout($productId, $planId)
    {
        $product = Product::find($productId);
        if (!$product) {
            alert()->error('No se ha encontrado el producto');

            return redirect(url('account/products/'.$productId.'/edit'));
        }

        $plan = app('rinvex.subscriptions.plan')->find($planId);
        if (!$plan) {
            alert()->error('No se ha encontrado el plan');

            return redirect(url('account/products/'.$productId.'/edit'));
        }

        if (!$product->canUpgradeToPlan($plan)) {
            alert()->error('No se puede actualizar el producto al plan seleccionado');

            return redirect(url('account/products/'.$productId.'/edit'));
        }

        return view('products.pay', compact('plan', 'product'));
    }

    // ! Moved to API
    // public function payPlan(Request $request)
    // {
    //     $input = $request->all();
    //     $product = Product::find($input['product_id']);
    //     $plan = app('rinvex.subscriptions.plan')->find($input['plan_id']);

    //     if (!$plan) {
    //         alert()->error('No se ha encontrado el plan');
    //         return redirect(url('account/products/' . $input['product_id'] . '/edit'));
    //     }

    //     if (!$product) {
    //         alert()->error('No se ha encontrado el producto');
    //         return redirect(url('account/products/' . $input['product_id'] . '/edit'));
    //     }

    //     if (!$product->canUpgradeToPlan($plan)) {
    //         alert()->error('No se puede actualizar el producto al plan seleccionado');
    //         return redirect(url('account/products/' . $input['product_id'] . '/edit'));
    //     }

    //     $card_token = request()->get('token');

    //     if (!$card_token) {
    //         alert()->error('Error al procesar pago.');
    //         return redirect(url('account/products/' . $product->id . '/edit'));
    //     }

    //     // dd($input);
    //     $transaction = $product->makePlanPayment($card_token, $plan);
    //     if (isset($transaction['error'])) {
    //         alert()->error($transaction['error']);
    //         return redirect(url('account/products/' . $input['product_id'] . '/edit'));
    //     }

    //     if ($product->getSubscription()) {
    //         $product->getSubscription()->changePlan($plan);
    //     } else {
    //         $product->newSubscription('main', $plan);
    //     }

    //     alert()->success('El plan de anuncios del producto ha sido actualizado a ' . $plan->name);
    //     return redirect(url('account/products/' . $product->id . '/bill'));
    // }

    public function billPlan($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            alert()->error('No se ha encontrado el producto');

            return redirect(url('account/products/'.$productId.'/edit'));
        }

        $subscription = $product->getSubscription();

        if (!$subscription) {
            alert()->error('No se ha encontrado la suscripción');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        // * A transaction must exist and have NULL billing_document_id
        $transaction = Transaction::where('is_refund', false)->where('content_type', 'App\Models\Product')->where('content_id', $product->id)->latest()->first();

        if (!$transaction) {
            alert()->error('No se ha encontrado la transacción para generar una factura');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }
        //  If is paid but and has bill
        if (null != $transaction->billing_document_id) {
            alert()->error('Ya se ha facturado tu plan de anuncios');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        if (null == $transaction->transaction_id) {
            alert()->error('No requiere generar factura');

            return redirect(url('account/products/pay'));
        }

        return view('products.bill', compact('subscription', 'transaction', 'product'));
    }

    public function generatePlanBill(Request $request)
    {
        $isConsumidorFinal = request('is_consumidor_final');

        $product = Product::find(request('product_id'));

        if (!$product) {
            alert()->error('No se ha encontrado el producto');

            return redirect(url('account/products/'));
        }

        if (!$isConsumidorFinal) {
            $address = Address::find(request('address_id'));
            if (!$address) {
                alert()->error('No se ha completado los datos de facturación');

                return redirect(url('account/products/'.$product->id.'/bill'));
            }
        }

        $subscription = $product->getSubscription();

        if (!$subscription) {
            alert()->error('No se ha encontrado la suscripción');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        // * A transaction must exist and have NULL billing_document_id
        $transaction = Transaction::where('is_refund', false)->where('content_type', 'App\Models\Product')->where('content_id', $product->id)->latest()->first();

        if (!$transaction) {
            alert()->error('No se ha encontrado la transacción para generar una factura');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        //  If has bill
        if (null != $transaction->billing_document_id) {
            alert()->error('Ya se ha facturado tu suscripción');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        if (null == $transaction->transaction_id) {
            alert()->error('No requiere generar factura');

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        $factura = $product->generateBill($address ?? null, $transaction);
        if (isset($factura['error'])) {
            alert()->error('Error al generar factura: '.$factura['error']);

            return redirect(url('account/products/'.$product->id.'/edit'));
        }

        alert()->success('Se ha generado la factura exitosamente');

        return redirect(url('account/products/'.$product->id.'/plan/success'));
    }

    public function planSuccess($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (!$product) {
            alert()->error('No se ha encontrado el producto');

            return redirect(url('account/products/'));
        }

        return view('products.plan-success', compact('product'));
    }
}