<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BladeServiceProvider extends ServiceProvider
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
     *
     * @return void
     */
    public function boot()
    {
        // Add @var for Variable Assignment
        // Example: @var('foo', 'bar')
        Blade::directive('vafdfdr', function ($expression) {
            echo "sdfsdfsf";
        });
    }
}
