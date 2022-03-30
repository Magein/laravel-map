<?php

namespace Magein\Map\Facades;

use Illuminate\Support\Facades\Facade;
use Magein\Map\Lib\Location;
use Magein\Map\Lib\MapAddress;

/**
 * @method static MapAddress address($params)
 * @method static Location location($params)
 * @method static MapAddress ip($params)
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
