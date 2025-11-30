<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class BigDecimalCast
 *
 * @package Au9500\LaravelBigDecimalCast
 */
class BigDecimalCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): BigDecimal
    {
        return BigDecimal::of($value ?? 0);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        $bigDecimal = $value instanceof BigDecimal
            ? $value
            : BigDecimal::of($value ?? 0);

        $scale = (int) Config::get('laravel-big-decimal-cast.scale', 2);
        $roundingMode = Config::get('laravel-big-decimal-cast.rounding_mode', RoundingMode::HALF_UP);

        return $bigDecimal
            ->toScale($scale, $roundingMode)
            ->__toString();
    }
}
