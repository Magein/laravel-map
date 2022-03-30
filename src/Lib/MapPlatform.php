<?php

namespace Magein\Map\Lib;

abstract class MapPlatform
{
    /**
     * 请求的主机地址
     * @var string
     */
    protected string $domain = '';

    /**
     * 身份标识
     * @var string
     */
    protected string $sign_field = 'key';

    /**
     * 返回值类型标识
     * @var string
     */
    protected string $output_field = 'output';

    /**
     * 返回值类型
     * @var string
     */
    protected string $output = 'json';

    /**
     * 响应结果
     * @var string
     */
    protected string $response = '';

    protected function setError($message, $code = 1)
    {
        $debug = config('map.debug');
        if ($debug) {
            throw new \Exception($message, $code);
        }
        return null;
    }

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
            return $this->setError('请配置keys');
        }
        $params[$this->sign_field] = $key;
        $params[$this->output_field] = $this->output;
        $url = $this->url($url) . '?' . urldecode(http_build_query($params));

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        
        if (curl_errno($curl)) {
            curl_close($curl);
            return $this->setError(curl_errno($curl), curl_errno($curl));
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
        return [];
    }
}
