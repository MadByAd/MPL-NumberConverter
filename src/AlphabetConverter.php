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

use MadByAd\MPLNumberConverter\Exceptions\AlphabetInvalidLetterException;
use MadByAd\MPLNumberConverter\Exceptions\AlphabetValueNegativeException;
use MadByAd\MPLNumberConverter\Exceptions\AlphabetValueZeroException;

/**
 * 
 * The AlphabetConverter Trait contains method for converting a number to an alphabet
 * the method can be used for creating alphabetical list e.g `3` to `C` example list
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait AlphabetConverter
{

    /**
     * Store the letter and its value
     * 
     * @var array
     */

    private static array $alphabet = [
        26 => "Z",
        25 => "Y",
        24 => "X",
        23 => "W",
        22 => "V",
        21 => "U",
        20 => "T",
        19 => "S",
        18 => "R",
        17 => "Q",
        16 => "P",
        15 => "M",
        14 => "N",
        13 => "O",
        12 => "L",
        11 => "K",
        10 => "J",
        9 => "I",
        8 => "H",
        7 => "G",
        6 => "F",
        5 => "E",
        4 => "D",
        3 => "C",
        2 => "B",
        1 => "A",
    ];

    /**
     * this method is used for converting a number into an Alphabet (usefull for
     * making an alphabetically ordered list)
     * 
     * @example the number `1` will be converted to `A`
     * @example the number `12` will be converted to `L`
     * @example the number `32` will be converted to `ZF`
     * @example the number `52` will be converted to `ZZ`
     * 
     * @param int $number       The number which will be converted to an alphabet
     * @param string $uppercase Determine whether to use uppercase or lowercase letter
     * 
     * @return string The alphabet
     * 
     * @throws AlphabetValueNegativeException if the given number is a negative
     *                                        value
     * @throws AlphabetValueZeroException if the given number is zero `0`
     */

    public static function numberToAlphabet(int $number, bool $uppercase = true)
    {

        if($number < 0) {
            throw new AlphabetValueNegativeException("error cannot convert a negative number into an alphabet");
        }

        if($number == 0) {
            throw new AlphabetValueZeroException("error cannot convert zero to an alphabet no letter exist");
        }

        $alphabet = "";

        while($number > 0) {

            foreach(self::$alphabet as $value => $letter) {

                if($number >= $value) {
                    
                    $number -= $value;
                    $alphabet .= $letter;
                    break;

                }

            }

        }

        if(!$uppercase) {
            return strtolower($alphabet);
        }
        return $alphabet;

    }

    /**
     * This method is the opposite og the numberToAlphabet method. this method
     * is used for converting an alphabet into a number
     * 
     * @example the number `1` will be converted to `A`
     * @example the number `12` will be converted to `L`
     * @example the number `32` will be converted to `ZF`
     * @example the number `52` will be converted to `ZZ`
     * 
     * @param string $alphabet The alphabet which will be converted into a number
     * 
     * @return int The number
     * 
     * @throws AlphabetInvalidLetterException if the string contains an invalid
     *                                        letter (non alphabet character)
     */

    public static function alphabetToNumber(string $alphabet)
    {

        $alphabet = strtoupper($alphabet);

        $number = 0;

        for($i = 0; $i < strlen($alphabet); $i++) {

            $letterFound = false;
            
            foreach(self::$alphabet as $value => $letter) {
            
                if($alphabet[$i] == $letter) {
                    $number += $value;
                    $letterFound = true;
                    break;
                }

            }

            if(!$letterFound) {
                throw new AlphabetInvalidLetterException("error invalid letter \"{$alphabet[$i]}\" cannot convert \"{$alphabet[$i]}\" to an integer value");
            }

        }

        return $number;

    }

}
