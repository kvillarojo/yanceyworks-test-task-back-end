<?php

namespace App\Providers;

use App\Utils\API\JsonPlaceHolder;
use Illuminate\Support\ServiceProvider;

class ApiFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('JsonPlaceHolder', function ($app) {
            return new JsonPlaceHolder();
        });
    }
}
