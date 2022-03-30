<?php

namespace Magein\Map\Facades;

use Illuminate\Support\Facades\Facade;
use Magein\Map\Lib\Location;

/**
 * @method static array address($params)
 * @method static Location location($params)
 * @method static array ip($params)
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
