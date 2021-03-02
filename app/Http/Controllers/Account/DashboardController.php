<?php

namespace App\Http\Controllers\Account;


use Carbon\Carbon;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends \App\Http\Controllers\Controller
{

    public $colors;

    public function __construct()
    {
        $this->middleware('auth');

        $this->colors = [
            '#3490dc',
            '#6574cd',
            '#9561e2',
            '#c747ff',
            '#e3342f',
            '#f6993f',
            '#ffed4a',
            '#38c172',
            '#4dc0b5',
            '#6cb2eb',
            '#181b48',
        ];

        // $this->colors = [
        //     'blue' => '#3490dc',
        //     'indigo' => '#6574cd',
        //     'purple' => '#9561e2',
        //     'pink' => '#c747ff',
        //     'red' => '#e3342f',
        //     'orange' => '#f6993f',
        //     'yellow' => '#ffed4a',
        //     'green' => '#38c172',
        //     'teal' => '#4dc0b5',
        //     'cyan' => '#6cb2eb',
        //     'dark' => '#181b48',
        // ];
    }


    public function sell_records()
    {
        if(!auth()->user()->canSeeDashboard('sell_records')) {
            alert()->info('No tienes permiso para ver esto, necesitas un plan superior para continuar');
                // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }
        // Filtered results
        $start = request()->has('start') ? Carbon::parse(request('start')) : Carbon::now()->subMonth(6);
        $end = request()->has('end') ?  Carbon::parse(request('end')) : Carbon::now();
        $data = DashboardService::getSellRecordsDashboardData(Auth::user()->store, $start, $end);
        return view('account.dashboards.sell_records', $data);
    }

    public function business_profile()
    {

        if(!auth()->user()->canSeeDashboard('business_profile')) {
            alert()->info('No tienes permiso para ver esto, necesitas un plan superior para continuar');
                // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }
        $start = request()->has('start') ? Carbon::parse(request('start')) : Carbon::now()->subMonth(6);
        $end = request()->has('end') ?  Carbon::parse(request('end')) : Carbon::now();
        $data = DashboardService::getBusinessProfileDashboardData(Auth::user()->store, $start, $end);
        return view('account.dashboards.business_profile', $data);
    }


    public function interactions()
    {

        if(!auth()->user()->canSeeDashboard('interactions')) {
            alert()->info('No tienes permiso para ver esto, necesitas un plan superior para continuar');
                // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }
        $start = request()->has('start') ? Carbon::parse(request('start')) : Carbon::now()->subMonth(6);
        $end = request()->has('end') ?  Carbon::parse(request('end')) : Carbon::now();
        $data = DashboardService::getInteractionsDashboardData(Auth::user()->store, $start, $end);
        return view('account.dashboards.interactions', $data);
    }


    public function products()
    {   

        if(!auth()->user()->canSeeDashboard('products')) {
            alert()->info('No tienes permiso para ver esto, necesitas un plan superior para continuar');
                // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }
        $start = request()->has('start') ? Carbon::parse(request('start')) : Carbon::now()->subMonth(6);
        $end = request()->has('end') ?  Carbon::parse(request('end')) : Carbon::now();

        $switch_filter = request('filter', 'sales');
        $data = DashboardService::getProductsDashboardData($switch_filter, Auth::user()->store, $start, $end);
        // dd($data);
        return view('account.dashboards.products', $data);
    }



    public function cities()
    {

        if(!auth()->user()->canSeeDashboard('cities')) {
            alert()->info('No tienes permiso para ver esto, necesitas un plan superior para continuar');
                // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }
        $start = request()->has('start') ? Carbon::parse(request('start')) : Carbon::now()->subMonth(6);
        $end = request()->has('end') ?  Carbon::parse(request('end')) : Carbon::now();

        $switch_filter = request('filter', 'sales');
        $data = DashboardService::getCitiesDashboardData($switch_filter, Auth::user()->store, $start, $end);
        return view('account.dashboards.cities', $data);
    }


    public function funnel()
    {
        if(!auth()->user()->canSeeDashboard('funnel')) {
            alert()->info('No tienes permiso para ver esto, necesitas un plan superior para continuar');
                // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }
        $start = request()->has('start') ? Carbon::parse(request('start')) : Carbon::now()->subMonth(6);
        $end = request()->has('end') ?  Carbon::parse(request('end')) : Carbon::now();
        $data = DashboardService::getFunnelDashboardData(Auth::user()->store, $start, $end);
        return view('account.dashboards.funnel', $data);
    }
}
