<?php

namespace Magein\Map\Lib\Platform;

use Magein\Map\Lib\Location;
use Magein\Map\Lib\MapAddress;
use Magein\Map\Lib\MapInterface;
use Magein\Map\Lib\MapPlatform;

class GaoDeMap extends MapPlatform implements MapInterface
{
    /**
     * 请求地址
     * @var string
     */
    protected string $domain = 'https://restapi.amap.com';

    public function name(): string
    {
        return 'gaode';
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
        $params['location'] = $location->getLongitude() . ',' . $location->getLatitude();
        $data = $this->request('v3/geocode/regeo', $params);

        $info = $data['regeocode']['addressComponent'] ?? [];
        $mapAddress = new MapAddress($data);
        $mapAddress->setProvince($info['province']);
        $mapAddress->setCity($info['city']);
        $mapAddress->setDistrict($info['district']);
        $mapAddress->setAddress($data['regeocode']['formatted_address']);

        return $mapAddress;
    }

    public function location($params): Location
    {
        if (is_string($params)) {
            $address = $params;
            $params = [];
            $params['address'] = $address;
        }

        $data = $this->request('v3/geocode/geo', $params);

        $location = '';
        if (isset($data['geocodes']) && count($data['geocodes']) > 0) {
            $location = $data['geocodes'][0]['location'];
        }

        return new Location($location);
    }

    public function ip($params): MapAddress
    {
        if (is_string($params)) {
            $ip = $params;
            $params = [];
            $params['ip'] = trim($ip);
        }

        $data = $this->request('v3/ip', $params);

        $mapAddress = new MapAddress($data);
        $mapAddress->setProvince($data['province']);
        $mapAddress->setCity($data['city']);

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

        // 返回值为 0 或 1，0 表示请求失败；1 表示请求成功。
        $data = json_decode($data, true);

        $status = $data['status'] ?? 0;

        if ($status == 1) {
            return $data ?? [];
        }

        $info = $this->name() . ' map error : ' . ($data['info'] ?? '');

        $this->setError($info);

        return [];
    }
}
