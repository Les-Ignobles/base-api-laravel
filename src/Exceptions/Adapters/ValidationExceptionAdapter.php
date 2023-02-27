<?php
/**
 * Author: Theo Champion
 * Date: 27/05/2022
 * Time: 10:16
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Adapters;


use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use JetBrains\PhpStorm\Pure;
use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;

class ValidationExceptionAdapter extends ApiException
{
    protected int $httpCode = 422;
    protected Validator $validator;

    #[Pure] public function __construct(ValidationException $e)
    {
        $this->validator = $e->validator;
        $this->metadata = $this->validator->errors()->toArray();
        parent::__construct('Validation error.');
    }

    public function getFrontMessage(): string
    {
        return $this->validator->errors()->first();
    }

    public function getLogMessage(): string|array
    {
        return $this->validator->errors()->getMessages();
    }
}
