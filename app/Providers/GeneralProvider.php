<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GeneralProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//	    $this->app->singleton(Connection::class, function ($app) {
//         return new Connection(config('riak'));
//     });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
