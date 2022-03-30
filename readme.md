### 平台

| 平台 | 支持 | 版本 |
| -: | -:   | -: |
| 高德 | √ | v1 | 
| 百度 | √ | v1 | 
| 腾讯 | √ | v1 |

### 使用

```php

// 根据地址获取经纬度
\Magein\Map\Facades\Map::location($address);
\Magein\Map\Facades\Map::location(['address'=>$address,'city'=>'杭州']);


// 根据经纬度获取地址
\Magein\Map\Facades\Map::address('123.456,15.1685');
\Magein\Map\Facades\Map::address(['location'=>'123.456,15.1685']);

// 根据ip获取信息
\Magein\Map\Facades\Map::ip($ip);
\Magein\Map\Facades\Map::ip(['ip'=>$ip]);

// 指定平台
new \Magein\Map\Lib\Platform\TencentMap();
new \Magein\Map\Lib\Platform\GaoDeMap();
new \Magein\Map\Lib\Platform\BaiduMap();
```

