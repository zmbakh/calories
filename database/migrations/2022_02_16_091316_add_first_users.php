<?php

use App\Enums\User\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now();

        DB::table('users')->insert([
            'name' => 'Zanggar',
            'last_name' => 'Muratkhan',
            'email' => 'zmbakh@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => $now,
            'updated_at' => $now,
            'role' => Role::User,
            'calorie_limit' => User::DEFAULT_CALORIE_LIMIT,
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Doe',
            'email' => 'zmbakh+admin@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => $now,
            'updated_at' => $now,
            'role' => Role::Admin,
            'calorie_limit' => User::DEFAULT_CALORIE_LIMIT,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
