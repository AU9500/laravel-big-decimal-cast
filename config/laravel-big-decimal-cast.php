<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Scale For BigDecimalCast
    |--------------------------------------------------------------------------
    |
    | This value defines the default number of decimal places used when
    | storing BigDecimal values to the database.
    |
    */
    'scale' => 2,

    /*
    |--------------------------------------------------------------------------
    | Default Rounding Mode
    |--------------------------------------------------------------------------
    |
    | You can also configure the default rounding mode if needed. This should
    | be one of the Brick\Math\RoundingMode constants.
    |
    */
    'rounding_mode' => \Brick\Math\RoundingMode::HALF_UP,
];
