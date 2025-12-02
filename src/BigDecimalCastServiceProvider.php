<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast;

use Illuminate\Support\ServiceProvider;

/**
 * Class BigDecimalCastServiceProvider
 */
class BigDecimalCastServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/big-decimal-cast.php',
            'big-decimal-cast'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/big-decimal-cast.php' => $this->getConfigPath(),
        ], 'big-decimal-cast-config');
    }

    protected function getConfigPath(): string
    {
        if (function_exists('config_path')) {
            return config_path('big-decimal-cast.php');
        }

        return $this->app->basePath('config/big-decimal-cast.php');
    }
}
