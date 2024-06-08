<?php

namespace App\Enums\User\UserContactMethod;

use Closure;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self telephone()
 * @method static self email()
 */
final class UserContactMethodTypeEnum extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => Str::snake($name);
    }
}
