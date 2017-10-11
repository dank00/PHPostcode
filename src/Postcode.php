<?php

namespace PHPostcode;

class Postcode extends Code
{
    /** @var OutwardCode */
    private $outwardCode;

    /** @var InwardCode */
    private $inwardCode;

    public function __construct(OutwardCode $outwardCode, InwardCode $inwardCode)
    {
        $this->outwardCode = $outwardCode;
        $this->inwardCode = $inwardCode;
    }

    public function getOutwardCode(): OutwardCode
    {
        return $this->outwardCode;
    }

    public function getInwardCode(): InwardCode
    {
        return $this->inwardCode;
    }

    public function toString(): string
    {
        return sprintf(
            '%s %s',
            $this->outwardCode->toString(),
            $this->inwardCode->toString()
        );
    }

    public function equals($object): bool
    {
        return $object instanceof self
            && $this->toString() === $object->toString();
    }

    public function getValidFormats(): array
    {
        return ['AN NAA', 'ANN NAA', 'AANN NAA', 'ANA NAA', 'AANA NAA'];
    }
}
