<?php

namespace Kainiklas\FilamentScout;

use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Kainiklas\FilamentScout\Testing\TestsFilamentScout;

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
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
    }

}
