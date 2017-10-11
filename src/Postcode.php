<?php

namespace PHPostcode;

final class Postcode extends Code
{
    /** @var OutwardCode */
    private $outwardCode;

    /** @var InwardCode */
    private $inwardCode;

    /**
     * @param OutwardCode $outwardCode
     * @param InwardCode $inwardCode
     * @throws InvalidCodeException
     */
    public function __construct(OutwardCode $outwardCode, InwardCode $inwardCode)
    {
        $this->outwardCode = $outwardCode;
        $this->inwardCode = $inwardCode;

        if (!$this->isValid()) {
            throw new InvalidCodeException($this);
        }
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

    public function getValidFormats(): array
    {
        return ['AN NAA', 'AAN NAA', 'ANN NAA', 'AANN NAA', 'ANA NAA', 'AANA NAA'];
    }
}
