<?php

namespace Magein\Map\Lib;

use Magein\Map\Lib\Platform\MapPlatform;

class Map
{
    /**
     * @var string
     */
    protected $platform = '';

    /**
     * 响应值
     * @var string
     */
    public string $response = '';

    /**
     * 响应内容
     * @var array
     */
    public array $content = [];

    /**
     * 最后请求的url地址
     * @var string
     */
    public string $url = '';

    /**
     * @var string
     */
    protected string $domain = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * @param string $platform
     * @return $this
     */
    public function platform(string $platform)
    {
        $this->platform = $platform;

        return $this;
    }
}
