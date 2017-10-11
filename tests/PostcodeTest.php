<?php

namespace PHPostcode\Test;

use PHPostcode\InvalidCodeException;
use PHPostcode\InwardCode;
use PHPostcode\OutwardCode;
use PHPostcode\Postcode;
use PHPUnit\Framework\TestCase;

class PostcodeTest extends TestCase
{
    /**
     * @param $expected
     * @param $input
     * @dataProvider dataForTestFromString
     */
    public function testFromString($expected, $input)
    {
        self::assertEquals($expected, Postcode::fromString($input)->toString());
    }

    public function dataForTestFromString()
    {
        return [
            ['CW8 4BW', 'CW8 4BW'],
            ['CW8 4BW', 'CW84BW'],
            ['M3 2JA', 'm32ja'],
            ['M1 1AA', 'M1 1AA'],
            ['M60 1NW', 'M60 1NW'],
            ['CR2 6XH', 'CR2 6XH'],
            ['DN55 1PT', 'DN55 1PT'],
            ['W1A 1HQ', 'W1A 1HQ'],
            ['EC1A 1BB', 'EC1A 1BB'],
        ];
    }

    /**
     * @param $input
     * @dataProvider dataForTestFromBadString
     */
    public function testFromBadStringString($input)
    {
        $this->expectException(InvalidCodeException::class);
        Postcode::fromString($input);
    }

    public function dataForTestFromBadString()
    {
        return [
            [';nflenfw'],
            [''],
            [' '],
            ['&&&'],
            ['lemon']
        ];
    }

    public function testFormat()
    {
        self::assertEquals('AAN NAA', self::getMumsPostcode()->getFormat());
    }

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


    public function testEquals()
    {
        self::assertFalse(self::getMumsPostcode()->equals(self::getWorkPostcode()));
        self::assertTrue(self::getMumsPostcode()->equals(self::getMumsPostcode()));
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
}
