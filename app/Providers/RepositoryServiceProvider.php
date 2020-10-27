<?php

namespace App\Providers;

use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\OfferRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            OfferRepositoryInterface::class,
            OfferRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
