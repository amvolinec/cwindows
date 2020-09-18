<?php

namespace App\Providers;

use App\Observers\OfferObserver;
use App\Observers\TransactionObserver;
use App\Offer;
use App\Transaction;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::observe(TransactionObserver::class);
        Offer::observe(OfferObserver::class);
    }
}
