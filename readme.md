### 地图

1. 百度
2. 高德
3. 腾讯

### 使用

```php

// 根据地址获取经纬度
\Magein\Map\Facades\Map::address();
\Magein\Map\Facades\Map::location();
\Magein\Map\Facades\Map::ip();

// 指定平台
$platform=new \Magein\Map\Lib\Platform\TencentPlatform();
$platform->address();

// 计算经纬度坐标的直线距离
\Magein\Map\Facades\Map::convert()->lineDistance();
// 计算经纬度是否处于一个园内
\Magein\Map\Facades\Map::convert()->inCircle();
// 计算经纬度是否处于一个多边形中
\Magein\Map\Facades\Map::convert()->inPolygon();

```