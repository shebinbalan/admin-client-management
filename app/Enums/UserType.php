<?php

namespace App\Enums;

enum UserType: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::CLIENT => 'Client User',
        };
    }
}