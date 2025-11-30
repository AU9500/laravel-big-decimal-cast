<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast\Tests;

use Au9500\LaravelBigDecimalCast\BigDecimalCast;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FakeModel
 *
 * @package Au9500\LaravelBigDecimalCast\Tests
 */
class FakeModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'fake_models';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * @var array
     */
    protected $casts = [
        'value' => BigDecimalCast::class,
    ];
}
