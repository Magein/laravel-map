<?php

namespace Magein\Map\Facades;

use Magein\Map\Lib\Convert;
use Illuminate\Support\Facades\Facade;
use Magein\Map\Lib\MapResult;
use Magein\Map\Lib\Map as LibMap;

/**
 * @method static Convert  convert()
 * @method static LibMap  platform(string $platform)
 * @method static MapResult  address($address, array $other = [])
 * @method static MapResult  location(string $phone = '')
 * @method static MapResult  ip(string $phone = '', $code = '', string $scene = '')
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
