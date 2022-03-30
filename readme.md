### 平台

 | 平台 | 支持 | 版本 |
 | -: | -:   | -: | 
 | 高德 | √ | v1 | 
 | 百度 | √ | v3 | 
 | 腾讯 | √ | v3 |

版本说明：版本是第三方平台api接口的版本

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

### 返回值

Location 、 MapAddress 均实现了 ArrayAccess 抽象类，所以可以通过数组获取相关属性

经纬度取值

```php
$res=\Magein\Map\Facades\Map::location($address);

echo $res->getLatitude();
echo $res->getLongitude();
echo $res['lat'];
echo $res['lng'];

echo $res->toString();
print_r($res->toArray())

// ip、address均返回 MapAddress 实例
$res=\Magein\Map\Facades\Map::address('123.456,15.1685');
echo $res->getProvince();
echo $res['province'];
 
echo $res->getCity(); 
echo $res->getDistrict(); 
echo $res->getAddress(); 
echo $res['address'];
echo $res->toString();
print_r($res->toArray());
// 这里返回的是第三方平台返回的原始数据
print_r($res->getOrigin());

// 通过ip定位一般是定位到城市，所以district一般为空
$res=\Magein\Map\Facades\Map::ip($ip);
echo $res->getProvince();
echo $res['province'];
echo $res->getCity(); 
echo $res->toString();
print_r($res->toArray());
// 这里返回的是第三方平台返回的原始数据
print_r($res->getOrigin());

```

