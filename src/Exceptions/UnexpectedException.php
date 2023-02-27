<?php
/**
 * Author: Theo Champion
 * Date: 12/12/2022
 * Time: 12:26
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions;


use Throwable;

class UnexpectedException extends ApiException
{
    protected int $level = self::CRITICAL;

    public function __construct(Throwable $e)
    {
        parent::__construct($e->getMessage());
    }
}
