<?php
    
namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use App\Ubigeo;

class UbigeoAPIController extends \App\Http\Controllers\Controller
{
    public function states()
    {
        $ubigeos = Ubigeo::all()->groupBy('state');

        return $ubigeos;
    }


    public function cities()
    {
        $cities = Ubigeo::all()->groupBy('city')->keys();

        return $cities;
    }
}
