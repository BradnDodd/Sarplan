<?php

namespace App\Enums\User\UserGroup;

/**
 * @method static self public()
 * @method static self private()
 * @method static self teamOnly()
 */
enum UserGroupPrivacyEnum: string
{
    case public = 'public';
    case private = 'private';
    case teamOnly = 'team_only';
}
