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

use MadByAd\MPLNumberConverter\Exceptions\OctalInvalidValueException;

/**
 * 
 * The OctalConverter Trait contains method for converting number into a
 * octal value
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait OctalConverter
{

    /**
     * The regex code to check whether a string is octal
     * 
     * @var string
     */

    private static string $checkOctalRegex = "/[0-7]{1,}/";

    /**
     * This method is used for converting number to an octal string
     * 
     * @example The number `16` will be converted to `20`
     * @example The number `64` will be converted to `100`
     * @example The number `511` will be converted to `777`
     * 
     * @param int $int the integer which will be converted
     * 
     * @return string The octal string
     */

    public static function numberToOctal(int $int)
    {
        return decoct($int);
    }

    /**
     * This method is the opposite of the numberToOctal method. This method
     * is used for converting an octal string to an integer
     * 
     * @example The number `20` will be converted to `16`
     * @example The number `100` will be converted to `64`
     * @example The number `777` will be converted to `511`
     * 
     * @param string $octal The octal string
     * 
     * @return int The integer value
     * 
     * @throws OctalInvalidValueException if the given string is invalid
     */

    public static function octalToNumber(string $octal)
    {

        if(!empty(preg_replace(self::$checkOctalRegex, "", $octal))) {
            throw new OctalInvalidValueException("error the given string of \"{$octal}\" is not an octal string");
        }

        return octdec($octal);

    }

}
