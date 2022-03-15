<?php

namespace Magein\Map\Lib\Platform;

use Magein\Common\Location;
use Magein\Map\Lib\MapPlatform;
use Magein\Map\Lib\Map;

class BaiduMap extends Map implements MapPlatform
{

    public function name(): string
    {
        return 'baidu';
    }

    public function address($params): Location
    {
        return new Location();
    }

    public function location($params): array
    {
        return [];
    }

    public function ip($params): array
    {
        return [];
    }
}