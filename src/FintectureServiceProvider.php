<?php

namespace Bnzo\Fintecture;

use Bnzo\Fintecture\Commands\FintectureCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FintectureServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-fintecture')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_fintecture_table')
            ->hasCommand(FintectureCommand::class);
    }
}
