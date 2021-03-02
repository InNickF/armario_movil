<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormRequest;

class FormRequestController extends \App\Http\Controllers\Controller
{

    public function store(Request $request)
    {
        $input = $request->all();

        if (!isset($input['email']) || empty($input['email'])) {
            alert()->error('Se requiere un email');
            return back();
        }

        FormRequest::create($input);

        alert()->success('Datos enviados exitosamente');
        return redirect(url('contacto-exito'));
    }

    public function storeEmail(Request $request)
    {
        $input = $request->all();

        if (!isset($input['email']) || empty($input['email'])) {
            alert()->error('Se requiere un email');
            return back();
        }

        FormRequest::create($input);

        alert()->success('Datos enviados exitosamente');
        return redirect(url('/'));
    }
   
}
