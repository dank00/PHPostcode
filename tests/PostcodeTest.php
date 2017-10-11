<?php

namespace PHPostcode\Test;

use PHPostcode\InwardCode;
use PHPostcode\OutwardCode;
use PHPostcode\Postcode;
use PHPUnit\Framework\TestCase;

class PostcodeTest extends TestCase
{
    public function testToString()
    {
        self::assertEquals('CW8 4BW', self::getMumsPostcode()->toString());
    }

    public function testGetOutwardCode()
    {
        self::assertEquals(
            'CW8',
            self::getMumsPostcode()->getOutwardCode()->toString()
        );
    }

    public function testGetInwardCode()
    {
        self::assertEquals(
            '4BW',
            self::getMumsPostcode()->getInwardCode()->toString()
        );
    }

    public static function getMumsPostcode(): Postcode
    {
        return new Postcode(
            new OutwardCode('CW', 8),
            new InwardCode(4, 'BW')
        );
    }

    public static function getWorkPostcode(): Postcode
    {
        return new Postcode(
            new OutwardCode('M', 3),
            new InwardCode(2, 'JA')
        );
    }

    public function testEquals()
    {
        self::assertFalse(self::getMumsPostcode()->equals(self::getWorkPostcode()));
        self::assertTrue(self::getMumsPostcode()->equals(self::getMumsPostcode()));
    }
}
