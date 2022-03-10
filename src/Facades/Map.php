<?php

namespace Magein\Map\Facades;

use Illuminate\Support\Facades\Facade;
use Magein\Map\Lib\MapResult;

/**
 * @method static $this  platform(string $platform)
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
