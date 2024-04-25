<?php

namespace App\Enums\User;

/**
 * @method static self mountainRescue()
 * @method static self police()
 * @method static self ambulance()
 * @method static self coastguard()
 */
enum TeamTypeEnum: string
{
    case mountainRescue = 'mountain_rescue';
    case police = 'police';
    case ambulance = 'ambulance';
    case coastguard = 'coastguard';
}
