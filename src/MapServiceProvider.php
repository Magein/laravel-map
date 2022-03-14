<?php

namespace Magein\Map;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Magein\Map\Lib\Map;

class SmsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 加载函数
        if (is_file(__DIR__ . '/Common.php')) {
            require_once __DIR__ . '/Common.php';
        }

        $this->mergeConfigFrom(__DIR__ . '/Config.php', 'map');
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
        return [Map::class];
    }
}
