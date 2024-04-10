<?php

use MadByAd\MPLNumberConverter\Exceptions\AlphabetValueNegativeException;
use MadByAd\MPLNumberConverter\Exceptions\AlphabetValueZeroException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class AlphabetConversionTest extends TestCase
{

    /**
     * Test whether we can convert a number to alphabet
     */

    public function testCanConvertNumberToAlphabet()
    {

        $this->assertSame("A", NumberConverter::numberToAlphabet(1));
        $this->assertSame("L", NumberConverter::numberToAlphabet(12));
        $this->assertSame("ZF", NumberConverter::numberToAlphabet(32));
        $this->assertSame("ZZ", NumberConverter::numberToAlphabet(52));

    }

    /**
     * Test whether we can convert an alphabet to number
     */

    public function testCanConvertAlphabetToNumber()
    {

        $this->assertSame(1, NumberConverter::alphabetToNumber("A"));
        $this->assertSame(12, NumberConverter::alphabetToNumber("L"));
        $this->assertSame(32, NumberConverter::alphabetToNumber("ZF"));
        $this->assertSame(52, NumberConverter::alphabetToNumber("ZZ"));

    }

    /**
     * Test if we give an invalid value will it throw an exception
     */

    public function testCanThrowException()
    {

        $this->expectException(AlphabetValueZeroException::class);

        NumberConverter::numberToAlphabet(0);
        
        $this->expectException(AlphabetValueNegativeException::class);

        NumberConverter::numberToAlphabet(-1);

    }

}
