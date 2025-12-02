<?php

declare(strict_types=1);

namespace Au9500\LaravelBigDecimalCast\Tests\Stubs;

use Au9500\LaravelBigDecimalCast\BigDecimalCast;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FakeModel
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
