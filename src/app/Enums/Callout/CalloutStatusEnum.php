<?php

namespace App\Enums\Callout;

/**
 * @method static self open()
 * @method static self closed()
 */
enum CalloutStatusEnum: string
{
    case open = 'open';
    case closed = 'closed';
}
