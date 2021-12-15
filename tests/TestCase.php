<?php

namespace Danielebarbaro\EntityDetail\Tests;

use Danielebarbaro\EntityDetail\EntityDetailServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Danielebarbaro\\EntityDetail\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            EntityDetailServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        Schema::dropAllTables();

        $migration = include __DIR__.'/../database/migrations/create_laravel_entity_details_table.php.stub';
        $migration->up();

        Schema::create('test_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('property')->nullable();
        });
    }
}
