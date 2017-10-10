<?php

namespace PHPostcode\Test;

use PHPostcode\Postcode;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

class PostcodeTest extends TestCase
{
    public function testItExists()
    {
        self::assertInstanceOf(
            Postcode::class,
            self::getMumsPostcode()
        );
    }

    public function testGetters()
    {
        self::assertEquals(
            'CW',
            self::getMumsPostcode()->getArea()
        );

        self::assertEquals(
            8,
            self::getMumsPostcode()->getDistrict()
        );

        self::assertEquals(
            4,
            self::getMumsPostcode()->getSector()
        );

        self::assertEquals(
            'BW',
            self::getMumsPostcode()->getUnit()
        );
    }

    public function testToString()
    {
        self::assertEquals('CW8 4BW', self::getMumsPostcode()->toString());
    }

    public function testGetOutwardCode()
    {
        self::assertEquals('CW8', self::getMumsPostcode()->getOutwardCode());
    }

    public function testGetInwardCode()
    {
        self::assertEquals('4BW', self::getMumsPostcode()->getInwardCode());
    }

    public static function getMumsPostcode(): Postcode
    {
        return new Postcode('CW', 8, 4, 'BW');
    }

    public static function getWorkPostcode(): Postcode
    {
        return new Postcode('M', 3, 2, 'JA');
    }

    /**
     * @expectedException \Exception
     * @dataProvider badStrings
     */
    public function testFromStringWithBadString(string $input)
    {
        Postcode::fromString($input);
    }

    public function badStrings(): array
    {
        return [
            ['m33322qq'],
            ['M£ 2JA'],
            [''],
            ['M123 ABS'],

        ];
    }

    /**
     * @param Postcode $expected
     * @param $input
     * @dataProvider dataForFromString
     */
    public function testFromString(Postcode $expected, $input)
    {
        self::assertTrue($expected->equals(Postcode::fromString($input)));
    }

    public function dataForFromString(): array
    {
        return [
//            [self::getWorkPostcode(), 'M3 2JA'],
//            [self::getWorkPostcode(), 'm3 2Ja'],
//            [self::getMumsPostcode(), 'cw84bw']
        ];

    }

    public function testEquals()
    {
        self::assertFalse(self::getMumsPostcode()->equals(self::getWorkPostcode()));
        self::assertTrue(self::getMumsPostcode()->equals(self::getMumsPostcode()));
    }
}
