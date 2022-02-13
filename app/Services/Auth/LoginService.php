<?php

namespace App\Services\Auth;

use App\Exceptions\ErrorException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;

class LoginService
{
    /**
     * @param LoginRequest $request
     * @return array
     * @throws \Exception
     */
    #[ArrayShape(['token' => "\Laravel\Sanctum\string|string", 'user' => "\App\Models\User"])]
    public function login(LoginRequest $request): array
    {
        $user = $this->getUser($request->input('email'));

        $this->checkPassword($request->input('password'), $user);

        return [
            'token' => $user->createToken(time())->plainTextToken,
            'user' => $user,
        ];
    }

    /**
     * @param string $email
     * @return User|null
     */
    protected function getUser(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param string $password
     * @param User|null $user
     * @return void
     * @throws \Exception
     */
    protected function checkPassword(string $password, ?User $user)
    {
        if (!$user || !Hash::check($password, $user->password)) {
            throw new ErrorException('You\'ve entered an incorrect email address or password');
        }
    }
}
