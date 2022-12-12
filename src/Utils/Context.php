<?php
/**
 * Author: Theo Champion
 * Date: 12/12/2022
 * Time: 09:44
 */


namespace LesIgnobles\BaseApiLaravel\Utils;


class Context
{
    public static function isInProd(): bool
    {
        return getenv('APP_ENV') === 'production' || getenv('APP_ENV') === 'prod';
    }

    public static function isInLocal(): bool
    {
        return env('APP_ENV') === 'local';
    }
}
