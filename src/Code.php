<?php

namespace PHPostcode;

abstract class Code
{
    abstract public function toString(): string;

    abstract public function getValidFormats(): array;

    public function getFormat(): string
    {
        $parts = \str_split($this->toString());
        return \implode('', array_map(
            function ($character) {
                if ($character === ' ') {
                    return $character;
                }
                return \is_numeric($character) ? 'N' : 'A';
            },
            $parts
        ));
    }

    public function isValid(): bool
    {
        return \in_array(
            $this->getFormat(),
            $this->getValidFormats(),
            true
        );
    }
}
