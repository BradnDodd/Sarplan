<?php

namespace App\Enums\User;

/**
 * @method static self telephone()
 * @method static self email()
 */
enum UserContactMethodTypeEnum: string
{
    case telephone = 'telephone';
    case email = 'email';
}
