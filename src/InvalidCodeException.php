<?php

namespace PHPostcode;

class InvalidCodeException extends \Exception
{
    public function __construct(
        Code $failingCode,
        $code = 0,
        \Throwable $previous = null
    ) {
        $message = sprintf(
            '%s format:(%s) does not match a valid format (%s)',
            $failingCode->toString(),
            $failingCode->getFormat(),
            implode(',', $failingCode->getValidFormats())
        );
        parent::__construct($message, $code, $previous);
    }
}
