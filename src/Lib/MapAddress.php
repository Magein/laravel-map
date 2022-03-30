<?php

namespace Magein\Map\Lib;


class MapAddress implements \ArrayAccess
{
    /**
     * @var string
     */
    protected string $province = '';

    /**
     * @var string
     */
    protected string $city = '';

    /**
     * @var string
     */
    protected string $district = '';

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     */
    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function toString($sp = ','): string
    {
        return implode($sp, $this->toArray());
    }

    public function toArray(): array
    {
        return [
            $this->province,
            $this->city,
            $this->district
        ];
    }

    public function offsetExists($offset)
    {

    }

    public function offsetGet($offset)
    {

    }

    public function offsetSet($offset, $value)
    {

    }

    public function offsetUnset($offset)
    {

    }
}