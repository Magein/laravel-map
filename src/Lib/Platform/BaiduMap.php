<?php

namespace Magein\Map\Lib\Platform;

use Magein\Map\Lib\Location;
use Magein\Map\Lib\MapAddress;
use Magein\Map\Lib\MapInterface;
use Magein\Map\Lib\MapPlatform;

class BaiduMap extends MapPlatform implements MapInterface
{
    /**
     * 请求地址
     * @var string
     */
    protected string $domain = 'https://api.map.baidu.com';

    protected string $sign_field = 'ak';

    public function name(): string
    {
        return 'baidu';
    }

    public function address($params): MapAddress
    {
        if (is_string($params)) {
            $location = $params;
            $params = [];
        } else {
            $location = $params['location'] ?? '';
        }

        $location = new Location(trim($location));
        $params['location'] = $location->getLatitude() . ',' . $location->getLongitude();

        $data = $this->request('reverse_geocoding/v3', $params);

        $info = $data['result']['addressComponent'] ?? [];

        $mapAddress = new MapAddress($data);
        $mapAddress->setProvince($info['province']);
        $mapAddress->setCity($info['city']);
        $mapAddress->setDistrict($info['district']);

        return $mapAddress;
    }

    public function location($params): Location
    {
        if (is_string($params)) {
            $address = $params;
            $params = [];
            $params['address'] = $address;
        }

        $data = $this->request('geocoding/v3', $params);
        $location = $data['result']['location'] ?? '';

        return new Location($location);
    }

    public function ip($params): MapAddress
    {
        if (is_string($params)) {
            $ip = $params;
            $params = [];
            $params['ip'] = trim($ip);
        }

        $data = $this->request('location/ip', $params);

        $info = $data['content']['address_detail'] ?? [];
        $mapAddress = new MapAddress($data);
        $mapAddress->setProvince($info['province']);
        $mapAddress->setCity($info['city']);
        $mapAddress->setDistrict($info['district']);

        return $mapAddress;
    }

    /**
     * @param $data
     * @return mixed|string
     * @throws \Exception
     */
    protected function result($data)
    {
        if (empty($data)) {
            return [];
        }

        // 返回结果状态值， 成功返回0
        $data = json_decode($data, true);

        $status = $data['status'] ?? -1;

        if ($status == 0) {
            return $data ?? [];
        }
        $info = $this->name() . ' map error : ' . ($data['message'] ?? '');

        $this->setError($info);

        return [];
    }
}
