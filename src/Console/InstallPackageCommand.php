<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 19:40
 */


namespace LesIgnobles\BaseApiLaravel\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use LesIgnobles\BaseApiLaravel\PackageServiceProvider;

class InstallPackageCommand extends Command
{
    protected $signature = 'bap:install';
    protected $description = 'Install Base Api Package';

    public function handle()
    {
        $this->info('Installing Base Api Package...');

        $this->info('Publishing configuration...');

        if (!$this->configExists()) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed Base Api Package');
    }

    private function configExists(): bool
    {
        return File::exists(config_path(PackageServiceProvider::BASE_API_CONFIG_NAME));
    }

    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "LesIgnobles\BaseApiLaravel\PackageServiceProvider",
            '--tag'      => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
