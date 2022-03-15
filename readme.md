### 地图

1. 百度
2. 高德
3. 腾讯

### 使用

```php

// 根据地址获取经纬度
\Magein\Map\Facades\Map::address($address);
\Magein\Map\Facades\Map::address(['address'=>$address,'city'=>'杭州']);
// 根据经纬度获取地址
\Magein\Map\Facades\Map::location('123.456,15.1685');
\Magein\Map\Facades\Map::location(['location'=>'123.456,15.1685']);
// 根据ip获取信息
\Magein\Map\Facades\Map::ip($ip);
\Magein\Map\Facades\Map::ip(['ip'=>$ip]);

// 指定平台
new \Magein\Map\Lib\Platform\TencentMap();
new \Magein\Map\Lib\Platform\GaodeMap();
new \Magein\Map\Lib\Platform\BaiduMap();
```