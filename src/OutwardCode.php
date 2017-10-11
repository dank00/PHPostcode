<?php

namespace PHPostcode;

final class OutwardCode extends Code
{
    /** @var string */
    private $area;

    /** @var string */
    private $district;

    /**
     * @param string $area
     * @param string $district
     * @throws InvalidCodeException
     */
    public function __construct(string $area, string $district)
    {
        $this->area = \strtoupper($area);
        $this->district = \strtoupper($district);

        if (!$this->isValid()) {
            throw new InvalidCodeException($this);
        }
    }

    public static function fromString(string $string): OutwardCode
    {
        $parts = str_split($string);

        $firstNumberIndex = 0;

        foreach ($parts as $index => $char) {
            if (\is_numeric($char)) {
                $firstNumberIndex = $index;
            }
        }

        return new self(
            \implode('', \array_slice($parts, 0, $firstNumberIndex)),
            \implode('', \array_slice($parts, $firstNumberIndex))
        );
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
