<?php

/**
 * 
 * This file is a part of the MadByAd\MPLNumberConverter
 * 
 * @author    MadByAd <adityaaw84@gmail.com>
 * @license   MIT License
 * @copyright Copyright (c) MadByAd 2023
 * 
 */

namespace MadByAd\MPLNumberConverter;

use MadByAd\MPLNumberConverter\Exceptions\RomanNegativeException;
use MadByAd\MPLNumberConverter\Exceptions\RomanValueLimitException;

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
        1_000_000 => "_M",
        900_000 => "_C_M",
        500_000 => "_D",
        400_000 => "_C_D",
        100_000 => "_C",
        90_000 => "_X_C",
        50_000 => "_L",
        40_000 => "_X_L",
        10_000 => "_X",
        9000 => "M_X",
        5000 => "_V",
        4000 => "M_V",
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
     * @param int $int the number which will be converted to roman numeral
     * 
     * @return string
     */

    public static function normalToRoman(int $int)
    {

        if($int <= 0) {
            throw new RomanNegativeException("error cannot convert negative number to roman numeral");
        }

        if($int >= self::$romanLimit) {
            throw new RomanValueLimitException("error cannot convert values higher than 10.000.000");
        }

        $roman = "";

        while($int > 0) {
            
            foreach(self::$romanLetter as $value => $symbol) {
            
                if($int >= $value) {
                    $roman .= $symbol;
                    $int -= $value;
                    break;
                }
            
            }

        }
        
        return $roman;

    }

    /**
     * The opposite of the normalToRoman method. this method will convert a roman number
     * to a normal number
     * 
     * @example the roman numeral `XVI` will be converted to `16`
     * @example the roman numeral `LXIV` will be converted to `64`
     * @example the roman numeral `CXXVIII` will be converted to `128`
     * 
     * @param string $roman the roman numeral which will be converted to a normal number
     * 
     * @return int
     */

    public static function romanToNormal(string $roman)
    {
        
        $number = 0;

        $symbol = "";
        $letter = "";
        $nextLetter = "";

        for($i = 0; $i < strlen($roman); $i++) {
            
            $letter = $roman[$i];
            $nextLetter = "";

            if(isset($roman[$i + 1])) {
                $nextLetter = $roman[$i + 1];
            }

            $symbol = $letter . $nextLetter;

            foreach(self::$romanLetter as $value => $romanSymbol) {
                
                if($symbol == $romanSymbol || $letter == $romanSymbol) {
                    
                    $number += $value;
                    
                    if(in_array($value, [4, 40, 400, 4000, 40_000, 400_000, 9, 90, 900, 9000, 90_000, 900_000])) {
                        $i += 1;
                    }

                    break;
                }

            }

        }

        return $number;

    }

}
