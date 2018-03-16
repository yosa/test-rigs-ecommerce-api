<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\MessagesProvider;
use App\Providers\ArrayProvider;
use App\Logics\Security\GatesLogic;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('messages', function() {
            return new MessagesProvider();
        });
        $this->app->singleton('array', function() {
            return new ArrayProvider();
        });
        $this->app->singleton('gates', function ($app) {         
            return $app->make(GatesLogic::class);            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
