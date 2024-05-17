<?php

namespace App\Enums\User;

use Closure;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self mountainRescue()
 * @method static self police()
 * @method static self ambulance()
 * @method static self coastguard()
 */
final class TeamTypeEnum extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => Str::snake($name);
    }
}
