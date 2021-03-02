<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\DataTables\Admin\OrderDataTable;
use App\Repositories\Admin\OrderRepository;

class OrderController extends \App\Http\Controllers\Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }


    public function index(OrderDataTable $orderDataTable)
    {
        // $input = request()->all();

        /**
         * Get query params
         */
        // $facturasFilter = request()->get('bill_uploaded', 'all');
        // $statusFilter = request()->get('status', null);
        // $searchFilter = request()->get('search', null);
        // $startFilter =  request()->get('start') ? Carbon::parse(request()->get('start')) : null;
        // $endFilter = request()->get('end') ? Carbon::parse(request()->get('end')) : null;

        // $orders = Order::with(['user', 'status', 'coupon', 'items.product_variant.product', 'items.order'])->latest();

        // switch ($facturasFilter) {
        //     case 'pending':
        //         $orders->where('is_bill_uploaded', false);
        //         break;

        //     case 'uploaded':
        //         $orders->where('is_bill_uploaded', true);
        //         break;

        //     default:
        //         break;
        // }

        // switch ($statusFilter) {
        //     case 'pending':
        //         $orders->whereHas('status', function ($s) use ($statusFilter) {
        //             $s->where('slug', '!=', 'completed');
        //         });
        //         break;

        //     case 'completed':
        //         $orders->whereHas('status', function ($s) use ($statusFilter) {
        //             $s->where('slug', 'completed');
        //         });
        //         break;

        //     case 'refund':
        //         $orders->whereHas('status', function ($s) use ($statusFilter) {
        //             $s->where('slug', 'refund');
        //         });
        //         break;

        //     default:
        //         break;
        // }

        // if ($startFilter) {
        //     $orders->where('created_at', '>=', $startFilter);
        // }
        // if ($endFilter) {
        //     $orders->where('created_at', '<=', $endFilter);
        // }

        // if ($searchFilter) {
        //     // dd($orders->first()->user);
        //     $orders = $orders->where('id', 'LIKE', '%' . $searchFilter . '%')
        //         ->orWhereHas('product_variants', function ($pv) use ($searchFilter) {
        //             $pv->whereHas('product', function ($p) use ($searchFilter) {
        //                 $p->where('name', 'LIKE', '%' . $searchFilter . '%')
        //                     ->orWhere('description', 'LIKE', '%' . $searchFilter . '%');
        //             });
        //         })->orWhereHas('user', function ($user) use ($searchFilter) {
        //             $user->where('name', 'LIKE', '%' . $searchFilter . '%')
        //                 ->orWhere('email', 'LIKE', '%' . $searchFilter . '%')
        //                 ->orWhere('id', 'LIKE', '%' . $searchFilter . '%');
        //         });
        // }

        // $orders = $orders->paginate(10);

        // // Dropdowns data
        // $facturasList = [
        //     // 'all' => 'Todas las facturas',
        //     'pending' => 'Facturas por subir',
        //     'uploaded' => 'Facturas subidas',
        // ];

        // $statusesList = [
        //     // 'all' => 'Todos',
        //     'completed' => 'Entregadas',
        //     'pending' => 'En proceso',
        //     'refund' => 'Canceladas',
        // ];

        // // $statusesList = OrderStatus::all()->pluck('name', 'id');

        // return view('admin.orders.index')
        //     ->with(compact(
        //         'orders',
        //         'facturasList',
        //         'facturasFilter',
        //         'statusesList',
        //         'statusFilter',
        //         'startFilter',
        //         'endFilter',
        //         'searchFilter',
        //         'user'
        //     ));


        $startFilter =  request('start_at') ? Carbon::parse(request('start_at'))->startOfDay()->format('Y/m/d') : null;
        $endFilter = request('end_at') ? Carbon::parse(request('end_at'))->endOfDay()->format('Y/m/d') : null;


        return $orderDataTable->render('admin.orders.index', compact('startFilter', 'endFilter'));
    }

}
