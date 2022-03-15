<?php

namespace Magein\Map\Facades;

use Illuminate\Support\Facades\Facade;
use Magein\Map\Lib\Convert;

/**
 * @method static Convert  convert()
 * @method static address($address, array $other = [])
 * @method static location(string $phone = '')
 * @method static ip(string $phone = '', $code = '', string $scene = '')
 */
class Map extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'map';
    }
}
