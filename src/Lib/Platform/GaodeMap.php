<?php

namespace Magein\Map\Lib\Platform;

use Magein\Common\Location;
use Magein\Map\Lib\MapPlatform;

class GaodeMap implements MapPlatform
{

    public function name(): string
    {
        return 'gaode';
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