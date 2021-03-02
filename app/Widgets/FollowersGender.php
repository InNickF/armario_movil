<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Charts\GenderPieChart;

class FollowersGender extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $chart = new GenderPieChart;

        $chart->labels(['One', 'Two', 'Three']);

        $chart->dataset(
            "Visitas",
            'pie',
            [65, 59, 80, 81, 56, 55, 40]
        );

        return view('widgets.product_reach', [
            'config' => $this->config,
            'chart' => $chart
        ]);
    }
}
