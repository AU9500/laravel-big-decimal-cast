<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelBigDecimalCastServiceProvider
 */
class LaravelBigDecimalCastServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-big-decimal-cast.php',
            'laravel-big-decimal-cast'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/laravel-big-decimal-cast.php' => $this->getConfigPath(),
        ], 'laravel-big-decimal-cast-config');
    }

    protected function getConfigPath(): string
    {
        if (function_exists('config_path')) {
            return config_path('laravel-big-decimal-cast.php');
        }

        return $this->app->basePath('config/laravel-big-decimal-cast.php');
    }
}
