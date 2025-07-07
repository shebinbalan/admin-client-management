<?php

namespace App\Helpers;

use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserStatus;

class UserHelper
{
    public static function getClientUsers()
    {
        return User::where('user_type', UserType::CLIENT)
                  ->where('status', UserStatus::ACTIVE)
                  ->select('id', 'name', 'email')
                  ->get();
    }

    public static function getClientUsersForSelect()
    {
        return User::where('user_type', UserType::CLIENT)
                  ->where('status', UserStatus::ACTIVE)
                  ->pluck('name', 'id');
    }

    public static function formatUserStatus($status)
    {
        return $status->label();
    }

    public static function getUserStatusBadge($status)
    {
        return '<span class="badge bg-' . $status->color() . '">' . $status->label() . '</span>';
    }
}