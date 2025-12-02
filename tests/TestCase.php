<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast\Tests;

use Au9500\LaravelBigDecimalCast\BigDecimalCastServiceProvider;
use Brick\Math\RoundingMode;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            BigDecimalCastServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // In-memory SQLite test database
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Default config
        $app['config']->set('big-decimal-cast.scale', 2);
        $app['config']->set('big-decimal-cast.rounding_mode', RoundingMode::HALF_UP);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Create the test table
        Schema::create('fake_models', function (Blueprint $table): void {
            $table->id();
            $table->string('value')->nullable();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('fake_models');
        parent::tearDown();
    }
}
