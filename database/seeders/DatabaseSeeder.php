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
            $date = now();
            for ($i = 0; $i < 40; $i++) {
                for ($k = 0; $k < 10; $k++) {
                    FoodEntry::factory()->create([
                        'user_id' => $user->id,
                        'date_time' => $date->toDateString(). ' '. mt_rand(0, 23) . ':' . mt_rand(0, 59),
                    ]);
                }
                $date->subDay();
            }
        }
    }
}
