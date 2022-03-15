<?php

namespace Magein\Map\Lib;

use Magein\Common\Location;

class MapFactory
{
    /**
     * 主机地址
     * @var string
     */
    protected string $domain = '';

    /**
     * 响应值
     * @var string
     */
    protected string $response = '';

    /**
     * @var MapPlatform
     */
    protected $platform = null;
    
    public function __construct()
    {
        $platform = config('map.default.platform');

        $this->platform = new $platform();
    }

    public function address($params): Location
    {
        return $this->platform->address($params);
    }

    public function ip($params): array
    {
        return $this->platform->ip($params);
    }

    public function location($params): array
    {
        return $this->platform->location($params);
    }

}