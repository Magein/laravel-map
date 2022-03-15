<?php

namespace Magein\Map\Lib\Platform;

use Magein\Common\Location;
use Magein\Map\Lib\Map;
use Magein\Map\Lib\MapPlatform;

class TencentMap extends Map implements MapPlatform
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
     * @return Location
     * @throws \Exception
     */
    public function address($params)
    {
        if (is_string($params)) {
            $address = $params;
            $params = [];
            $params['address'] = $address;
        }

        $data = $this->request('ws/geocoder/v1/', $params);

        return new Location($data['location'] ?? '');
    }

    public function location($params): array
    {
        if (is_string($params)) {
            $location = $params;
            $params = [];
        } else {
            $location = $params['location'] ?? '';
        }

        $location = new Location($location);

        $params['location'] = $location->getLatitude() . ',' . $location->getLongitude();

        $this->request('ws/geocoder/v1/', $params);

        return $result['address'] ?? [];
    }

    public function ip($params): array
    {
        if (is_string($params)) {
            $ip = $params;
            $params = [];
            $params['ip'] = $ip;
        }

        $result = $this->request('ws/location/v1/ip', $params);

        return $result['result'] ?? [];
    }
}
