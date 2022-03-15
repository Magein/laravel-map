<?php

namespace Magein\Map\Lib;

use Magein\Common\Finish;

trait MapRequest
{
    /**
     * @return string
     */
    protected function name(): string
    {
        return '';
    }

    /**
     * 获取key
     * @return string
     */
    protected function appKey(): string
    {
        $name = $this->name();
        if (!$name) {
            return '';
        }
        $config = config('map') ?? [];
        $keys = $config[$name]['keys'];
        if (($config['default']['mode'] ?? 1) === 1) {
            return $keys[rand(0, count($keys) - 1)] ?? '';
        }
        return $keys[0] ?? '';
    }

    /**
     * @param string $url
     * @return string
     */
    protected function url(string $url): string
    {
        $key = $this->appKey();
        if (empty($key)) {
            return '';
        }
        $url = trim($url, '/');
        $url = trim($this->domain, '/') . '/' . $url;
        return $url . '?key=' . $key;
    }

    /**
     * @param string $url
     * @param array $params
     * @param string $method
     * @return Finish
     */
    protected function request(string $url, array $params, string $method = 'get'): Finish
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $url = $this->url($url);
        if (empty($url)) {
            return Finish::error('请在配置文件中添加keys');
        }
        if ($method == 'get') {
            $url = $url . '&' . urldecode(http_build_query($params));
        } else {
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            return Finish::error(curl_errno($curl), curl_error($curl));
        }
        curl_close($curl);
        return Finish::success($data);
    }
}