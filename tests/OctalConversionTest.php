<?php

use MadByAd\MPLNumberConverter\Exceptions\OctalInvalidValueException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class OctalConversionTest extends TestCase
{

    /**
     * Test whether we can convert a number to octal
     */

    public function testCanConvertNumberToOctal()
    {

        $this->assertSame("20", NumberConverter::numberToOctal(16));
        $this->assertSame("100", NumberConverter::numberToOctal(64));
        $this->assertSame("777", NumberConverter::numberToOctal(511));

    }

    /**
     * Test whether we can convert a octal to number
     */

    public function testCanConvertOctalToNumber()
    {

        $this->assertSame(16, NumberConverter::octalToNumber("20"));
        $this->assertSame(64, NumberConverter::octalToNumber("100"));
        $this->assertSame(511, NumberConverter::octalToNumber("777"));

    }

    /**
     * Test if we give an invalid value will it throw an exception
     */

    public function testCanThrowException()
    {

        $this->expectException(OctalInvalidValueException::class);

        NumberConverter::octalToNumber("Hello World");

    }

}
