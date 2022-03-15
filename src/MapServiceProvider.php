<?php

namespace Magein\Map;

use Illuminate\Support\ServiceProvider;
use Magein\Map\Lib\MapFactory;

class MapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config.php', 'map');

        $this->app->bind('map', function () {
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
}
