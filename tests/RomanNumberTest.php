<?php

use MadByAd\MPLNumberConverter\Exceptions\RomanValueNegativeException;
use MadByAd\MPLNumberConverter\Exceptions\RomanValueLimitException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class RomanNumberTest extends TestCase
{

    /**
     * Test whether we can convert a number to a roman numeral
     */

    public function testCanConvertNumberToRomanNumeral()
    {

        $this->assertSame("XVI", NumberConverter::normalToRoman(16));
        $this->assertSame("LXIV", NumberConverter::normalToRoman(64));
        $this->assertSame("CXXVIII", NumberConverter::normalToRoman(128));
        $this->assertSame("CCLVI", NumberConverter::normalToRoman(256));
        $this->assertSame("DXII", NumberConverter::normalToRoman(512));
        $this->assertSame("MXXIV", NumberConverter::normalToRoman(1024));
        $this->assertSame("MMMCMXCIX", NumberConverter::normalToRoman(3999));

    }

    /**
     * Test whether we can convert a roman numeral to a number
     */

    public function testCanConvertRomanNumeralToNumber()
    {
        
        $this->assertSame(1, NumberConverter::romanToNormal("I"));
        $this->assertSame(4, NumberConverter::romanToNormal("IV"));
        $this->assertSame(64, NumberConverter::romanToNormal("LXIV"));
        $this->assertSame(128, NumberConverter::romanToNormal("CXXVIII"));
        $this->assertSame(256, NumberConverter::romanToNormal("CCLVI"));
        $this->assertSame(512, NumberConverter::romanToNormal("DXII"));
        $this->assertSame(1024, NumberConverter::romanToNormal("MXXIV"));
        $this->assertSame(3999, NumberConverter::romanToNormal("MMMCMXCIX"));

    }

    /**
     * Test will the method throw an exception if given an invalid value
     */

    public function testCanThrowException()
    {

        $this->expectException(RomanValueNegativeException::class);

        NumberConverter::normalToRoman(-1);

        $this->expectException(RomanValueLimitException::class);

        NumberConverter::normalToRoman(100_000_000);

    }

}
