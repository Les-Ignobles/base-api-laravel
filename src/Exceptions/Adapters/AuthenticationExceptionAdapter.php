<?php
/**
 * Author: Theo Champion
 * Date: 27/05/2022
 * Time: 10:56
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Adapters;


use Illuminate\Auth\AuthenticationException;
use JetBrains\PhpStorm\Pure;
use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;

class AuthenticationExceptionAdapter extends ApiException
{
    protected int $httpCode = 401;

    #[Pure] public function __construct(AuthenticationException $e)
    {
        parent::__construct($e->getMessage(), $e->getCode(), $e->getPrevious());
    }

    public function getFrontMessage(): string
    {
        return "Vous ne pouvez pas avoir accès à contenu car vous n'êtes pas authentifié";
    }
}
