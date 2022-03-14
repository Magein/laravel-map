<?php

namespace Magein\Map\Lib\Platform;

use Magein\Map\Lib\MapResult;

abstract class MapPlatform
{
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

    abstract public function name(): string;

    /**
     * 根据地址获取经纬度
     * @param string $address 地址
     * @param array|string $other 其他参数，传递字符串的时候，识别成城市
     * @return mixed
     */
    abstract public function address(string $address, $other = []);

    /**
     * 根据经纬度获取地址
     * @param $location
     * @param array $other
     * @return mixed
     */
    abstract public function location($location, array $other = []);

    /**
     * 根据IP定位城市，经纬度相关信息
     * @param string $ip
     * @param array $other
     * @return mixed
     */
    abstract public function ip(string $ip, array $other = []);

    protected function appKey(): string
    {
        $name = $this->name();
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
}