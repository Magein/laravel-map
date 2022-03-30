<?php

namespace Magein\Map\Lib\Platform;

use Magein\Map\Lib\Location;
use Magein\Map\Lib\MapInterface;
use Magein\Map\Lib\MapPlatform;

class GaoDeMap extends MapPlatform implements MapInterface
{

    public function name(): string
    {
        return 'gaode';
    }

    public function address($params): array
    {
        return [];
    }

    public function location($params): Location
    {
        return new Location();
    }

    public function ip($params): array
    {
        return [];
    }
}