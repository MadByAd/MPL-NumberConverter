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

use MadByAd\MPLNumberConverter\Exceptions\FormatterInvalidSeparatorException;

/**
 * 
 * The Formatter trait contains method for converting an integer into a formmated
 * number e.g `1240000` to `1.240.000`
 * 
 * @author MadByAd <adityaaw84@gmail.com>
 * 
 */

trait Formatter
{

    /**
     * The regex code for checking separator style
     * 
     * @var string
     */

    private static string $checkSeparatorRegex = "/[a-zA-Z0-9]/";

    /**
     * This method is used for converting an integer into a formatted integer
     * (integer with separator)
     * 
     * @example The integer `1000000` will be converted to  `1.000.000`
     * 
     * @param int    $integer        The integer which will be formatted
     * @param string $separatorStyle The separator style (must be any character
     *                               except `a-z` `A-Z` `0-9`)
     * 
     * @return string The formatted integer
     * 
     * @throws FormatterInvalidSeparatorException if the separator style is invalid
     */

    public static function numberToFormat(int $integer, string $separatorStyle = ".")
    {

        if(preg_match(self::$checkSeparatorRegex, $separatorStyle[0])) {
            throw new FormatterInvalidSeparatorException("error the use of separator \"{$separatorStyle[0]}\" is not allowed");
        }

        return strrev(implode($separatorStyle[0], str_split(strrev($integer), 3)));

    }

    /**
     * This method is the opposite of the numberToFormat method. This method is
     * used for converting a formatted integer which is usually in a form of a
     * string to an integer
     * 
     * @param string $formattedInt The formatted integer
     * 
     * @return int The integer
     */

    public static function formatToNumber(string $formattedInt)
    {
        
        $separator = preg_replace(self::$checkSeparatorRegex, "", $formattedInt)[0];

        return (int) implode("", explode($separator, $formattedInt));

    }

}
