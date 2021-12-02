<?php

namespace Danielebarbaro\UserDetail;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Danielebarbaro\UserDetail\Commands\UserDetailCommand;

class UserDetailServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-user-details')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-user-details_table')
            ->hasCommand(UserDetailCommand::class);
    }
}
