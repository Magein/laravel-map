<?php

namespace Magein\Map\Lib;

use Magein\Map\Lib\Platform\MapPlatform;
use Magein\Map\Lib\Platform\TencentPlatform;

class Map
{
    /**
     * 使用的平台
     * @var MapPlatform|string
     */
    protected $platform = '';

    public function __construct()
    {
        $platform = config('map.default') ?? TencentPlatform::class;
        $this->platform = new $platform();
    }

    public function address(string $address, $other = [])
    {
        return $this->platform->address($address, $other);
    }

    public function location(string $location, $other = [])
    {
        return $this->platform->location($location, $other);
    }

    public function ip(string $ip, array $other = [])
    {
        return $this->platform->ip($ip, $other);
    }

    /**
     * @return Convert
     */
    public function convert(): Convert
    {
        return new Convert();
    }
}
