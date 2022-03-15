<?php

namespace Magein\Map\Lib\Platform;

use Magein\Common\Finish;

interface MapPlatform
{
    /**
     * 平台名称
     * @return string
     */
    public function name(): string;

    /**
     * 根据地址获取经纬度
     * @param string $address 地址
     * @param array|string $other 其他参数，传递字符串的时候，识别成城市
     * @return mixed
     */
    public function address(string $address, $other = []);

    /**
     * 根据经纬度获取地址
     * @param $location
     * @param array $other
     * @return mixed
     */
    public function location($location, array $other = []);

    /**
     * 根据IP定位城市，经纬度相关信息
     * @param string $ip
     * @param array $other
     * @return mixed
     */
    public function ip(string $ip, array $other = []);
}