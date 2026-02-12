<?php

namespace App\Helpers;

class NumberHelper
{
    /**
     * Convert number to Indonesian words (Terbilang).
     *
     * @param float|int $number
     * @return string
     */
    public static function terbilang($number)
    {
        $number = abs($number);
        $words = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $result = "";

        if ($number < 12) {
            $result = " " . $words[$number];
        } elseif ($number < 20) {
            $result = self::terbilang($number - 10) . " belas";
        } elseif ($number < 100) {
            $result = self::terbilang((int) ($number / 10)) . " puluh" . self::terbilang($number % 10);
        } elseif ($number < 200) {
            $result = " seratus" . self::terbilang($number - 100);
        } elseif ($number < 1000) {
            $result = self::terbilang((int) ($number / 100)) . " ratus" . self::terbilang($number % 100);
        } elseif ($number < 2000) {
            $result = " seribu" . self::terbilang($number - 1000);
        } elseif ($number < 1000000) {
            $result = self::terbilang((int) ($number / 1000)) . " ribu" . self::terbilang($number % 1000);
        } elseif ($number < 1000000000) {
            $result = self::terbilang((int) ($number / 1000000)) . " juta" . self::terbilang($number % 1000000);
        } elseif ($number < 1000000000000) {
            $result = self::terbilang((int) ($number / 1000000000)) . " milyar" . self::terbilang($number % 1000000000);
        } elseif ($number < 1000000000000000) {
            $result = self::terbilang((int) ($number / 1000000000000)) . " trilyun" . self::terbilang($number % 1000000000000);
        }

        // Ensure spaces between all words by replacing any missing spaces before known units 
        // Actually, the recursion above already handles it if we are careful.
        // Let's use a simpler, non-recursive or cleaner recursive version to avoid "Ratustiga".

        return self::formatResult($result);
    }

    private static function formatResult($text)
    {
        // Add spaces between words if they are mashed (e.g., "ratustiga" -> "ratus tiga")
        // But better yet, just ensure the recursive calls add spaces consistently.
        $text = preg_replace('/(ratus|puluh|belas|ribu|juta|milyar|trilyun)/', ' $1 ', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }
}
