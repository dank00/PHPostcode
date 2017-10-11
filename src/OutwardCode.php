<?php

namespace PHPostcode;

class OutwardCode
{
    /** @var string */
    private $area;

    /** @var int */
    private $district;

    public function __construct(string $area, int $district)
    {
        $this->area = $area;
        $this->district = $district;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getDistrict(): int
    {
        return $this->district;
    }

    public function toString(): string
    {
        return $this->area . $this->district;
    }
}
