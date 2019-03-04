<?php

namespace App\Service;

class Converter
{
    private static $number;

    private static $numerals = [
        0 => "",
        1 => "I",
        2 => "II",
        3 => "III",
        4 => "IV",
        5 => "V",
        6 => "VI",
        7 => "VII",
        8 => "VIII",
        9 => "IX",
    ];

    private static $decimals = [
        1 => "X",
        2 => "XX",
        3 => "XXX",
        4 => "XL",
        5 => "L",
        6 => "LX",
        7 => "LXX",
        8 => "LXXX",
        9 => "XC",
    ];

    private static $hundredths = [
        1 => "C",
        2 => "CC",
        3 => "CCC",
        4 => "CD",
        5 => "D",
        6 => "DC",
        7 => "DCC",
        8 => "DCCC",
        9 => "CM",
    ];

    private static $thousands = [
        1 => "M",
        2 => "MM",
        3 => "MMM",
    ];
    
    public static function convert(int $number): string
    {
        self::$number = $number;
        self::checkNumberValidity();

        $romanNumeral = "";

        if (self::$number > 999) {
            $romanNumeral .= self::convertThousandDigit();
        }

        if (self::$number > 99) {
            $romanNumeral .= self::convertHundredthDigit();
        }

        if (self::$number > 9) {
            $romanNumeral .= self::convertDecimal();
        }

        $romanNumeral .= self::convertNumeral();

        return $romanNumeral;
    }

    private static function checkNumberValidity()
    {
        if (self::$number < 1) {
            throw new \LogicException("Invalid argument number: cant be less than 1");
        }

        if (self::$number > 3999) {
            throw new \LogicException("Invalid argument number: cant be greater than 3999");
        }
    }

    private static function convertThousandDigit(): ?string
    {
        $thousandNumber = (int)floor(self::$number / 1000);
        self::$number -= $thousandNumber * 1000;

        return self::$thousands[$thousandNumber];
    }

    private static function convertHundredthDigit(): ?string
    {
        $hundredthNumber = (int)floor(self::$number / 100);
        self::$number -= $hundredthNumber * 100;

        return self::$hundredths[$hundredthNumber];
    }

    private static function convertDecimal(): ?string
    {
        $decimalNumber = (int)floor(self::$number / 10);
        self::$number -= $decimalNumber * 10;

        return self::$decimals[$decimalNumber];
    }

    private static function convertNumeral(): ?string
    {
        return self::$numerals[self::$number];
    }
}
