<?php
/**
 * Author: Theo Champion
 * Date: 12/01/2023
 * Time: 15:46
 */


namespace LesIgnobles\BaseApiLaravel\Utils;


class StrUtils
{
    public static function dumbPluralize(string $word, int $count, string $pluralLetter = 's'): string
    {
        $result = $word;

        if ($count > 1) {
            $result .= $pluralLetter;
        }

        return $result;
    }

    public static function toArray(string $data, string $separator = ','): array
    {
        return (empty($data) || !isset($data)) ? [] : explode($separator, $data);
    }
}
