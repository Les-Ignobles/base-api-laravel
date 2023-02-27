<?php
/**
 * Author: Theo Champion
 * Date: 17/02/2023
 * Time: 15:30
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Commons;


use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;
use Throwable;

class ForbiddenException extends ApiException
{
    protected int $httpCode = 403;

    public function __construct(
        $message = "Action forbidden",
        $frontMessage = "Vous n'avez pas les droits pour effectuer cette action.",
        Throwable $previous = null
    )
    {
        parent::__construct($message, $frontMessage, $previous);
    }
}
