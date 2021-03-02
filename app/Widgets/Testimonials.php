<?php

namespace App\Widgets;

use App\Models\Testimonial;
use Arrilot\Widgets\AbstractWidget;

class Testimonials extends AbstractWidget
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
        $testimonials = Testimonial::with('user')->whereHas('user')->latest()->get()->take(10);

        return view('widgets.testimonials', [
            'config' => $this->config,
            'testimonials' => $testimonials,
        ]);
    }
}
