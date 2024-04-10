<?php

/**
 * 
 * This file is a part of the MadByAd\MPLNumberConverter
 * 
 * @author    MadByAd <adityaaw84@gmail.com>
 * @license   MIT License
 * @copyright Copyright (c) MadByAd 2024
 * 
 */

namespace MadByAd\MPLNumberConverter;

use MadByAd\MPLNumberConverter\Exceptions\AbbreviaterInvalidSymbolException;

/**
 * 
 * The Abbreviater Trait is used for converting a number into its abbreviated
 * version (shorter) e.g `1.250.000` to `1.2 M`
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait Abbreviater
{

    /**
     * The regex string for converting abbreviated number to an integer
     * 
     * @var string
     */

    private static string $abbreviateRegex = "/([0-9.]{1,})([\W]{1})(.{1,})/";

    /**
     * The default symbol set if no symbol set is given
     * 
     * @var array
     */

    private static array $symbolSet = [
        10**12 => "T",
        10**9 => "B",
        10**6 => "M",
        10**3 => "K",
    ];

    /**
     * this method is used for abbreviating number so it can display without
     * taking much space
     * 
     * @example the number `1.000` will be abbreviated to `1 K`
     * @example the number `12.000` will be abbreviated to `12 K`
     * @example the number `1.250.000` will be abbreviated to `1.3 M`
     * 
     * @param int   $number    The number which will be abbreviated
     * @param int   $precision Determine how many integer behind the decimal point
     * @param array $symbolSet Define the symbol set which is the symbol to use
     * when the number is higher than a certain digit. To define a custom symbolSet
     * the parameter must be an associative array where the key represent the
     * digit count and the value corresponds to the symbol to use e.g
     * ```php
     * [
     *      10**3 => "RB",
     *      10**6 => "JT",
     *      10**9 => "M",
     *      10**12 => "T",
     * ]
     * ```
     * from the symbol set above if the given number has a digit count higher
     * than 3 e.g `1.000` then it will be abbreviated and use the symbol `RB`
     * which result `1 RB` or if the given number has a digit count higher than
     * 6 e.g `1.250.000` then it wil be abbreviated and use the symbol `JT` which
     * will result `1.3 JT`. The default value for the symbol set is
     * ```php
     * [
     *      10**3 => "K",
     *      10**6 => "M",
     *      10**9 => "B",
     *      10**12 => "T",
     * ]
     * ```
     * 
     * @return string the abbreviated number
     */

    public static function numberToAbbreviate(int $number, int $precision = 1, array $symbolSet = null)
    {
        
        if($symbolSet == null) {
            $symbolSet = self::$symbolSet;
        } else {
            krsort($symbolSet, SORT_NUMERIC);
        }

        foreach($symbolSet as $power => $symbol) {
            if($power <= $number) {
                return round($number / $power, $precision) . " " . $symbol;
            }
        }

        return (string) $number;

    }

    /**
     * this method is the opposite of the numberToAbbreviate method. this method
     * is used for converting abbreviated number into an integer
     * 
     * @example the number `1 K` will be deabbreviated to `1.000`
     * @example the number `12 K` will be deabbreviated to `12.000`
     * @example the number `1.3 M` will be deabbreviated to `1.300.000`
     * 
     * @param string $abbreviatedNumber The abbreviated number
     * @param array  $symbolSet         Define the symbol set which is the symbol to use
     * when the number is higher than a certain digit. To define a custom symbolSet
     * the parameter must be an associative array where the key represent the
     * digit count and the value corresponds to the symbol to use e.g
     * ```php
     * [
     *      10**3 => "RB",
     *      10**6 => "JT",
     *      10**9 => "M",
     *      10**12 => "T",
     * ]
     * ```
     * from the symbol set above if the given abbreviated number is `1 RB` then
     * it will be deabbreviated and multiply the number by `10^3` which will
     * result in `1000` or if the given abbreviated number is `1.3 JT` then it
     * will be deabbreviated and multiply the number by `10^3` which will result
     * in `1.300.000`. The default value for the symbol set is
     * ```php
     * [
     *      10**3 => "K",
     *      10**6 => "M",
     *      10**9 => "B",
     *      10**12 => "T",
     * ]
     * ```
     * 
     * @return int The deabbreviated number
     * 
     * @throws AbbreviaterInvalidSymbolException if the symbol is invalid
     */

    public static function abbreviateToNumber(string $abbreviatedNumber, array $symbolSet = null)
    {

        if($symbolSet == null) {
            $symbolSet = self::$symbolSet;
        }

        $matches = [];
        $number = 0;
        $symbolFound = false;

        preg_match_all(self::$abbreviateRegex, $abbreviatedNumber, $matches);

        foreach($symbolSet as $power => $symbol) {
            
            if($symbol == $matches[3][0]) {
                $number = floatval($matches[1][0] * $power);
                $symbolFound = true;
                return (int) $number;
            }

        }

        if(!$symbolFound) {
            throw new AbbreviaterInvalidSymbolException("error invalid symbol \"{$matches[3][0]}\"");
        }

    }
    
}
