<?php
/**
 * Author: Theo Champion
 * Date: 12/12/2022
 * Time: 12:03
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions;


class ApiException extends \Exception
{
    const COMMON = 1;
    const CRITICAL = 2;

    protected int $httpCode = 500;
    protected string $codeRef = 'E000000';
    protected int $level = self::COMMON;

    public function getFrontMessage(): string
    {
        return "Une erreur s'est produite.";
    }

    /**
     * Sometimes, we want to display another message than $message property in logs (Slack ect ...)
     */
    public function getLogMessage(): string|array
    {
        return $this->message;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function getCodeReference(): string
    {
        return $this->codeRef;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
    }
}
