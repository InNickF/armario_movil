<?php

namespace App\Http\Controllers\Admin;

use App\Models\guia;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Answer;
use App\Models\Product;
use App\Models\Question;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Models\ShippingOrder;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MailPreviewController extends Controller
{
    public function mail()
    {
        $user = auth()->user();
        $order = Order::find(1);

        $store = \App\Models\UserStore::find(1);
        $question = Question::find(2) ;
        $guia = ShippingOrder::first();
        $paymentRequestId = '1';
        $date = Carbon::now();

        $answer = Answer::find(4);
        $subject = 'sasd';
        $product = Product::find(7);
        $transaction = Transaction::find(1);


        // dd($className);
        return new \App\Mail\UserPlanBillCreated($user, $transaction, $subject);
    }
}
