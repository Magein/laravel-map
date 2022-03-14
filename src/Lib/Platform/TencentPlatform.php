<?php

namespace Magein\Map\Lib\Platform;

use Magein\Map\Lib\Location;

class TencentPlatform extends MapPlatform
{
    protected string $domain = 'https://apis.map.qq.com';

    public function name(): string
    {
        return 'tencent';
    }

    public function address(string $address, $other = [])
    {
        $params['address'] = $address;
        if (is_string($other)) {
            $params['region'] = $other;
        } else {
            $params = array_merge($params, $other);
        }

        $data = $this->request('ws/geocoder/v1/', $params);

        return $this->content['location'] ?? '';
    }

    public function location($location, array $other = [])
    {
        $location = new Location($location);

        $params['location'] = $location->getLatitude() . ',' . $location->getLongitude();

        $this->request('ws/geocoder/v1/', $params);

        return $this->content['address'] ?? '';
    }

    public function ip(string $ip = '', array $other = [])
    {
        $other['ip'] = $ip;

        $this->request('ws/location/v1/ip', $other);

        return $this->content;
    }
}
