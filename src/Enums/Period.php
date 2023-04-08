<?php
/**
 * Author: Theo Champion
 * Date: 29/03/2023
 * Time: 11:28
 */


namespace LesIgnobles\BaseApiLaravel\Enums;


enum Period: int
{
    case DAY = 1;
    case WEEK = 2;
    case MONTH = 3;
    case YEAR = 4;

    public function toDurationDays(int $value): int
    {
        return match ($this) {
            self::DAY => $value,
            self::WEEK => $value * 7,
            self::YEAR => $value * 30 * 12,
            default => $value * 30
        };
    }

    public function toDurationLabel(int $value): string
    {
        return match ($this) {
            self::DAY => $value > 1 ? 'jours' : 'jour',
            self::WEEK => $value > 1 ? 'semaines' : 'semaine',
            self::YEAR => $value > 1 ? 'années' : 'année',
            default => 'mois'
        };
    }
}
