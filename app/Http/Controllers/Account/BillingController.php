<?php

namespace App\Http\Controllers\Account;

use App\Ubigeo;
use App\Http\Controllers\AppBaseController;


class BillingController extends \App\Http\Controllers\Controller
{
  
    public function index()
    {   
        $states = Ubigeo::all()->groupBy('state');
        return view('account.billing.index', compact('states'));
    }
}
