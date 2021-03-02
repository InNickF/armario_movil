<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Address;
use App\Services\PaymentezService;

/**
 * Class Transaction
 * @package App\Models
 * @version April 16, 2019, 3:41 pm UTC
 *
 * @property integer user_id
 * @property integer transaction_id
 * @property string authorization_code
 * @property float amount
 * @property string status
 */
class Transaction extends Model
{

    public $table = 'transactions';



    public $fillable = [
        'user_id',
        'transaction_id',
        'content_type',
        'content_id',
        'authorization_code',
        'amount',
        'status',
        'description',
        'address_id',
        'card_token',
        'billing_document_id',
        'payment_response_json'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'content_id' => 'integer',
        'transaction_id' => 'string',
        'authorization_code' => 'string',
        'content_type' => 'string',
        'amount' => 'float',
        'status' => 'string',
        'description' => 'string',
        'address_id' => 'integer',
        'card_token' => 'string',
        'billing_document_id' => 'string',
        'payment_response_json' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'transaction_id' => 'required',
        'authorization_code' => 'required',
        'content_type' => 'required',
        'content_id' => 'required',
        'description' => 'required',
    ];


    public function transactionable()
    {
        return $this->morphTo('transactionable', 'content_type', 'content_id');
    }



    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }


    public function address()
    {
        return $this->belongsTo(Address::class);
    }



    public function refund()
    {
        /** Si el pedido sale gratis no procesar reembolso y cambiar status directamente */
        if ($this->amount <= 0) {
            return [
                'error' => 'No se puede reembolsar una transacción de valor cero',
            ];
        }

            $paymentez = new PaymentezService();
            $payment = $paymentez->refund($this->transaction_id);

            if (isset($payment['error'])) {
                // $message = collect(json_decode($payment['error']));
                // $message = (isset($message['error']) ? $message['error'] : $message);
                // dd($message);
                // $this->returnProductsToStock();
                return [
                    'error' => $payment['error'],
                ];
            }

            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->content_type = $this->content_type;
            $transaction->content_id = $this->content_id;
            $transaction->amount = $this->amount;
            $transaction->status = 'success';
            // $transaction->transaction_id = $payment['transaction']->id;
            // $transaction->authorization_code = $payment['transaction']->authorization_code;
            $transaction->description = 'Reembolso de transacción #' . $this->id;
            // $transaction->address_id = $this->billing_address_id;
            $transaction->is_refund = true;
            $transaction->save();


            $this->status = 'refunded';
            $this->save();
        

                   // * If is from order, process refund from the Order refund() method
        if ($this->content_type == 'App\Models\Order') {
            $order = Order::find($this->content_id);
            $order->refund();
        }
        
    }
}