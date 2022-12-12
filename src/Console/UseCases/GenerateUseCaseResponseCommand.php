<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 18:04
 */


namespace LesIgnobles\BaseApiLaravel\Console\UseCases;


class GenerateUseCaseResponseCommand extends BaseUseCaseGeneratorCommand
{
    protected $signature = "make:usecase-response {name} {--domain=} {--vers=V1}";
    protected $description = 'Create new UseCase class';
    protected $type = 'Response';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/response.stub';
    }
}
