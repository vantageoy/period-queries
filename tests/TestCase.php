<?php

namespace Tests;

use Illuminate\Support\Facades\Schema;

class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $dates = ['started_at', 'ended_at'];
    protected $fillable = ['started_at', 'ended_at', 'name'];
}

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('models', function ($table) {
            $table->bigIncrements('id');
            $table->string('started_at');
            $table->string('ended_at');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Define environment setup.
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Get the package service providers.
     */
    protected function getPackageProviders($app): array
    {
        return ['Vantage\PeriodQueries\PeriodQueriesServiceProvider'];
    }
}
