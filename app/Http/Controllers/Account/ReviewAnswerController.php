<?php

namespace App\Http\Controllers\Account;


use Flash;

use App\Mail\ReviewAnswered;
use App\Models\ReviewAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;

class ReviewAnswerController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        // TODO: Check security
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        
        $answer = ReviewAnswer::create($input);

        Mail::to($answer->review->user)->send(new ReviewAnswered($answer));

        alert()->success('Respuesta guardada.');

        return back();
    }
}
