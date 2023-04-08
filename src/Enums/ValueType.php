<?php
/**
 * Author: Theo Champion
 * Date: 29/03/2023
 * Time: 13:33
 */


namespace LesIgnobles\BaseApiLaravel\Enums;


use LesIgnobles\BaseApiLaravel\Utils\StrUtils;

enum ValueType: int
{
    case BOOL = 1;
    case STRING = 2;
    case ARRAY = 3;
    case INT = 4;

    public function cast(string $value): mixed
    {
        return match ($this) {
            self::BOOL => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            self::ARRAY => StrUtils::toArray($value),
            self::INT => intval($value),
            default => $value
        };
    }
}
