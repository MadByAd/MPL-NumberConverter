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

use MadByAd\MPLNumberConverter\Exceptions\HexadecimalInvalidValueException;

/**
 * 
 * The HexadecimalConverter Trait contains method for converting number into a
 * hexadecimal value
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait HexadecimalConverter
{

    /**
     * The regex code to check whether a string is hexadecimal
     * 
     * @var string
     */

    private static string $checkHexadecimalRegex = "/[0-9a-fA-F]{1,}/";

    /**
     * This method is used for converting number to a hexadecimal string
     * 
     * @example The number `10` will be converted to `A`
     * @example The number `159` will be converted to `9F`
     * @example The number `1200` will be converted to `4B0`
     * 
     * @param int  $int       The integer which will be converted
     * @param bool $uppercase Determine whether the letter should be uppercased or not
     * 
     * @return string The hexadecimal string
     */

    public static function numberToHexadecimal(int $int, bool $uppercase = false)
    {
        
        if($uppercase) {
            return strtoupper(dechex($int));
        } else {
            return dechex($int);
        }

    }

    /**
     * This method is the opposite of the numberToHexadecimal method. This method
     * is used for converting a hexadecimal string to an integer
     * 
     * @example The number `A` will be converted to `10`
     * @example The number `9F` will be converted to `159`
     * @example The number `4B0` will be converted to `1200`
     * 
     * @param string $hexadecimal The hexadecimal string
     * 
     * @return int The integer value
     * 
     * @throws HexadecimalInvalidValueException if the given string is invalid
     */

    public static function hexadecimalToNumber(string $hexadecimal)
    {

        if(!empty(preg_replace(self::$checkHexadecimalRegex, "", $hexadecimal))) {
            throw new HexadecimalInvalidValueException("error the given string of \"{$hexadecimal}\" is not a hexadecimal string");
        }

        return hexdec($hexadecimal);

    }

}
