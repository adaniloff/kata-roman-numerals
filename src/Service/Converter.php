<?php

namespace App\Service;

class Converter
{
    public static function convert(int $number): string
    {
        if (!is_int($number)) {
            throw new \LogicException("Invalid argument number: not supported");
        }

        if (is_int($number) and $number < 1) {
            throw new \LogicException("Invalid argument number: cant be less than 1");
        }

        if (is_int($number) and $number > 3999) {
            throw new \LogicException("Invalid argument number: cant be greater than 3999");
        }

        if ($number < 10) {
            return self::convertSingleDigit($number);
        }
        if ($number < 100) {
            return self::convertDoubleDigit($number);
        }
        if ($number < 1000) {
            return self::convertTripleDigit($number);
        }
        if ($number < 4000) {
            return self::convertQuadDigit($number);
        }

        throw new \LogicException("Invalid argument number: not detected");
    }

    private static function convertSingleDigit($number): ?string
    {
        switch ($number) {
            case 1:
                return "I";
            case 2:
                return "II";
            case 3:
                return "III";
            case 4:
                return "IV";
            case 5:
                return "V";
            case 6:
                return "VI";
            case 7:
                return "VII";
            case 8:
                return "VIII";
            case 9:
                return "IX";
        }

        return '';
    }

    private static function convertDoubleDigit($number): ?string
    {
        $value = "";
        $decDigit = floor($number / 10);

        switch ($decDigit) {
            case 1:
                $value = "X";
                break;
            case 2:
                $value = "XX";
                break;
            case 3:
                $value = "XXX";
                break;
            case 4:
                $value = "XL";
                break;
            case 5:
                $value = "L";
                break;
            case 6:
                $value = "LX";
                break;
            case 7:
                $value = "LXX";
                break;
            case 8:
                $value = "LXXX";
                break;
            case 9:
                $value = "XC";
                break;
        }

        $value = $value . self::convertSingleDigit($number - ($decDigit * 10));

        return $value;
    }

    private static function convertTripleDigit($number): ?string
    {
        $value = "";
        $centDigit = floor($number / 100);

        switch ($centDigit) {
            case 1:
                $value = "C";
                break;
            case 2:
                $value = "CC";
                break;
            case 3:
                $value = "CCC";
                break;
            case 4:
                $value = "CD";
                break;
            case 5:
                $value = "D";
                break;
            case 6:
                $value = "DC";
                break;
            case 7:
                $value = "DCC";
                break;
            case 8:
                $value = "DCCC";
                break;
            case 9:
                $value = "CM";
                break;
        }

        $value = $value . self::convertDoubleDigit($number - ($centDigit * 100));

        return $value;
    }

    private static function convertQuadDigit($number): ?string
    {
        $value = "";
        $thouDigit = floor($number / 1000);

        switch ($thouDigit) {
            case 1:
                $value = "M";
                break;
            case 2:
                $value = "MM";
                break;
            case 3:
                $value = "MMM";
                break;
        }

        $value = $value . self::convertTripleDigit($number - ($thouDigit * 1000));

        return $value;
    }
}
