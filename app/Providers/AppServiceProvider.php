<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\MessagesProvider;
use App\Providers\ArrayProvider;

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
