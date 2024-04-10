<?php

use MadByAd\MPLNumberConverter\Exceptions\RomanValueNegativeException;
use MadByAd\MPLNumberConverter\Exceptions\RomanValueLimitException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class RomanConversionTest extends TestCase
{

    /**
     * Test whether we can convert a number to a roman numeral
     */

    public function testCanConvertNumberToRomanNumeral()
    {

        $this->assertSame("XVI", NumberConverter::numberToRoman(16));
        $this->assertSame("LXIV", NumberConverter::numberToRoman(64));
        $this->assertSame("CXXVIII", NumberConverter::numberToRoman(128));
        $this->assertSame("CCLVI", NumberConverter::numberToRoman(256));
        $this->assertSame("DXII", NumberConverter::numberToRoman(512));
        $this->assertSame("MXXIV", NumberConverter::numberToRoman(1024));
        $this->assertSame("MMMCMXCIX", NumberConverter::numberToRoman(3999));

    }

    /**
     * Test whether we can convert a roman numeral to a number
     */

    public function testCanConvertRomanNumeralToNumber()
    {
        
        $this->assertSame(1, NumberConverter::romanToNumber("I"));
        $this->assertSame(4, NumberConverter::romanToNumber("IV"));
        $this->assertSame(64, NumberConverter::romanToNumber("LXIV"));
        $this->assertSame(128, NumberConverter::romanToNumber("CXXVIII"));
        $this->assertSame(256, NumberConverter::romanToNumber("CCLVI"));
        $this->assertSame(512, NumberConverter::romanToNumber("DXII"));
        $this->assertSame(1024, NumberConverter::romanToNumber("MXXIV"));
        $this->assertSame(3999, NumberConverter::romanToNumber("MMMCMXCIX"));

    }

    /**
     * Test will the method throw an exception if given an invalid value
     */

    public function testCanThrowException()
    {

        $this->expectException(RomanValueNegativeException::class);

        NumberConverter::numberToRoman(-1);

        $this->expectException(RomanValueLimitException::class);

        NumberConverter::numberToRoman(100_000_000);

    }

}
