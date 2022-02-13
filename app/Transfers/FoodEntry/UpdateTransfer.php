<?php

namespace App\Transfers\FoodEntry;

use Carbon\Carbon;

class UpdateTransfer
{
    public function __construct(
        public readonly string $name,
        public readonly Carbon $dateTime,
        public readonly float $calories,
        public readonly float $price,
    )
    {
    }
}
