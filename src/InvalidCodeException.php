<?php

namespace PHPostcode;

class InvalidCodeException extends \Exception
{
    public function __construct(Code $failingCode)
    {
        $message = sprintf(
            '%s format:(%s) does not match a valid format (%s)',
            $failingCode->toString(),
            $failingCode->getFormat(),
            implode(',', $failingCode->getValidFormats())
        );
        
        parent::__construct($message);
    }
}
