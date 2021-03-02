<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {   
        if(!$product->final_price) { // Omit seeder because nested error
            $product->final_price = $product->has_discount ? $product->discounted_price : $product->price;
        }
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        if(!$product->final_price) { // Omit seeder because nested error
            $product->final_price = $product->has_discount ? $product->discounted_price : $product->price;
        }
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
