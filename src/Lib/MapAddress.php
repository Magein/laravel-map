<?php

namespace Magein\Map\Lib;


class MapAddress implements \ArrayAccess
{
    protected array $origin = [];

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
     * 拼接好的地址
     * @var string
     */
    protected string $address = '';

    public function __construct($origin = null)
    {
        $this->origin = $origin;
    }

    /**
     * @return array|mixed|null
     */
    public function getOrigin()
    {
        return $this->origin;
    }

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
        return trim(implode($sp, $this->toArray()), $sp);
    }

    public function getAddress()
    {
        return $this->toString('');
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
        if (property_exists($this, $offset)) {
            return true;
        }

        return false;
    }

    public function offsetGet($offset)
    {
        if (property_exists($this, $offset)) {
            $offset = 'get' . ucfirst($offset);
            return $this->$offset();
        }

        return null;
    }

    public function offsetSet($offset, $value)
    {

    }

    public function offsetUnset($offset)
    {

    }
}
