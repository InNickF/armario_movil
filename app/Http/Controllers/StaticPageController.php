<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;
use App\Models\Slider;

class StaticPageController extends Controller
{
    public function contactForm() {

        SEO::setTitle('Contacto');
        SEO::setDescription('Formulario de contacto');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');

        return view('pages.contact');
    }

    public function contactSuccess() {

        SEO::setTitle('Contacto');
        SEO::setDescription('Formulario de contacto enviado exitosamente');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');

        return view('pages.contact-success');
    }

    public function promociones() {

        SEO::setTitle('Best Seller');
        SEO::setDescription('');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');

        $home_top_slider = Slider::where('position', 'home_top')->where('type', 'slider')->first();
        $top_banner = Slider::where('position', 'home_bottom')->where('type', 'banner')->first();
        return view('pages.promociones')->with(compact(
            'top_banner', // Banners abajo de slider
            'home_top_slider'));
    }


    public function gracias() {

        SEO::setTitle('Gracias por tu compra');
        SEO::setDescription('');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');

        return view('pages.gracias');
    }
}
