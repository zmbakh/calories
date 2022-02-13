<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\Errors\ErrorResponse;
use Throwable;

class NotFoundHttpExceptionHandler extends AbstractHandler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        $code = $this->checkCode($exception->getCode());

        return (new ErrorResponse([
            'message' => $exception->getMessage() ?: 'The page not found',
        ]))->response()->setStatusCode($code);
    }
}
