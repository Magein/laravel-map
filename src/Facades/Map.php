<?php

namespace Magein\Map\Facades;

use Illuminate\Support\Facades\Facade;
use Magein\Map\Lib\Location;

/**
 * @method static Location address($params)
 * @method static array location($params)
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
