<?php

namespace App\Observers;

use App\Models\Seller;

class SellerObserver
{
    /**
     * Handle the Seller "created" event.
     *
     * @param  \App\Models\Seller  $seller
     * @return void
     */
    public function created(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "updated" event.
     *
     * @param  \App\Models\Seller  $seller
     * @return void
     */
    public function updated(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "deleted" event.
     *
     * @param  \App\Models\Seller  $seller
     * @return void
     */
    public function deleted(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "restored" event.
     *
     * @param  \App\Models\Seller  $seller
     * @return void
     */
    public function restored(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "force deleted" event.
     *
     * @param  \App\Models\Seller  $seller
     * @return void
     */
    public function forceDeleted(Seller $seller)
    {
        //
    }
}
