<?php

namespace Magein\Map;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Magein\Map\Lib\MapFactory;

class MapServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config.php', 'map');

        $this->app->singleton('map', function () {
            return new MapFactory();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    public function provides()
    {
        return ['map'];
    }
}