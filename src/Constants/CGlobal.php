<?php
/**
 * Author: Theo Champion
 * Date: 29/03/2023
 * Time: 11:19
 */


namespace LesIgnobles\BaseApiLaravel\Constants;


use LesIgnobles\BaseApiLaravel\Enums\Period;

class CGlobal
{
    const DAY_DURATION_UNIT = 1;
    const WEEK_DURATION_UNIT = 2;
    const MONTH_DURATION_UNIT = 3;
    const SEMESTER_DURATION_UNIT = 4;

    public static function DURATION_LABEL(int $durationUnitId, int $durationValue = 1): string
    {

        return match ($durationUnitId) {
            self::DAY_DURATION_UNIT => $durationValue > 1 ? 'jours' : 'jour',
            self::WEEK_DURATION_UNIT => $durationValue > 1 ? 'semaines' : 'semaine',
            self::SEMESTER_DURATION_UNIT => $durationValue > 1 ? 'semestres' : 'semestre',
            default => 'mois'
        };
    }

    public static function TO_DURATION_DAYS(int $unit, int $value): int
    {
        return match ($unit) {
            self::DAY_DURATION_UNIT => $value,
            self::WEEK_DURATION_UNIT => $value * 7,
            self::SEMESTER_DURATION_UNIT => $value * 30 * 6,
            default => $value * 30
        };
    }
}
