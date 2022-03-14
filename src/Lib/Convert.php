<?php

namespace Magein\Map\Lib;

class Convert
{
    /**
     * 判断一个经纬度坐标是否在圆内
     *
     * 思路：判断此点的经纬度到圆心的距离  然后和半径做比较
     *
     * 如果此点刚好在圆上 则返回true
     *
     * @param Location $location 经纬度坐标
     * @param Location $center 圆点的坐标
     * @param string|float|int|Location $radius 半径，单位需要换算成米，因为返回的直线距离就是米 当传递一个经纬度的时候，将自动计算半径
     * @return bool
     */
    public function inCircle(Location $location, Location $center, $radius): bool
    {
        if ($radius instanceof Location) {
            $radius = $this->lineDistance($center, $radius);
        }
        $distance = $this->lineDistance($location, $center);
        if ($distance <= $radius) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 求两个已知经纬度之间的直线距离
     * 单位为m（米）
     * @param Location $first
     * @param Location $second
     * @return int
     */
    public function lineDistance(Location $first, Location $second): int
    {
        // deg2rad()函数将角度转换为弧度
        $radLat1 = deg2rad($first->getLatitude());
        $radLat2 = deg2rad($second->getLatitude());

        $radLng1 = deg2rad($first->getLongitude());
        $radLng2 = deg2rad($second->getLongitude());
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        return intval(2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000);
    }

    /**
     * 判断一个坐标是否在一个多边形内（由多个坐标围成的）
     * 基本思想是利用射线法，计算射线与多边形各边的交点，如果是偶数，则点在多边形外，否则
     * 在多边形内。还会考虑一些特殊情况，如点在多边形顶点上，点在多边形边上等特殊情况。
     * @param Location $location 经纬度坐标
     * @param array $pts 顺时针方向
     * @return bool
     */
    public function inPolygon(Location $location, array $pts): bool
    {
        $target_lat = $location->getLatitude();
        $target_lng = $location->getLongitude();

        $N = count($pts);
        //cross points count of x
        $intersectCount = 0;
        //浮点类型计算时候与0比较时候的容差
        $precision = 2e-10;

        $p1 = $pts[0];//left vertex
        for ($i = 1; $i <= $N; ++$i) {
            if ($target_lng == $p1['lng'] && $target_lat == $p1['lat']) {
                return true;
            }

            $p2 = $pts[$i % $N];
            if ($target_lat < min($p1['lat'], $p2['lat']) || $target_lat > max($p1['lat'], $p2['lat'])) {//ray is outside of our interests
                $p1 = $p2;
                continue;
            }

            if ($target_lat > min($p1['lat'], $p2['lat']) && $target_lat < max($p1['lat'], $p2['lat'])) {//ray is crossing over by the algorithm (common part of)
                if ($target_lng <= max($p1['lng'], $p2['lng'])) {
                    if ($p1['lat'] == $p2['lat'] && $target_lng >= min($p1['lng'], $p2['lng'])) {//overlies on a horizontal ray
                        return true;
                    }
                    if ($p1['lng'] == $p2['lng']) {
                        if ($p1['lng'] == $target_lng) {
                            return true;
                        } else {
                            ++$intersectCount;
                        }
                    } else {
                        $xinters = ($target_lat - $p1['lat']) * ($p2['lng'] - $p1['lng']) / ($p2['lat'] - $p1['lat']) + $p1['lng'];//cross point of lng
                        if (abs($target_lng - $xinters) < $precision) {//overlies on a ray
                            return true;
                        }

                        if ($target_lng < $xinters) {
                            ++$intersectCount;
                        }
                    }
                }
            } else {
                if ($target_lat == $p2['lat'] && $target_lng <= $p2['lng']) {
                    $p3 = $pts[($i + 1) % $N];
                    if ($target_lat >= min($p1['lat'], $p3['lat']) && $target_lat <= max($p1['lat'], $p3['lat'])) { //p.lat lies between p1.lat & p3.lat
                        ++$intersectCount;
                    } else {
                        $intersectCount += 2;
                    }
                }
            }
            $p1 = $p2;
        }

        //偶数在多边形外
        if ($intersectCount % 2 == 0) {
            return false;
        } else {
            //奇数在多边形内
            return true;
        }
    }
}