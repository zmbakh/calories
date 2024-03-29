<?php

namespace App\Services\Auth;

use App\Enums\User\Role;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;

class RegisterService
{
    /**
     * @param RegisterRequest $request
     * @return array
     */
    #[ArrayShape(['token' => "\Laravel\Sanctum\string|string", 'user' => "\App\Models\User"])]
    public function register(RegisterRequest $request): array
    {
        $user = $this->createUser($request);

        return [
            'token' => $user->createToken(time())->plainTextToken,
            'user' => $user,
        ];
    }

    /**
     * @param RegisterRequest $request
     * @return User
     */
    protected function createUser(RegisterRequest $request): User
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = Role::User;
        $user->calorie_limit = User::DEFAULT_CALORIE_LIMIT;
        $user->save();

        return $user;
    }
}
