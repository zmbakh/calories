<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\Errors\ErrorResponse;
use Illuminate\Http\Response;
use Throwable;

class AuthenticationExceptionHandler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        return (new ErrorResponse([
            'message' => __('Unauthenticated'),
        ]))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

}
