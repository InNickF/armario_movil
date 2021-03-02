<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\Carbon;
use App\User;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $user = \Auth::user();

    //     $orders = Order::where(
    //         'created_at',
    //         '>=',
    //         Carbon::now()->subMonth()->toDateTimeString()
    //     );
    //     $orders_compare = Order::whereBetween(
    //         'created_at',
    //         [Carbon::now()->subMonths(2)->toDateTimeString(), Carbon::now()->subMonth()->toDateTimeString()]
    //     );

    //     $customers = User::whereIs('customer')->where(
    //         'created_at',
    //         '>=',
    //         Carbon::now()->subMonth()->toDateTimeString()
    //     );
    //     $customers_compare = User::whereIs('customer')->whereBetween(
    //         'created_at',
    //         [Carbon::now()->subMonths(2)->toDateTimeString(), Carbon::now()->subMonth()->toDateTimeString()]
    //     );

    //     $managers = User::whereIs('store-manager');

    //     $products = Product::query();

    //     if ($user->isNotAn('super-user')) {
    //         if (!$user->store->id) {
    //             $orders->whereNull('id');
    //             $orders_compare->whereNull('id');
    //             $customers->whereNull('id');
    //             $customers_compare->whereNull('id');
    //             $products->whereNull('id');
    //             $managers->whereNull('id');

    //             return;
    //         }

    //         $orders->where(
    //             'store_id',
    //             $user->store->id
    //         );
    //         $orders_compare->where(
    //             'store_id',
    //             $user->store->id
    //         );
    //         $customers->where(
    //             'store_id',
    //             $user->store->id
    //         );
    //         $customers_compare->where(
    //             'store_id',
    //             $user->store->id
    //         );
    //         $products->where(
    //             'store_id',
    //             $user->store->id
    //         );
    //         $managers->where(
    //             'store_id',
    //             $user->store->id
    //         );
    //     }

    //     return view('admin.dashboard')->with([
    //         'sales_summary' => [
    //             'orders' => [
    //                 'count' => $orders->count(),
    //                 'difference' => $orders->count() - $orders_compare->count(),
    //                 'trend' => ($orders->count() - $orders_compare->count()) > 0 ? 'up' : 'down',
    //             ],
    //             'sales' => [
    //                 'total' => $orders->sum('total_price'),
    //                 'difference' => $orders->sum('total_price') - $orders_compare->sum('total_price'),
    //                 'trend' => ($orders->sum('total_price') - $orders_compare->sum('total_price')) > 0 ? 'up' : 'down',
    //             ],
    //             'customers' => [
    //                 'count' => $customers->count(),
    //                 'difference' => $customers->count() - $customers_compare->count(),
    //                 'trend' => ($customers->count() - $customers_compare->count()) > 0 ? 'up' : 'down',
    //             ],
    //         ],
    //         'new_orders' => $orders->take(10)->get(),
    //         'products' => [
    //             // 'top_selling' => $products->withCount('orders')->orderBy('orders_count', 'desc')->take(10)->get(),
    //             // 'top_wishlisted' => $products->whereHas('wishlists')->withCount('wishlists')->orderBy('wishlists_count', 'desc')->take(10)->get()
    //         ],
    //         'managers' => $managers->get(),
    //     ]);
    // }
}
