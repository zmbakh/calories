<?php

namespace Database\Seeders;

use App\Models\FoodEntry;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $users = User::get();

        foreach ($users as $user) {
            FoodEntry::factory()->count(1000)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
