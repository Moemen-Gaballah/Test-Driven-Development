<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BackingClasses\Char;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Char::class, function () {
            return new Char();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
