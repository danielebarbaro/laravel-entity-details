<?php

namespace Danielebarbaro\EntityDetail;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EntityDetailServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-entity-details')
            ->hasConfigFile()
            ->hasMigration('create_laravel_entity_details_table');
    }
}
