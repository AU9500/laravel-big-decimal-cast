# 📘 Laravel Big Decimal Cast

A lightweight Laravel package that provides a highly accurate BigDecimal Eloquent Cast based on brick/math.
Designed for financial, scientific, or high-precision calculations where standard PHP floats fail.

## 🚀 Features

- Casts database values into Brick\Math\BigDecimal
- Automatically converts the value back when saving
- Fully configurable precision (scale) and rounding mode
- Zero dependencies besides brick/math and Laravel support
- Auto-discovery support for Laravel
- Allows safe and precise arithmetic operations

## 📦 Installation

Install the package via Composer:

    composer require au9500/laravel-big-decimal-cast

For development, you can load the package via a local path repository inside your application composer.json.

## 🛠 Usage

### 1. Add the cast to your Eloquent model

    use Au9500\LaravelBigDecimalCast\Casts\BigDecimalCast;

    class Product extends Model
    {
        protected $casts = [
            'price' => BigDecimalCast::class,
        ];
    }

### 2. Use it like a normal number — but with precision

    $product = Product::find(1);

    // BigDecimal instance
    $price = $product->price;

    // Add numbers with precision
    $product->price = $product->price->plus('19.99');

    $product->save();

## ⚙️ Configuration

Publish the configuration file:

    php artisan vendor:publish --tag=laravel-big-decimal-cast-config

This will create:

config/laravel-big-decimal-cast.php

    <?php

    use Brick\Math\RoundingMode;

    return [
        'scale' => 2,
        'rounding_mode' => RoundingMode::HALF_UP,
    ];

### Change scale globally

    'scale' => 4,

Now all casts will store values with 4 decimal places.

## 🔍 How It Works

### Casting on retrieval:

    return BigDecimal::of($value ?? 0);

### Casting on save:

    $scale = Config::get('laravel-big-decimal-cast.scale', 2);
    $roundingMode = Config::get('laravel-big-decimal-cast.rounding_mode', RoundingMode::HALF_UP);

    return $bigDecimal->toScale($scale, $roundingMode)->__toString();

## 🧪 Example Migration

    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('price');
        $table->timestamps();
    });

Using a string or decimal column is recommended depending on precision needs.

## 🛡 Requirements

- PHP 8.2+
- Laravel 10 / 11 / 12
- brick/math ^0.11

## 📚 Why BigDecimal?

Float inaccuracies example:

    0.1 + 0.2  // results in 0.30000000000000004

BigDecimal avoids this via arbitrary precision decimal arithmetic.

## 🤝 Contributing

1. Fork this repository
2. Create a feature branch
3. Commit your changes
4. Open a Pull Request

## 📄 License

This package is open-source and licensed under the MIT License.
