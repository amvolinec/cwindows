<?php

namespace App\Observers;

use App\Helpers\BalanceHelper;
use App\Offer;
use Illuminate\Support\Facades\Auth;

class OfferObserver
{
    /**
     * Handle the offer "created" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function created(Offer $offer)
    {
//        $offer->editor_id = Auth::user()->id;
//        $offer->save();
    }

    /**
     * Handle the offer "updated" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
//        $offer->editor_id = Auth::user()->id;
//        $offer->save();
    }

    /**
     * Handle the offer "deleted" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function deleted(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "restored" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function restored(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "force deleted" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function forceDeleted(Offer $offer)
    {
        //
    }
}
