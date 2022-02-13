<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\Errors\ErrorResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class ValidationExceptionHandler extends AbstractHandler
{
    /**
     * @param $request
     * @param Throwable $exception
     * @return JsonResponse
     */
    public function response($request, Throwable $exception): JsonResponse
    {
        return (new ErrorResponse([
            'message' => $exception->getMessage(),
            'errors'  => $exception->errors(),
        ]))->response()->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
