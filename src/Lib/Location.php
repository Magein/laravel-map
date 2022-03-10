<?php

namespace Magein\Map\Lib;

/**
 * 仅适用中国地区
 *
 * 中国的经纬度范围大约为：
 * 纬度: 3.86~53.5
 * 经度: 73.66~135.05
 *
 */
class Location
{
    /**
     * 经度
     * @var string
     */
    protected string $longitude = '';

    /**
     * 纬度
     * @var string
     */
    protected string $latitude = '';

    /**
     * Location constructor.
     * @param null|string|array|static $data
     */
    public function __construct($data = null)
    {
        $this->parse($data);
    }

    /**
     * 经度
     * @return string
     */
    public function longitude()
    {
        return $this->longitude;
    }

    /**
     * 维度
     * @return string
     */
    public function latitude()
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function toString()
    {
        if ($this->longitude && $this->latitude) {
            return $this->longitude . ',' . $this->latitude;
        }

        return '';
    }

    /**
     * @param bool|int $flag
     * @return array
     */
    public function toArray($flag = true): array
    {
        $data = [
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];

        if ($flag) {
            $data = array_values($data);
        }

        return $data;
    }

    /**
     * @param $location
     * @return null
     */
    private function parse($location)
    {
        if (empty($location)) {
            return null;
        }

        if ($location instanceof static) {
            $location = $location->toArray();
        } elseif (is_string($location)) {
            $location = explode(',', $location);
        } elseif (is_object($location)) {
            $location = json_decode($location, true);
        }

        $location = array_filter($location);

        if (count($location) < 2) {
            return null;
        }

        $location = array_values($location);
        $first = $location[0] ?? 0;
        $second = $location[1] ?? 0;
        /**
         * 判断条件 纬度 3.86~53.55，经度 73.66~135.05
         */
        if ($first > 70) {
            $this->longitude = $first;
            $this->latitude = $second;
        } else {
            $this->latitude = $second;
            $this->longitude = $first;
        }

        return null;
    }
}
