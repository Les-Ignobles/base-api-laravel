<?php
/**
 * Author: Theo Champion
 * Date: 27/05/2022
 * Time: 10:52
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Adapters;


use JetBrains\PhpStorm\Pure;
use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpExceptionAdapter extends ApiException
{
    protected int $httpCode = 404;

    #[Pure] public function __construct(NotFoundHttpException $e)
    {
        parent::__construct('Route not found.', $e->getCode(), $e);
    }

    public function getFrontMessage(): string
    {
        return 'Route not found.';
    }
}
