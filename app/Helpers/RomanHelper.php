<?php

namespace App\Helpers;

class RomanHelper
{
    /**
     * Convert an integer number to Roman numerals (e.g., 32 => XXXII).
     */
    public static function toRoman($number): string
    {
        $num = (int) $number;
        if ($num <= 0) {
            return '-';
        }

        $map = [
            'M' => 1000, 'CM' => 900,
            'D' => 500,  'CD' => 400,
            'C' => 100,  'XC' => 90,
            'L' => 50,   'XL' => 40,
            'X' => 10,   'IX' => 9,
            'V' => 5,    'IV' => 4,
            'I' => 1,
        ];

        $result = '';
        foreach ($map as $roman => $value) {
            $matches = intval($num / $value);
            $result .= str_repeat($roman, $matches);
            $num %= $value;
        }

        return $result;
    }

    /**
     * Convert year or batch number to Roman numeral Angkatan string.
     * E.g. 2026 -> 34 -> "XXXIV".
     */
    public static function getAngkatanRomawi($tahunPeriode): string
    {
        $val = (int) ($tahunPeriode ?: date('Y'));

        if ($val >= 1990) {
            $batchNum = $val - 1992;
            if ($batchNum < 1) {
                $batchNum = 1;
            }
        } else {
            $batchNum = $val;
        }

        return self::toRoman($batchNum);
    }
}
