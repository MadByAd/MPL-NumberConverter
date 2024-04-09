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

use MadByAd\MPLNumberConverter\Exceptions\AlphabetNegativeException;

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

    private static $alphabet = [
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
     * @param int $number the number
     * 
     * @return string The alphabet
     */

    public static function numberToAlphabet(int $number)
    {

        if($number < 0) {
            throw new AlphabetNegativeException("error cannot convert a negative number into an alphabet");
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

        return $alphabet;

    }


}
