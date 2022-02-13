<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\Errors\ErrorResponse;
use Throwable;

class DefaultHandler extends AbstractHandler
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
            'message' => $exception->getMessage() ?: __('errors.internal_server_error'),
        ]))->response()->setStatusCode($code);
    }

}
