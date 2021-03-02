<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use App\Exports\FunnelExport;
use App\Exports\CitySalesExport;
use App\Exports\CityVisitsExport;
use App\Exports\InteractionsExport;
use App\Exports\SoldProductsExport;
use Illuminate\Support\Facades\Log;
use App\Exports\CategorySalesExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryVisitsExport;
use App\Exports\BusinessProfileExport;
use App\Http\Controllers\AppBaseController;

class ExportExcelController extends \App\Http\Controllers\Controller
{

    public function sold_products_dashboard()
    {
        // Filters
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;

        try {
            return Excel::download(new SoldProductsExport($start, $end), 'Registro de ventas.xlsx');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en EXCEL, por favor intenta de nuevo');
            return back();
        }
    }


    public function products_dashboard()
    {
        // Filters
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;
        $filter = request('filter');

        try {
            switch ($filter) {
                case 'sales':
                    return Excel::download(new CategorySalesExport($start, $end), 'Categorías de productos - ventas.xlsx');
                    break;
                case 'visits':
                    return Excel::download(new CategoryVisitsExport($start, $end), 'Categorías de productos - visitas.xlsx');
                    break;

                default:
                    alert()->error('No se ha encontrado el tipo de reporte requerido');
                    return back();
                    break;
            }
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en EXCEL, por favor intenta de nuevo');
            return back();
        }
    }


    public function business_profile_dashboard()
    {
        // Filters
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;

        try {
            return Excel::download(new BusinessProfileExport($start, $end), 'Perfil comercial.xlsx');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en EXCEL, por favor intenta de nuevo');
            return back();
        }
    }


    public function cities_dashboard()
    {
        // Filters
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;
        $filter = request('filter');

        try {
            switch ($filter) {
                case 'sales':
                    return Excel::download(new CitySalesExport($start, $end), 'Ciudades - ventas.xlsx');
                    break;
                case 'visits':
                    return Excel::download(new CityVisitsExport($start, $end), 'Ciudades - visitas.xlsx');
                    break;

                default:
                    alert()->error('No se ha encontrado el tipo de reporte requerido');
                    return back();
                    break;
            }
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en EXCEL, por favor intenta de nuevo');
            return back();
        }
    }


    public function interactions_dashboard()
    {
        // Filters
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;

        try {
            return Excel::download(new InteractionsExport($start, $end), 'Interacciones.xlsx');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en EXCEL, por favor intenta de nuevo');
            return back();
        }
    }


    public function funnel_dashboard()
    {
        // Filters
        $start = request('start') ? Carbon::parse(request('start')) : null;
        $end = request('end') ?  Carbon::parse(request('end')) : null;

        try {
            return Excel::download(new FunnelExport($start, $end), 'funnel_dashboard_store_' . Auth::user()->store->id . '.xlsx');
        } catch (\Throwable $th) {
            \Log::error($th);
            alert()->error('No se pudo generar el reporte en EXCEL, por favor intenta de nuevo');
            return back();
        }
    }
}