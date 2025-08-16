<?php

namespace Bnzo\Fintecture;

use Bnzo\Fintecture\DTO\ConfigDTO;
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
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        $this->app->singleton(Fintecture::class, function ($app) {
            $configDTO = ConfigDTO::fromArray(config('fintecture'));

            return new Fintecture($configDTO);
        });
    }
}
