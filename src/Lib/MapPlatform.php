<?php

namespace Magein\Map\Lib;

interface MapPlatform
{
    /**
     * 平台名称
     * @return string
     */
    public function name(): string;

    /**
     * 根据地址获取经纬度
     * @param string|array $params
     */
    public function address($params);

    /**
     * 根据经纬度获取地址
     * @param string|array $params
     */
    public function location($params);

    /**
     * 根据IP定位城市，经纬度相关信息
     * @param string|array $params
     */
    public function ip($params);
}