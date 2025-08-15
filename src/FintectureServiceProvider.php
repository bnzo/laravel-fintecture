<?php

namespace Bnzo\Fintecture;

use Fintecture\PisClient;
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
            return new Fintecture(new PisClient([
                'appId' => config('fintecture.app_id'),
                'appSecret' => config('fintecture.app_secret'),
                'privateKey' => base64_decode(config('fintecture.private_key')),
                'environment' => config('fintecture.environment'),
            ]));
        });
    }
}
