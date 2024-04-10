<?php

use MadByAd\MPLNumberConverter\Exceptions\AbbreviaterInvalidSymbolException;
use MadByAd\MPLNumberConverter\NumberConverter;
use PHPUnit\Framework\TestCase;

final class AbbreviateNumberTest extends TestCase
{

    /**
     * Test whether we can abbreviate a number
     */

    public function testCanAbbreviateNumber()
    {

        $this->assertSame("1 K", NumberConverter::numberToAbbreviate(1_000));
        $this->assertSame("1 M", NumberConverter::numberToAbbreviate(1_000_000));
        $this->assertSame("1.3 M", NumberConverter::numberToAbbreviate(1_250_000));
        $this->assertSame("10.8 B", NumberConverter::numberToAbbreviate(10_750_250_000));

    }

    /**
     * Test whether we can deabbreviate a number
     */

    public function testCanDeabbreviateNumber()
    {

        $this->assertSame(1_000, NumberConverter::abbreviateToNumber("1 K"));
        $this->assertSame(1_000_000, NumberConverter::abbreviateToNumber("1 M"));
        $this->assertSame(1_300_000, NumberConverter::abbreviateToNumber("1.3 M"));
        $this->assertSame(10_800_000_000, NumberConverter::abbreviateToNumber("10.8 B"));

    }

    /**
     * Test if we give an invalid format will it throw an exception
     */

    public function testCanThrowException()
    {

        $this->expectException(AbbreviaterInvalidSymbolException::class);

        NumberConverter::abbreviateToNumber("1.3 JT");

    }

}
