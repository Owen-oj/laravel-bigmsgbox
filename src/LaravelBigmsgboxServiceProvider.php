<?php

namespace Owenoj\LaravelBigmsgbox;

use Illuminate\Support\ServiceProvider;

class LaravelBigmsgboxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-bigmsgbox.php' => config_path('laravel-bigmsgbox.php'),
            ], 'config');
            
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-bigmsgbox.php', 'laravel-bigmsgbox');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-bigmsgbox', function () {
            return new LaravelBigmsgbox;
        });
    }
}
