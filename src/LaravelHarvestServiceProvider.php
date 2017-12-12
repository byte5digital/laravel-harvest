<?php

namespace Naoray\LaravelHarvest;

use Illuminate\Support\ServiceProvider;

class LaravelHarvestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/harvest.php' => config_path('harvest.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/harvest.php', 'harvest');

        $this->app->bind('harvest', ApiManager::class);
    }
}
