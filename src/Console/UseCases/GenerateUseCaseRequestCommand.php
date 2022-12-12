<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 18:04
 */


namespace LesIgnobles\BaseApiLaravel\Console\UseCases;


class GenerateUseCaseRequestCommand extends BaseUseCaseGeneratorCommand
{
    protected $signature = "make:usecase-request {name} {--domain=}";
    protected $description = 'Create new UseCase Request class';
    protected $type = 'Request';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/request.stub';
    }
}
