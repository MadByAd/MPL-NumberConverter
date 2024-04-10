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

use MadByAd\MPLNumberConverter\Exceptions\RomanInvalidLetterException;
use MadByAd\MPLNumberConverter\Exceptions\RomanValueNegativeException;
use MadByAd\MPLNumberConverter\Exceptions\RomanValueLimitException;
use MadByAd\MPLNumberConverter\Exceptions\RomanValueZeroException;

/**
 * 
 * The RomanConverter trait contains method for converting number to roman numeral
 * and the opposite of it
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait RomanConverter
{

    /**
     * Define the limit for converting a number to a roman numeral
     * 
     * @var int
     */

    private static $romanLimit = 10_000_000;

    /**
     * The roman letter and its value
     * 
     * @var array
     */

    private static array $romanLetter = [
        1_000_000 => "m",
        900_000 => "cm",
        500_000 => "d",
        400_000 => "cd",
        100_000 => "c",
        90_000 => "xc",
        50_000 => "l",
        40_000 => "xl",
        10_000 => "x",
        9000 => "Mx",
        5000 => "v",
        4000 => "Mv",
        1000 => "M",
        900 => "CM",
        500 => "D",
        400 => "CD",
        100 => "C",
        90 => "XC",
        50 => "L",
        40 => "XL",
        10 => "X",
        9 => "IX",
        5 => "V",
        4 => "IV",
        1 => "I",
    ];

    /**
     * This method is used for converting a number to a roman numeral
     * 
     * @note the number limit for roman numeral is `10.000.000`
     * @example the number `16` will be converted to `XVI`
     * @example the number `64` will be converted to `LXIV`
     * @example the number `128` will be converted to `CXXVIII`
     * 
     * @param int $number the number which will be converted to roman numeral
     * 
     * @return string The roman numeral
     * 
     * @throws RomanValueNegativeException if the given integer is negative
     * @throws RomanValueZeroException if the given integer is zero `0`
     * @throws RomanValueLimitException if the given integer exceeds the integer
     *                                  limit which is `10.000.000`
     */

    public static function numberToRoman(int $number)
    {

        if($number <= 0) {
            throw new RomanValueNegativeException("error cannot convert negative number to roman numeral");
        }

        if($number == 0) {
            throw new RomanValueZeroException("error cannot convert a zero to a roman numeral no letter exist");
        }

        if($number >= self::$romanLimit) {
            throw new RomanValueLimitException("error cannot convert values higher than 10.000.000");
        }

        $roman = "";

        while($number > 0) {
            
            foreach(self::$romanLetter as $value => $symbol) {
            
                if($number >= $value) {
                    $roman .= $symbol;
                    $number -= $value;
                    break;
                }
            
            }

        }
        
        return $roman;

    }

    /**
     * The opposite of the numberToRoman method. this method will convert a roman number
     * to a normal number
     * 
     * @example the roman numeral `XVI` will be converted to `16`
     * @example the roman numeral `LXIV` will be converted to `64`
     * @example the roman numeral `CXXVIII` will be converted to `128`
     * 
     * @param string $roman the roman numeral which will be converted to a normal number
     * 
     * @return int The normal number
     * 
     * @throws RomanInvalidLetterException if the given string contains an invalid
     *                                     symbol (non roman letter / symbol)
     */

    public static function romanToNumber(string $roman)
    {
        
        $number = 0;

        $symbol = "";
        $letter = "";
        $nextLetter = "";

        for($i = 0; $i < strlen($roman); $i++) {
            
            $letter = $roman[$i];
            $nextLetter = "";
            $letterFound = false;

            if(isset($roman[$i + 1])) {
                $nextLetter = $roman[$i + 1];
            }

            $symbol = $letter . $nextLetter;

            foreach(self::$romanLetter as $value => $romanSymbol) {
                
                if($symbol == $romanSymbol || $letter == $romanSymbol) {
                    
                    $number += $value;
                    $letterFound = true;
                    
                    if(in_array($value, [4, 40, 400, 4000, 40_000, 400_000, 9, 90, 900, 9000, 90_000, 900_000])) {
                        $i += 1;
                    }

                    break;
                }

            }

            if(!$letterFound) {
                throw new RomanInvalidLetterException("error invalid letter \"{$letter}\" cannot convert \"{$letter}\" to an integer value");
            }

        }

        return $number;

    }

}
