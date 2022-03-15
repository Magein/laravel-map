<?php

namespace Magein\Map\Lib;

abstract class Map
{
    /**
     * 请求的主机地址
     * @var string
     */
    protected string $domain = '';

    /**
     * 响应结果
     * @var string
     */
    protected string $response = '';

    /**
     * 获取key
     * @return string
     */
    protected function appKey(): string
    {
        if (!$name = $this->name()) {
            return '';
        }
        $config = config('map') ?? [];
        $keys = $config[$name]['keys'];
        $mode = $config['default']['mode'] ?? 1;
        if ($mode !== 1) {
            return $keys[0] ?? '';
        }
        return $keys[rand(0, count($keys) - 1)] ?? '';
    }

    /**
     * @param string $url
     * @return string
     */
    protected function url(string $url): string
    {
        return trim($this->domain, '/') . '/' . trim($url, '/');
    }

    /**
     * @param string $url
     * @param array $params
     * @return bool|string|null
     * @throws \Exception
     */
    protected function request(string $url, array $params)
    {
        $key = $this->appKey();
        if (empty($key)) {
            new MapException('请配置keys');
            return null;
        }
        $params['key'] = $key;
        $url = $this->url($url) . '?' . urldecode(http_build_query($params));
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            new MapException(curl_errno($curl), curl_errno($curl));
            return null;
        }
        curl_close($curl);
        $this->response = $data;
        return $this->result($data);
    }

    /**
     * @param $data
     * @return mixed|string
     * @throws \Exception
     */
    protected function result($data)
    {
        if (empty($data)) {
            return [];
        }

        $data = json_decode($data, true);

        $status = $data['status'] ?? -1;

        if ($status == 0) {
            return $data['result'] ?? [];
        }

        new MapException($data['message'] ?? '');

        return [];
    }
}
