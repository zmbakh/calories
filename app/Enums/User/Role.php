<?php

namespace App\Enums\User;

enum Role: int
{
    case User = 1;
    case Admin = 2;

    /**
     * @return string
     */
    public function text(): string
    {
        return match($this) {
            self::User => 'User',
            self::Admin => 'Admin',
        };
    }
}
