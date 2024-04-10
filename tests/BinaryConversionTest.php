<?php

use MadByAd\MPLNumberConverter\Exceptions\BinaryInvalidValueException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class BinaryConversionTest extends TestCase
{

    /**
     * Test whether we can convert a number to binary
     */

    public function testCanConvertNumberToBinary()
    {

        $this->assertSame("10", NumberConverter::numberToBinary(2));
        $this->assertSame("10010", NumberConverter::numberToBinary(18));
        $this->assertSame("1000000", NumberConverter::numberToBinary(64));
        $this->assertSame("1111111111111111111111111111111111111111111111111111111111101101", NumberConverter::numberToBinary(-19));

    }

    /**
     * Test whether we can convert a binary to number
     */

    public function testCanConvertBinaryToNumber()
    {

        $this->assertSame(2, NumberConverter::binaryToNumber("10"));
        $this->assertSame(18, NumberConverter::binaryToNumber("10010"));
        $this->assertSame(64, NumberConverter::binaryToNumber("1000000"));

    }

    /**
     * Test if we give an invalid value will it throw an exception
     */

    public function testCanThrowException()
    {

        $this->expectException(BinaryInvalidValueException::class);

        NumberConverter::binaryToNumber("Hello World");

    }

}
