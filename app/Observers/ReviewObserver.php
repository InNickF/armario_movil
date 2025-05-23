<?php

namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the review "created" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $store = $review->reviewable->product_variant->product->store;
        $orderItems = $store->getOrderItems()->get();
        $average = $orderItems->pluck('review')->avg('rating');
        
        $store->rating = round($average, 1);
        $store->save();
    }

    /**
     * Handle the review "updated" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        $store = $review->reviewable->product_variant->product->store;
        $orderItems = $store->getOrderItems()->get();
        $average = $orderItems->pluck('review')->avg('rating');
        
        $store->rating = round($average);
        $store->save();
    }

    /**
     * Handle the review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $store = $review->reviewable->product_variant->product->store;
        $orderItems = $store->getOrderItems()->get();
        $average = $orderItems->pluck('review')->avg('rating');
        
        $store->rating = round($average, 1);
    }

    /**
     * Handle the review "restored" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        //
    }

    /**
     * Handle the review "force deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        //
    }
}
