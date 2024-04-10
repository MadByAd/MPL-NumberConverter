<?php

use MadByAd\MPLNumberConverter\Exceptions\FormatterInvalidSeparatorException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class FormatNumberTest extends TestCase
{

    /**
     * Test whether we can format a number
     */

    public function testCanFormatNumber()
    {

        $this->assertSame("10.000", NumberConverter::numberToFormat(10000));
        $this->assertSame("10+000", NumberConverter::numberToFormat(10000, "+"));
        $this->assertSame("10_000", NumberConverter::numberToFormat(10000, "_"));
        $this->assertSame("10 000", NumberConverter::numberToFormat(10000, " "));

    }

    /**
     * Test whether we can un format a number
     */

    public function testCanUnformatNumber()
    {

        $this->assertSame(10000, NumberConverter::formatToNumber("10.000"));
        $this->assertSame(10000, NumberConverter::formatToNumber("10+000"));
        $this->assertSame(10000, NumberConverter::formatToNumber("10_000"));
        $this->assertSame(10000, NumberConverter::formatToNumber("10 000"));

    }

    /**
     * Test if we give an invalid separator style will it throw an exception
     */

    public function testCanThrowException()
    {

        $this->expectException(FormatterInvalidSeparatorException::class);

        NumberConverter::numberToFormat(10000, "Hello World");

    }

}
