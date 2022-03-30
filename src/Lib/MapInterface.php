<?php

namespace Magein\Map\Lib;

interface MapInterface
{
    /**
     * 平台名称
     * @return string
     */
    public function name(): string;

    /**
     * 根据经纬度获取地址
     * @param string|array $params
     * @return array
     */
    public function address($params): array;

    /**
     * 根据地址获取经纬度
     * @param string|array $params
     * @return Location
     */
    public function location($params): Location;

    /**
     * 根据IP定位城市，经纬度相关信息
     * @param string|array $params
     * @return array
     */
    public function ip($params): array;
}