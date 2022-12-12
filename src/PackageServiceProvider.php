<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 17:40
 */


namespace LesIgnobles\BaseApiLaravel;


use App\Http\Controllers\SandboxController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use LesIgnobles\BaseApiLaravel\Console\InstallPackageCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseDataCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseRequestCommand;
use LesIgnobles\BaseApiLaravel\Console\UseCases\GenerateUseCaseResponseCommand;
use LesIgnobles\BaseApiLaravel\Utils\Context;

class PackageServiceProvider extends ServiceProvider
{
    const BASE_API_CONFIG_NAME = 'base-api-config';

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfiguration();
            $this->publishControllers();
            $this->registerCommands();
        }
        $this->registerRoutes();
    }

    private function publishConfiguration()
    {
        $this->publishes([
            __DIR__ . '/../config/' . self::BASE_API_CONFIG_NAME . '.php' => config_path(self::BASE_API_CONFIG_NAME) . '.php',
        ], 'config');
    }

    private function publishControllers()
    {
        $this->publishes([
            __DIR__ . '/Http/Controllers/SandboxController.php' => app_path('Http/Controllers/SandboxController.php')
        ], 'controllers');
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

    private function registerRoutes()
    {
        if (!Context::isInProd()) {
            Route::any('/sandbox', [SandboxController::class, 'sandbox']);
        }
    }
}
