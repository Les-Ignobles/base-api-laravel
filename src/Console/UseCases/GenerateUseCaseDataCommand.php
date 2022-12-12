<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 18:04
 */


namespace LesIgnobles\BaseApiLaravel\Console\UseCases;


class GenerateUseCaseDataCommand extends BaseUseCaseGeneratorCommand
{
    protected $signature = "make:usecase-data {name} {--domain=} {--vers=V1}";
    protected $description = 'Create new UseCase Data class';
    protected $type = 'Data';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/data.stub';
    }
}
