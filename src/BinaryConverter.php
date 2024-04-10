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

use MadByAd\MPLNumberConverter\Exceptions\BinaryInvalidValueException;

/**
 * 
 * The BinaryConverter Trait contains method for converting number to a binary number
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait BinaryConverter
{

    /**
     * The regex code for checking whether a string is actually binary
     * 
     * @var string
     */

    private static string $checkBinaryRegex = "/[0-1]{1,}/";

    /**
     * This method is used for converting a number to a binary.
     * 
     * @example The number `2` will be converted to `10`
     * @example The number `18` will be converted to `10010`
     * @example The number `64` will be converted to `1000000`
     * 
     * @param int $int The number which will be converted
     * 
     * @return string The binary string
     */

    public static function numberToBinary(int $int)
    {
        return decbin($int);
    }

    /**
     * This method is the opposite of the binaryToNumber method. This method is
     * used for converting a binary string to an integer value
     * 
     * @example The number `10` will be converted to `2`
     * @example The number `10010` will be converted to `18`
     * @example The number `1000000` will be converted to `64`
     * 
     * @param string $binary The binary string
     * 
     * @return int The integer value
     * 
     * @throws BinaryInvalidValueException if the given binary string is invalid
     */

    public static function binaryToNumber(string $binary)
    {

        if(!empty(preg_replace(self::$checkBinaryRegex, "", $binary))) {
            throw new BinaryInvalidValueException("error the given string of \"{$binary}\" is not a binary string");
        }

        return bindec($binary);

    }

}
