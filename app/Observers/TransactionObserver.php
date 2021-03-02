<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Mail\TransactionCreated;
use Illuminate\Support\Facades\Mail;

class TransactionObserver
{
    /**
     * Handle the transaction "created" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        Mail::to('info@armariomovil.com')->send(new TransactionCreated($transaction));
    }

    /**
     * Handle the transaction "updated" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "deleted" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "restored" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "force deleted" event.
     *
     * @param  \App\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
