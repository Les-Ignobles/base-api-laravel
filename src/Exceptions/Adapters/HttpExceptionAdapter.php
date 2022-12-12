<?php
/**
 * Author: Theo Champion
 * Date: 27/05/2022
 * Time: 10:54
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Adapters;


use JetBrains\PhpStorm\Pure;
use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpExceptionAdapter extends ApiException
{
    #[Pure] public function __construct(HttpException $e)
    {
        $this->httpCode = $e->getStatusCode();

        parent::__construct($e->getMessage(), $e->getCode(), $e->getPrevious());
    }

    public function getFrontMessage(): string
    {
        return "Une erreur s'est produite.";
    }
}
