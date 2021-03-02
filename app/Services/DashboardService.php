<?php

namespace App\Services;

use Analytics;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\UserStore;
use App\Charts\AgeBarChart;
use Spatie\Analytics\Period;
use App\Charts\GenderPieChart;
use App\Charts\PlainValuePieChart;
use App\Charts\VisitsCountBarChart;
use App\Charts\ProductReachLineChart;
use App\Charts\CitiesSummaryLineChart;
use App\Charts\PagesPerVisitLineChart;
use App\Charts\ProductSummaryLineChart;
use App\Charts\BusinessProfileVisitsChart;
use App\Charts\VisitsAverageTimeLineChart;
use App\Charts\InteractionsSummaryLineChart;
use Illuminate\Database\Eloquent\Collection;


class DashboardService
{

    const colors = [
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
    /**
     *
     * DASHBOARDS
     *
     */
    public static function getSellRecordsDashboardData(UserStore $store, $start = null, $end = null)
    {
        // Totals bottom
        $total_earning = $store->getTotalEarning();
        $active_earning = $store->getActiveEarning();


        // Filtered results
        $order_items = $store->getOrderItems($start, $end)->latest()->paginate(6);
        $export_excel_url = url('account/export/excel/sold_products_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $export_pdf_url = url('account/export/pdf/sold_products_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));

        $data = compact(
            'order_items',
            'active_earning',
            'total_earning',
            'export_excel_url',
            'export_pdf_url',
            'start',
            'end'
        );

        return $data;
    }

    public static function getBusinessProfileDashboardData(UserStore $store, $start, $end)
    {
        /**
         * Summary
         */
        $summary = $store->getBusinessProfileSummary($start, $end);

        // Visits line chart
        $products_urls_filters = "";

        foreach ($store->products()->pluck('slug')->toArray() as $key => $slug) {
            if ($key > 0) {
                $products_urls_filters .= ',';
            }
            $products_urls_filters .= "ga:pagePath=@/" . $slug;
        }

        $products_urls_filters .= (empty($products_urls_filters) ? '' : ';') . "ga:pagePath=@/" . $store->slug;

        // dd($products_urls_filters);

        $visits_data = Analytics::performQuery(
            Period::create($start, $end),
            "ga:pageviews",
            [
                'filters' => $products_urls_filters,
                'dimensions' => 'ga:month, ga:year', // 0
                'sort' => 'ga:year, ga:month'
            ]
        );

        $visits = collect($visits_data->getRows());
        // dd($visits);

        $data_visitors = $visits->groupBy(function ($row) {
            return Carbon::createFromFormat('m', $row[0])->format('M') . '/' . $row[1];
        })
            ->map(function ($items) {
                $views = 0;
                foreach ($items as $key => $item) {
                    $views += $item[2];
                };
                // Return the number of persons with that age
                return $views;
            });


        $business_profile_visits_chart = new BusinessProfileVisitsChart;
        $business_profile_visits_chart->labels($data_visitors->keys())->loaderColor(self::colors[0]);

        $business_profile_visits_chart->dataset(
            "Visitas",
            'line',
            $data_visitors->values()
        )->color(self::colors[0])->fill(false);



        $customers_by_age = [
            '18 - 28' => $store->getCustomers()->agedBetween(18, 28)->get(),
            '28 - 38' => $store->getCustomers()->agedBetween(28, 38)->get(),
            '38 - 48' => $store->getCustomers()->agedBetween(38, 48)->get(),
            '48 - 58' => $store->getCustomers()->agedBetween(48, 58)->get(),
            '58 ó más' => $store->getCustomers()->agedBetween(58, 110)->get(),
        ];

        $customers_by_age = collect($customers_by_age)->map(function ($customers) {
            return $customers->count();
        })->flatten();
        $customers_age_chart = new AgeBarChart;
        $customers_age_chart->displayLegend(false)->loaderColor(self::colors[0]);
        $customers_age_chart->labels(['18 - 28', '28 - 38', '38 - 48', '48 - 58', '58 o más']);
        $customers_age_chart->dataset(
            "Compradores",
            'bar',
            $customers_by_age
        )->backgroundColor(self::colors);



        /**
         * Interactions Line Chart
         */
        // $data_interactions = $visits->groupBy(function ($row) {
        //     return Carbon::createFromFormat('m', $row[0])->format('M') . '/' . $row[1];
        // })->map(function ($items) {
        //     $views = 0;
        //     foreach ($items as $key => $item) {
        //         $views += $item[3];
        //     };
        //     // Return the number of persons with that age
        //     return $views;
        // });



        // $product_reach_chart = new ProductReachLineChart;
        // $product_reach_chart->labels($data_interactions->keys());
        // $product_reach_chart->dataset(
        //     "Alcance",
        //     'line',
        //     $data_interactions->values()
        // )->color(self::colors[0])->fill(false);
        // $product_reach_chart->displayLegend(false)->displayAxes(true);


        $customers = $store->getCustomers()->get();
        $customers_count = $customers->count();
        $customers_by_gender = $customers->sortBy('gender')->groupBy('gender');
        \Log::info($customers_by_gender);

        $customers_by_gender = $customers_by_gender->map(function ($g) use ($customers_count) {
            $gender_customers = $g->count();
             $one = $customers_count / 100;

            return round($gender_customers / $one, 2);
        })->flatten();

        \Log::info($customers_by_gender);

        $customers_gender_chart = new GenderPieChart;
        $customers_gender_chart->labels(['Femenino (%)', 'Masculino (%)', 'Otro (%)'])->loaderColor(self::colors[0]);
        $customers_gender_chart->dataset(
            "Género de compradores",
            'doughnut',
            $customers_by_gender
        )->backgroundColor([self::colors[2], self::colors[1]]);
        $customers_gender_chart->displayLegend(true)->displayAxes(false);


        $export_excel_url = url('account/export/excel/business_profile_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $export_pdf_url = url('account/export/pdf/business_profile_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));

        return compact(
            'summary',
            'business_profile_visits_chart',
            'customers_age_chart',

            'customers_gender_chart',
            'export_excel_url',
            'export_pdf_url',
            'start',
            'end'
        );
    }


    public static function getProductsDashboardData($type = 'sales', UserStore $store, $start, $end)
    {
        $period = CarbonPeriod::create($start, '1 month', $end);

        // Line graph bottom
        $line_chart = new ProductSummaryLineChart;
        $line_chart->labels(collect($period)->map(function ($dt) {
            return $dt->format('M/Y');
        }))->loaderColor(self::colors[0]);

        switch ($type) {
            case 'sales':
                // Table top
                $categories = $store->getSalesBySubcategories($start, $end);

                // Each dataset is a category
                $i = 0; // For color assignment
                $categories->each(function ($category_data, $categoryName) use (&$line_chart, &$i) {
                    $category_data_no_total = collect($category_data)->filter(function ($data, $key) {
                        return $key != 'total';
                    });
                    $data = collect($category_data_no_total)->flatten();
                    $line_chart->dataset(
                        $categoryName,
                        'line',
                        $data
                    )->color(self::colors[$i] ?? self::colors[0])->fill(false);
                    $i++;
                });

                break;

            case 'visits':
                // Table top
                // Categories
                $categories = $store->getVisitsBySubcategories($start, $end);

                // Each dataset is a category
                $i = 0; // For color assignment
                $categories->each(function ($category_data, $categoryName) use (&$line_chart, &$i) {
                    $category_data_no_total = collect($category_data)->filter(function ($data, $key) {
                        return $key != 'total';
                    });
                    $data = collect($category_data_no_total)->flatten();
                    $line_chart->dataset(
                        $categoryName,
                        'line',
                        $data
                    )->color(self::colors[$i] ?? self::colors[0])->fill(false);
                    $i++;
                });
                break;
            default:
                # code...
                break;
        }


        $export_excel_url = url('account/export/excel/products_dashboard?filter=' . $type . '&start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $export_pdf_url = url('account/export/pdf/products_dashboard?filter=' . $type . '&start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $colors = self::colors;
        return compact(
            'period',
            'categories',
            'line_chart',
            'export_excel_url',
            'export_pdf_url',
            'start',
            'end',
            'type',
            'colors'
        );
    }



    public static function getInteractionsDashboardData(UserStore $store, $start, $end)
    {

        $data = $store->getInteractions($start, $end);

        $months = collect(CarbonPeriod::create($start, '1 month', $end)->toArray())->map(function ($dt) {
            return $dt->format('M/Y');
        });

        // dd($data['visits']);
        $visits_count_chart = new VisitsCountBarChart;
        $visits_count_chart->labels($months)->displayLegend(false)->loaderColor(self::colors[0]);
        $visits_count_chart->dataset(
            "",
            'bar',
            $data['visits']->values()
        )->backgroundColor(self::colors);


        $visits_avg_time_chart = new VisitsAverageTimeLineChart;
        $visits_avg_time_chart->labels($months)->loaderColor(self::colors[0]);
        $visits_avg_time_chart->dataset(
            "",
            'line',
            collect($data['data_avg_time']->values())->map(function ($avg) {
                return date('i.s', $avg);
            })
        )->color(self::colors[4])->fill(false);
        $visits_avg_time_chart->displayLegend(false);

        // dd($data_pages_per_session);
        $pages_per_visit_chart = new PagesPerVisitLineChart;
        $pages_per_visit_chart->labels($months)->displayLegend(false)->loaderColor(self::colors[0]);
        $pages_per_visit_chart->dataset(
            "",
            'bar',
            $data['data_pages_per_session']->values()
        )->backgroundColor(self::colors);

        $avg_session_duration = $data['avg_session_duration'];

        $export_excel_url = url('account/export/excel/interactions_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $export_pdf_url = url('account/export/pdf/interactions_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $colors = self::colors;

        return compact(
            'start',
            'end',
            'avg_session_duration',
            'visits_count_chart',
            'visits_avg_time_chart',
            'pages_per_visit_chart',
            'export_excel_url',
            'export_pdf_url',
            'colors'
        );
    }

    public static function getCitiesDashboardData($type = 'sales', UserStore $store, $start, $end)
    {

        $period = CarbonPeriod::create($start, '1 month', $end);

        $published_products = $store->products;

        $cities = [];

        $summary_chart = new CitiesSummaryLineChart;
        $summary_chart->labels(collect($period)->map(function ($dt) {
            return $dt->format('M/Y');
        }))->loaderColor(self::colors[0]);;

        switch ($type) {
            case 'sales':
                // Table top
                $cities = $store->getSalesByCities($start, $end);

                // Each dataset is a city
                $i = 0; // For color assignment
                $cities->each(function ($city_data, $cityName) use (&$summary_chart, &$i) {
                    $city_data_no_total = collect($city_data)->filter(function ($data, $key) {
                        return $key != 'total';
                    });
                    $data = collect($city_data_no_total)->flatten();
                    $summary_chart->dataset(
                        $cityName,
                        'line',
                        $data
                    )->color(self::colors[$i] ?? self::colors[0])->fill(false);
                    $i++;
                });

                break;

            case 'visits':
                // Table top
                $cities = collect($store->getVisitsByCities($start, $end));
                // dd($cities);
                // Each dataset is a city
                $i = 0; // For color assignment

                $cities->each(function ($city_data, $cityName) use (&$summary_chart, &$i, $period) {
                    $final_data = $city_data->flatten();
                    $summary_chart->dataset(
                        $cityName,
                        'line',
                        $final_data
                    )->color(self::colors[$i] ?? self::colors[0])->fill(false);
                    $i++;
                });
                break;
            default:
                # code...
                break;
        }

        $export_excel_url = url('account/export/excel/cities_dashboard?filter=' . $type . '&start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $export_pdf_url = url('account/export/pdf/cities_dashboard?filter=' . $type . '&start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $colors = self::colors;

        return compact(
            'cities',
            'summary_chart',
            'export_excel_url',
            'export_pdf_url',
            'colors',
            'start',
            'end',
            'type',
            'period'
        );
    }


    public static function getFunnelDashboardData(UserStore $store, $start, $end)
    {

        $data = $store->getFunnelData($start, $end);
        // dd($data);

        $months = collect(CarbonPeriod::create($start, '1 month', $end)->toArray())->map(function ($dt) {
            return $dt->format('M/Y');
        });

        $period = CarbonPeriod::create($start, '1 month', $end);

        // Universe (100%) is Visits for all other values
        $universe = isset($data['Visitas']) ? $data['Visitas']['total'] : 0;

        $data = $data->map(function ($item) use ($universe) {
            if ($universe <= 0) {
                $item['percentage'] = 0;
                return $item;
            }

            // Calculate basing in universe
            $item['percentage'] = round(100 - ((($universe - $item['total']) / $universe) * 100), 1);
            return $item;
        });

        $export_excel_url = url('account/export/excel/funnel_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $export_pdf_url = url('account/export/pdf/funnel_dashboard?start=' . $start . '&end=' . $end . '&page=' . request('page', 1));
        $colors = self::colors;

        return compact(
            'start',
            'end',
            'export_excel_url',
            'export_pdf_url',
            'colors',
            'data',
            'period'
        );
    }
}
