<?php

namespace PHPostcode;

final class OutwardCode extends Code
{
    /** @var string */
    private $area;

    /** @var string */
    private $district;

    public function __construct(string $area, string $district)
    {
        $this->area = $area;
        $this->district = $district;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function toString(): string
    {
        return $this->area . $this->district;
    }

    public function getValidFormats(): array
    {
        return ['AN', 'ANN', 'AAN', 'AANN', 'ANA', 'AANA'];
    }
}
