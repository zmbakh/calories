<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\LoggenInResource;
use App\Models\User;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param RegisterService $service
     * @param RegisterRequest $request
     * @return LoggenInResource
     */
    public function register(RegisterService $service, RegisterRequest $request): LoggenInResource
    {
        return new LoggenInResource($service->register($request));
    }

    /**
     * @param LoginService $service
     * @param LoginRequest $request
     * @return LoggenInResource
     * @throws \Exception
     */
    public function login(LoginService $service, LoginRequest $request): LoggenInResource
    {
        return new LoggenInResource($service->login($request));
    }
}
