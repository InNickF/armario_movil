<?php

namespace App\Http\Controllers\Account;

use App\Ubigeo;
use Illuminate\Http\Request;


class AddressController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {   
        $states = Ubigeo::all()->groupBy('state');
        return view('account.addresses.index', compact('states'));
    }

}
