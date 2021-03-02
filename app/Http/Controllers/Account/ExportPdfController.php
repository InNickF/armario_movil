<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use App\Http\Controllers\AppBaseController;
use App\Models\ShippingOrder;
use Illuminate\Support\Facades\Auth;
use App\Services\DashboardService;

class ExportPdfController extends \App\Http\Controllers\Controller
{

    public function sold_products_dashboard()
    {
        // Filtered results
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;

        $data = DashboardService::getSellRecordsDashboardData(Auth::user()->store, $start, $end);
        try {
            // $pdf = PDF::loadFile('http://www.github.com')->inline('github.pdf');
            $pdf = \PDF::loadView('pdf.sell_records_dashboard', $data);
            return $pdf->download('Registro de ventas.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }

    public function products_dashboard()
    {
        // Filtered results
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;
        $filter = request('filter');

        $data = DashboardService::getProductsDashboardData($filter, Auth::user()->store, $start, $end);
        try {
            $pdf = \PDF::loadView('pdf.products_dashboard', $data);
            $pdf->setOption('images', true);

            return $pdf->download('Categorías de productos.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }


    public function business_profile_dashboard()
    {
        // Filtered results
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;
        $filter = request('filter');

        $data = DashboardService::getBusinessProfileDashboardData(Auth::user()->store, $start, $end);
        try {
            $pdf = \PDF::loadView('pdf.business_profile_dashboard', $data);
            $pdf->setOption('images', true);

            return $pdf->download('Perfil comercial.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }



    public function cities_dashboard()
    {
        // Filtered results
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;
        $filter = request('filter');

        $data = DashboardService::getCitiesDashboardData($filter, Auth::user()->store, $start, $end);
        try {
            $pdf = \PDF::loadView('pdf.cities_dashboard', $data);
            $pdf->setOption('images', true);

            return $pdf->download('Ciudades.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }


    public function interactions_dashboard()
    {
        // Filtered results
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;
        $filter = request('filter');

        $data = DashboardService::getInteractionsDashboardData(Auth::user()->store, $start, $end);
        try {
            $pdf = \PDF::loadView('pdf.interactions_dashboard', $data);
            $pdf->setOption('images', true);

            return $pdf->download('Interacciones.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }


    public function funnel_dashboard()
    {
        // Filtered results
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;

        $data = DashboardService::getFunnelDashboardData(Auth::user()->store, $start, $end);
        $data['is_export'] = true;
        try {
            $pdf = \PDF::loadView('pdf.funnel_dashboard', $data);
            $pdf->setOption('images', true);

            return $pdf->download('funnel_dashboard_store_' . Auth::user()->store->id . '.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }

    public function shipping_order($id)
    {
        $shipping_order = ShippingOrder::find($id);

        if (!$shipping_order || $shipping_order->order->user->id != auth()->user()->id) {
            return abort(403);
        }

        try {
            $pdf = \PDF::loadView('pdf.shipping_order', compact('shipping_order'));
            $pdf->setOption('images', true);

            // save file
            // $targetPath = public_path('storage/shipping_orders/shipping_order_' . $shipping_order->id . '.pdf');
            // $pdf->save($targetPath);

            return $pdf->download('guia_' . $shipping_order->id . '.pdf');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en PDF, por favor intenta de nuevo');
            return back();
        }
    }
}