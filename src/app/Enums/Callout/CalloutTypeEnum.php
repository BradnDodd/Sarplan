<?php

namespace App\Enums\Callout;

/**
 * @method static self open()
 * @method static self closed()
 */
enum CalloutTypeEnum: string
{
    case open = 'open';
    case closed = 'closed';
}
