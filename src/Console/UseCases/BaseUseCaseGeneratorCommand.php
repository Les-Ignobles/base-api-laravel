<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 23:00
 */


namespace LesIgnobles\BaseApiLaravel\Console\UseCases;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use LesIgnobles\BaseApiLaravel\PackageServiceProvider;

abstract class BaseUseCaseGeneratorCommand extends GeneratorCommand
{
    protected function getStubVariables(): array
    {
        return [
            '{{ name }}'      => $this->getNameInput(),
            '{{ namespace }}' => $this->getFileNamespace(),
            '{{ class }}'     => $this->getClassName()
        ];
    }

    public function buildClass($name): array|string
    {
        $stub = $this->files->get($this->getStub());
        $replace = $this->getStubVariables();

        return str_replace(
            array_keys($replace), array_values($replace), $stub
        );
    }

    protected function getFileName(): string
    {
        return $this->getClassName() . '.php';
    }

    protected function getClassName(): string
    {
        return $this->getNameInput() . $this->type;
    }

    protected function getDomainNamespace()
    {
        return config(PackageServiceProvider::BASE_API_CONFIG_NAME . '.console.domain_namespace');
    }

    protected function getFileNamespace()
    {
        return $this->getDomainNamespace() . '\\' . $this->getDomainInput() . '\Usecases\\' . $this->getNameInput() . '\\' . $this->getVersionInput();
    }

    protected function getDomainPath()
    {
        return config(PackageServiceProvider::BASE_API_CONFIG_NAME . '.console.domain_path');
    }

    protected function rootNamespace()
    {
        return $this->getDomainNamespace();
    }

    protected function studlyClassName(string $className): string
    {
        return Str::studly(class_basename($className));
    }

    protected function getDomainInput(): string
    {
        return trim($this->option('domain'));
    }

    protected function getPath($name): string
    {
        $path = [
            $this->getDomainPath(),
            $this->getDomainInput(),
            'Usecases',
            $this->getNameInput(),
            $this->getVersionInput(),
            $this->getFileName()
        ];
        return join('/', $path);
    }

    protected function getVersionInput(): string
    {
        return trim($this->option('vers'));
    }
}
