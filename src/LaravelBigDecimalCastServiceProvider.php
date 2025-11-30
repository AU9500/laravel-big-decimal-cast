<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelBigDecimalCastServiceProvider
 *
 * @package Au9500\LaravelBigDecimalCast
 */
class LaravelBigDecimalCastServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-big-decimal-cast.php',
            'laravel-big-decimal-cast'
        );
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/laravel-big-decimal-cast.php' => $this->getConfigPath(),
        ], 'laravel-big-decimal-cast-config');
    }

    /**
     * @return string
     */
    protected function getConfigPath(): string
    {
        if (function_exists('config_path')) {
            return config_path('laravel-big-decimal-cast.php');
        }

        return $this->app->basePath('config/laravel-big-decimal-cast.php');
    }
}
