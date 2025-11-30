<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast\Tests;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class BigDecimalCastTest extends TestCase
{
    public function testCastsStoredValuesToBigDecimal(): void
    {
        $model = FakeModel::create(['value' => '12.3456']);
        $model->refresh();

        $this->assertInstanceOf(BigDecimal::class, $model->value);
        // scale=2 -> 12.35
        $this->assertSame('12.35', (string) $model->value);
    }

    public function testAppliesScaleAndRoundingModeOnSave(): void
    {
        config(['laravel-big-decimal-cast.scale' => 2]);
        config(['laravel-big-decimal-cast.rounding_mode' => RoundingMode::HALF_UP]);

        $model = FakeModel::create(['value' => '12.3456']);
        $model->refresh();

        // 12.3456 → scale 2, HALF_UP → 12.35
        $this->assertSame('12.35', $model->value->__toString());
    }

    public function testHandlesNullValues(): void
    {
        $model = FakeModel::create(['value' => null]);
        $model->refresh();

        $this->assertInstanceOf(BigDecimal::class, $model->value);
        // null -> 0 -> toScale(2) -> "0.00"
        $this->assertSame('0.00', (string) $model->value);
    }

    public function testAcceptsNumbersStringsAndBigDecimalInstances(): void
    {
        $model = new FakeModel();

        // number
        $model->value = 10.5;
        $model->save();
        $model->refresh();
        // 10.5 -> toScale(2) -> "10.50"
        $this->assertSame('10.50', (string) $model->value);

        // string
        $model->value = '7.777';
        $model->save();
        $model->refresh();
        // "7.777" -> toScale(2) HALF_UP -> "7.78"
        $this->assertSame('7.78', (string) $model->value);

        // BigDecimal
        $bd = BigDecimal::of('3.14159');
        $model->value = $bd;
        $model->save();
        $model->refresh();

        $this->assertInstanceOf(BigDecimal::class, $model->value);
        // 3.14159 -> toScale(2) HALF_UP -> "3.14"
        $this->assertSame('3.14', (string) $model->value);
    }

    public function testUsesConfiguredScaleAndRoundingMode(): void
    {
        config(['laravel-big-decimal-cast.scale' => 3]);
        config(['laravel-big-decimal-cast.rounding_mode' => RoundingMode::DOWN]);

        $model = FakeModel::create(['value' => '9.87654']);
        $model->refresh();

        // scale 3, DOWN → 9.876
        $this->assertSame('9.876', (string) $model->value);
    }
}
