<?php

namespace App\Enums\Callout;

use Closure;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self open()
 * @method static self closed()
 */
final class CalloutStatusEnum extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => Str::snake($name);
    }
}
