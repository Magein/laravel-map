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

    /**
     * 主机地址
     * @var string
     */
    protected string $domain = '';

    /**
     * 请求地址
     * @var string
     */
    public string $url = '';

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

    public function __construct()
    {
        $platform = config('map.default') ?? TencentPlatform::class;
        $this->platform($platform);
    }

    /**
     * @param string $platform
     * @return $this
     */
    public function platform(string $platform): Map
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * 获取key
     * @return string
     */
    protected function appKey(): string
    {
        $name = $this->platform->name();
        if (!$name) {
            return '';
        }
        $config = config('map') ?? [];
        $key_mode = $config['default']['key_mode'] ?? 1;
        $keys = $config[$name]['keys'];
        if ($key_mode == 1) {
            return $keys[rand(0, count($keys))] ?? '';
        }
        return $keys[0] ?? '';
    }

    /**
     * @param string $url
     * @return string
     */
    protected function url(string $url): string
    {
        return trim($this->domain, '/') . '/' . trim($url, '/') . '?key=' . $this->appKey();
    }

    /**
     * @param $url
     * @param $params
     * @param string $method
     * @return bool|MapResult|string
     */
    protected function request($url, $params, string $method = 'get')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $url = $this->url($url);
        if ($method == 'get') {
            $url = $url . '&' . urldecode(http_build_query($params));
        } else {
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }

        $this->url = $url;

        curl_setopt($curl, CURLOPT_URL, $url);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            return new MapResult(curl_errno($curl), curl_error($curl));
        }
        curl_close($curl);

        return $data;
    }

    /**
     * @return Convert
     */
    public function convert()
    {
        return new Convert();
    }

    public function __call($name, $arguments)
    {
        try {
            $this->platform->$name($arguments);
        } catch (\Exception $exception) {

        }
    }
}
