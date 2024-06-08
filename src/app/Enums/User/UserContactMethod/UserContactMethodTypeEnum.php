<?php

namespace App\Enums\User\UserContactMethod;

/**
 * @method static self telephone()
 * @method static self email()
 */
enum UserContactMethodTypeEnum: string
{
    case telephone = 'telephone';
    case email = 'email';
}
