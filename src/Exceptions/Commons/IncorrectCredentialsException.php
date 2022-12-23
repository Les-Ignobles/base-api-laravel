<?php
/**
 * Author: Theo Champion
 * Date: 17/12/2022
 * Time: 22:03
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Commons;


use JetBrains\PhpStorm\Pure;
use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;

class IncorrectCredentialsException extends ApiException
{
    #[Pure] public function __construct()
    {
        $message = 'Incorrect credentials';
        parent::__construct($message);
    }

    public function getFrontMessage(): string
    {
        return 'Tes identifiants sont incorrects.';
    }
}
