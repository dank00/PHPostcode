<?php

namespace PHPostcode;


class InwardCode
{
    /** @var int */
    private $sector;

    /** @var string */
    private $unit;

    public function __construct(int $sector, string $unit)
    {
        $this->sector = $sector;
        $this->unit = $unit;
    }

    public function getSector(): int
    {
        return $this->sector;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function toString(): string
    {
        return $this->sector . $this->unit;
    }
}
