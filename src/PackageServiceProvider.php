<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 17:40
 */


namespace LesIgnobles\BaseApiLaravel;


use Illuminate\Support\ServiceProvider;
use LesIgnobles\BaseApiLaravel\Console\InstallPackageCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseDataCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseRequestCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseResponseCommand;

class PackageServiceProvider extends ServiceProvider
{
    const BASE_API_CONFIG_NAME = 'base-api-config';

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfiguration();
            $this->registerCommands();
        }
    }

    private function publishConfiguration()
    {
        $this->publishes([
            __DIR__ . '/../config/' . self::BASE_API_CONFIG_NAME => config_path(self::BASE_API_CONFIG_NAME) . '.php',
        ], 'config');
    }

    private function registerCommands()
    {
        $this->commands([
            GenerateUseCaseCommand::class,
            GenerateUseCaseDataCommand::class,
            GenerateUseCaseRequestCommand::class,
            GenerateUseCaseResponseCommand::class,
            InstallPackageCommand::class
        ]);
    }
}
