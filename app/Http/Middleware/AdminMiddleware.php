<?php

namespace App\Http\Middleware;

use App\Enums\User\Role;
use App\Exceptions\ErrorException;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws ErrorException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== Role::Admin) {
            throw new ErrorException('Forbidden', 403);
        }

        return $next($request);
    }
}
