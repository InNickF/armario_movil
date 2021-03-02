<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use SEO;
use SEOMeta;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        SEO::setTitle(setting('seo_title', 'Armario Móvil'));
        SEO::setDescription(setting('seo_description', 'Plataforma de comercio electrónico'));
        SEOMeta::setKeywords(setting('seo_keywords', []));
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', setting('logo_image_png', asset('images/icons/logo-armario-movil.png')));
    }

    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}