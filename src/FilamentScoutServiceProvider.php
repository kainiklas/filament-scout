<?php

namespace Concept7\FilamentScout;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentScoutServiceProvider extends PackageServiceProvider
{
    public static string $name = 'kainiklas-filament-scout';

    public static string $viewNamespace = 'kainiklas-filament-scout';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToStarRepoOnGitHub('kainiklas/filament-scout');
            });

        $package->hasConfigFile();
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
    }
}
