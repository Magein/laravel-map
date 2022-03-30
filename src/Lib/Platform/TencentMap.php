<?php

namespace Magein\Map\Lib\Platform;

use Magein\Map\Lib\Location;
use Magein\Map\Lib\MapAddress;
use Magein\Map\Lib\MapInterface;
use Magein\Map\Lib\MapPlatform;

class TencentMap extends MapPlatform implements MapInterface
{
    /**
     * 请求地址
     * @var string
     */
    protected string $domain = 'https://apis.map.qq.com';

    /**
     * @return string
     */
    public function name(): string
    {
        return 'tencent';
    }

    /**
     * @param $params
     * @return MapAddress
     * @throws \Exception
     */
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

        $data = $this->request('ws/geocoder/v1/', $params);

        $info = $data['ad_info'] ?? [];
        $mapAddress = new MapAddress($data);
        $mapAddress->setProvince($info['province'] ?? '');
        $mapAddress->setCity($info['city'] ?? '');
        $mapAddress->setDistrict($info['district'] ?? '');
        $mapAddress->setAddress($data['address'] ?? '');

        return $mapAddress;
    }

    /**
     * @param $params
     * @return Location
     * @throws \Exception
     */
    public function location($params): Location
    {
        if (is_string($params)) {
            $address = $params;
            $params = [];
            $params['address'] = $address;
        }

        $data = $this->request('ws/geocoder/v1/', $params);

        return new Location($data['location'] ?? '');
    }

    /**
     * @param $params
     * @return MapAddress
     * @throws \Exception
     */
    public function ip($params): MapAddress
    {
        if (is_string($params)) {
            $ip = $params;
            $params = [];
            $params['ip'] = trim($ip);
        }

        $data = $this->request('ws/location/v1/ip', $params);
        $info = $data['ad_info'] ?? [];

        $mapAddress = new MapAddress($data);
        $mapAddress->setProvince($info['province']);
        $mapAddress->setCity($info['city']);

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

        $data = json_decode($data, true);

        $status = $data['status'] ?? -1;

        if ($status == 0) {
            return $data['result'] ?? [];
        }

        $this->setError($data['message'] ?? '');

        return [];
    }
}
