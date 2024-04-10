
# MPL Number Converter

The MPL (MadByAd PHP Library) Number Converter is a simple PHP library which is used for number conversion and others such as converting a number to a roman numeral e.g `12` to `XII`, abbreviating a number e.g `25.690` to `25.6K`, formatting a number e.g `1000000` to `1.000.000` and other number manipulation function.

- [MPL Number Converter](#mpl-number-converter)
  - [Abbreviating Number](#abbreviating-number)
  - [Formating Number](#formating-number)
  - [Alphabet Conversion](#alphabet-conversion)
  - [Binary Conversion](#binary-conversion)
  - [Hexadecimal Conversion](#hexadecimal-conversion)
  - [Octal Conversion](#octal-conversion)
  - [Roman Conversion](#roman-conversion)

##  Abbreviating Number

To abbreviate or deabbreviate number you can use the `numberToAbbreviate` or `abbreviateToNumber` method.

The `numberToAbbreviate(int $number, int $precision = 1, array $symbolSet = null)` method is used for shortening long integer, it takes 3 parameter, first is the integer to convert, second is to determine the precision (how many digit behind decimal point) and the last is the symbol set which is the symbol to use when the number is higher than a certain digit. To define a custom symbolSet the parameter must be an associative array where the key represent the digit count and the value corresponds to the symbol to use.

**Example 1**

```
echo NumberConverter::numberToAbbreviate(1250000);
```

**output**

```
"1.3 M"
```

**Example 2**

```
echo NumberConverter::numberToAbbreviate(1250000, [
    10**3 => "RB",
    10**6 => "JT",
    10**9 => "M",
    10**12 => "T",
]);
```

**output**

```
"1.3 JT"
```

The `abbreviateToNumber(string $abbreviatedNumber, array $symbolSet = null)` method is used for deabreviating abbreviated number (converting an abbreviated int to a normal int), it takes 2 parameter, first is the abbreviated number and the second is the symbol set which is the symbol to use when the number is higher than a certain digit. To define a custom symbolSet the parameter must be an associative array where the key represent the digit count and the value corresponds to the symbol to use.

**Example 1**

```
echo NumberConverter::numberToAbbreviate("1.3 M");
```

**output**

```
1300000
```

**Example 2**

```
echo NumberConverter::numberToAbbreviate("1.3 JT", [
    10**3 => "RB",
    10**6 => "JT",
    10**9 => "M",
    10**12 => "T",
]);
```

**output**

```
1300000
```

## Formating Number

To format or unformat a number you can use the `numberToFormat` and `formatToNumber` method

The `numberToFormat(int $integer, string $separatorStyle = ".")` method is used for formatting number (so it can be easily read especially for long digit number), it takes 2 parameter, first is the integer number and second is the separator style which determine what kind of separator you want to use, by default its `.` but you change it to anything except `a-z` `A-Z` `0-9` and it must be a 1 character long string

**Example**

```
echo NumberConverter::numberToFormat(15000000);
echo NumberConverter::numberToFormat(15000000, "-");
echo NumberConverter::numberToFormat(15000000, "_");
echo NumberConverter::numberToFormat(15000000, " ");
```

**output**

```
"15.000.000"
"15-000-000"
"15_000_000"
"15 000 000"
```

The `formatToNumber(string $formattedInt)` method is used for unformatting a number (converting a formatted integer which is in a form of string into a normal integer), it takes only 1 parameter and that is the formatted integer string

**Example**

```
echo NumberConverter::formatToNumber("15.000.000");
echo NumberConverter::formatToNumber("15-000-000");
echo NumberConverter::formatToNumber("15_000_000");
echo NumberConverter::formatToNumber("15 000 000");
```

**output**

```
15000000
15000000
15000000
15000000
```

## Alphabet Conversion

To convert a number to an alphabet or the opposite, you can use the `numberToAlphabet` and the `alphabetToNumber` method

The `numberToAlphabet(int $number, bool $uppercase = true)` method is used for converting a number to an alphabet (usefull for making alphabetically ordered list), it takes only 2 parameter, first is the integer and the second is to determine whether should the letter be uppercase or lowercase.

**Example**

```
echo NumberConverter::numberToAlphabet(1);
echo NumberConverter::numberToAlphabet(2);
echo NumberConverter::numberToAlphabet(3);

echo "\n";

echo NumberConverter::numberToAlphabet(4, false);
echo NumberConverter::numberToAlphabet(5, false);
echo NumberConverter::numberToAlphabet(6, false);
```

**output**

```
"A"
"B"
"C"

"d"
"e"
"f"
```

The `alphabetToNumber(string $alphabet)` method is used for converting an alphabet string into its integer value, it only takes 1 parameter and that is the alphabet string

**Example**

```
echo NumberConverter::alphabetToNumber("A");
echo NumberConverter::alphabetToNumber("O");
echo NumberConverter::alphabetToNumber("Z");
```

**output**

```
1
13
26
```

## Binary Conversion

To convert a number to a binary and the opposite, you can use the `numberToBinary` and `binaryToNumber` method

The `numberToBinary(int $number)` method is used for converting an integer to a binary string, it takes 1 parameter and that is the number

**Example**

```
echo NumberConverter::numberToBinary(2);
echo NumberConverter::numberToBinary(18);
echo NumberConverter::numberToBinary(64);
```

**output**

```
"10"
"10010"
"1000000"
```

The `binaryToNumber(string $binary)` method is used for converting a binary string to an integer, it takes 1 parameter and that is the binary string

**Example**

```
echo NumberConverter::binaryToNumber("10");
echo NumberConverter::binaryToNumber("10010");
echo NumberConverter::binaryToNumber("1000000");
```

**output**

```
2
18
64
```

## Hexadecimal Conversion

To convert a number to a hexadecimal string and the opposite, you can use the `numberToHexadecimal` and `hexadecimalToNumber` method

The `numberToHexadecimal(int $number, bool $uppercase = true)` method is used for converting a number to a hexadecimal string, it takes 2 parameter, first is the integer number, and the second is to determine whether the letter on the hexadecimal string should be uppercased or lowercased

**Example**

```
echo NumberConverter::numberToHexadecimal(10);
echo NumberConverter::numberToHexadecimal(159);
echo NumberConverter::numberToHexadecimal(1200);

echo "\n";

echo NumberConverter::numberToHexadecimal(10, false);
echo NumberConverter::numberToHexadecimal(159, false);
echo NumberConverter::numberToHexadecimal(1200, false);
```

**output**

```
"A"
"9F"
"4B0"

"a"
"9f"
"4b0"
```

The `hexadecimalToNumber(string $hexadecimal)` method is used for converting a hexadecimal string to an integer, it takes only 1 parameter and that is the hexadecimal string

**Example**

```
echo NumberConverter::hexadecimalToNumber("A");
echo NumberConverter::hexadecimalToNumber("9F");
echo NumberConverter::hexadecimalToNumber("4B0");
```

**output**

```
10
159
1200
```

## Octal Conversion

To convert a number to an octal or the opposite, you can use the `numberToOctal` and `octalToNumber` method

The `numberToOctal(int $number)` method is used for converting a number to an octal, it takes only 1 parameter and that is the integer number

**Example**

```
echo NumberConverter::numberToOctal(16);
echo NumberConverter::numberToOctal(64);
echo NumberConverter::numberToOctal(511);
```

**output**

```
"20"
"100"
"777"
```

The `octalToNumber(string $octal)` method is used for converting an octal string to a number, it takes only 1 parameter and that is the octal string

**Example**

```
echo NumberConverter::numberToOctal("20");
echo NumberConverter::numberToOctal("100");
echo NumberConverter::numberToOctal("777");
```

**output**

```
16
64
511
```

## Roman Conversion

To convert a number to a roman numeral or the opposite, you can use the `numberToRoman` and `romanToNumber` method

The `numberToRoman(int $number)` method is used for converting a number to a roman numeral  (usefull for making list ordered with roman numeral), it takes only 1 parameter and that is the integer number

**Example**

```
echo NumberConverter::numberToRoman(1);
echo NumberConverter::numberToRoman(2);
echo NumberConverter::numberToRoman(3);
echo NumberConverter::numberToRoman(4);
echo NumberConverter::numberToRoman(5);
echo NumberConverter::numberToRoman(6);
echo NumberConverter::numberToRoman(7);
echo NumberConverter::numberToRoman(8);
echo NumberConverter::numberToRoman(9);
echo NumberConverter::numberToRoman(10);
```

**output**

```
"I"
"II"
"III"
"IV"
"V"
"VI"
"VII"
"VIII"
"IX"
"X"
```

The `romanToNumber(string $roman)` method is used for converting a roman numeral to a number, it takes only 1 parameter and that is the roman numeral

**Example**

```
echo NumberConverter::romanToNumber("I");
echo NumberConverter::romanToNumber("II");
echo NumberConverter::romanToNumber("III");
echo NumberConverter::romanToNumber("IV");
echo NumberConverter::romanToNumber("V");
echo NumberConverter::romanToNumber("VI");
echo NumberConverter::romanToNumber("VII");
echo NumberConverter::romanToNumber("VIII");
echo NumberConverter::romanToNumber("IX");
echo NumberConverter::romanToNumber("X");
```

**output**

```
1
2
3
4
5
6
7
8
9
10
```
