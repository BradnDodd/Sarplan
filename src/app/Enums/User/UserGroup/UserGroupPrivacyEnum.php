<?php

namespace App\Enums\User\UserGroup;

use Closure;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self public()
 * @method static self private()
 * @method static self teamOnly()
 */
final class UserGroupPrivacyEnum extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => Str::snake($name);
    }
}
