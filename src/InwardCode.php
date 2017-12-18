<?php

namespace PHPostcode;


final class InwardCode extends Code
{
    /** @var int */
    private $sector;

    /** @var string */
    private $unit;

    /**
     * @param int $sector
     * @param string $unit
     * @throws InvalidCodeException
     */
    public function __construct(int $sector,
                                string $unit)
    
    
    
    
    
    {
        $this->sector = $sector;
        $this->unit = \strtoupper($unit);

        if (!$this->isValid()) {
            throw new InvalidCodeException($this);
        }
    }

    public static function fromString(string $string): InwardCode
    {
        $parts = \str_split($string);
        return new self(\array_shift($parts), implode('', $parts));
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

    public function getValidFormats(): array
    {
        return [ 'NAA' ];
    }
}
