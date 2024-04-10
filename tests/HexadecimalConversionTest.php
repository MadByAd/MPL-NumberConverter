<?php

use MadByAd\MPLNumberConverter\Exceptions\HexadecimalInvalidValueException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class HexadecimalConversionTest extends TestCase
{

    /**
     * Test whether we can convert a number to hexadecimal
     */

    public function testCanConvertNumberToHexadecimal()
    {

        $this->assertSame("A", NumberConverter::numberToHexadecimal(10));
        $this->assertSame("9F", NumberConverter::numberToHexadecimal(159));
        $this->assertSame("4B0", NumberConverter::numberToHexadecimal(1200));
        $this->assertSame("4b0", NumberConverter::numberToHexadecimal(1200, false));
        $this->assertNotSame("4B0", NumberConverter::numberToHexadecimal(1200, false));

    }

    /**
     * Test whether we can convert a hexadecimal to number
     */

    public function testCanConvertHexadecimalToNumber()
    {

        $this->assertSame(10, NumberConverter::hexadecimalToNumber("A"));
        $this->assertSame(159, NumberConverter::hexadecimalToNumber("9F"));
        $this->assertSame(1200, NumberConverter::hexadecimalToNumber("4B0"));

    }

    /**
     * Test if we give an invalid value will it throw an exception
     */

    public function testCanThrowException()
    {

        $this->expectException(HexadecimalInvalidValueException::class);

        NumberConverter::hexadecimalToNumber("Hello World");

    }

}
