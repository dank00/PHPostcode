<?php

namespace PHPostcode;

final class Postcode
{
    /** @var OutwardCode */
    private $outwardCode;

    /** @var InwardCode */
    private $inwardCode;

    /**
     * @param OutwardCode $outwardCode
     * @param InwardCode $inwardCode
     */
    public function __construct(OutwardCode $outwardCode, InwardCode $inwardCode)
    {
        $this->outwardCode = $outwardCode;
        $this->inwardCode = $inwardCode;
    }

    public static function fromString(string $string): Postcode
    {
        $postcode = \str_replace(' ', '', $string);

        return new self(
            OutwardCode::fromString(\substr($postcode, 0, -3)),
            InwardCode::fromString(\substr($postcode, -3))
        );
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
}
