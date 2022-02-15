<?php

namespace App\Transfers\FoodEntry;

use App\Models\User;
use Carbon\Carbon;

class StoreTransfer
{
    public function __construct(
        public readonly User $user,
        public readonly string $name,
        public readonly Carbon $dateTime,
        public readonly float $calories,
        public readonly ?float $price,
    )
    {
    }
}
