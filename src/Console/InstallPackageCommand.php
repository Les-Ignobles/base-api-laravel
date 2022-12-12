<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 19:40
 */


namespace LesIgnobles\BaseApiLaravel\Console;


use Illuminate\Console\Command;

class InstallPackageCommand extends Command
{
    const SERVICE_PROVIDER_NAMESPACE = 'LesIgnobles\BaseApiLaravel\PackageServiceProvider';

    protected $signature = 'bap:install';
    protected $description = 'Install Base Api Package';

    public function handle()
    {
        $this->info('Installing Base Api Package...');

        $this->info('Publishing configuration...');
        $this->publishConfiguration();

        $this->info('Publishing controllers...');
        $this->publishControllers();

        $this->info('Base Api Package successfully installed !');
    }

    private function publishConfiguration()
    {
        $params = [
            '--provider' => self::SERVICE_PROVIDER_NAMESPACE,
            '--tag'      => "config"
        ];

        $this->call('vendor:publish', $params);
    }

    private function publishControllers()
    {
        $params = [
            '--provider' => self::SERVICE_PROVIDER_NAMESPACE,
            '--tag'      => "controllers"
        ];

        $this->call('vendor:publish', $params);
    }
}
