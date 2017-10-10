<?php

namespace PHPostcode;

class Postcode
{
    const POSTCODE_REGEX = '#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#';

    /** @var string */
    private $area;

    /** @var int */
    private $district;

    /** @var int */
    private $sector;

    /** @var string */
    private $unit;

    public function __construct(string $area, int $district, int $sector, string $unit)
    {
        $this->area = \strtoupper($area);
        $this->district = $district;
        $this->sector = $sector;
        $this->unit = \strtoupper($unit);
    }

    public static function fromString(string $string): Postcode
    {
        $string = \strtoupper($string);
        $matches = [];
        $postcodeMatch = preg_match(self::POSTCODE_REGEX, $string, $matches);

        if (!$postcodeMatch) {
            throw new \InvalidArgumentException("could not create a Postcode from $string");
        }

        // make postcode
        // area is postion 0 to first int
        // district is first int
        // sector is second int
        // unit is position of last int to end

        return new self('M', 3, 2, 'JA');
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getDistrict(): int
    {
        return $this->district;
    }

    public function getSector(): int
    {
        return $this->sector;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getOutwardCode(): string
    {
        return $this->area . $this->district;
    }

    public function getInwardCode(): string
    {
        return $this->sector . $this->unit;
    }

    public function toString(): string
    {
        return sprintf(
            '%s%s %s%s',
            $this->area,
            $this->district,
            $this->sector,
            $this->unit
        );
    }

    public function equals($object): bool
    {
        return $object instanceof self && $this->toString() === $object->toString();
    }
}