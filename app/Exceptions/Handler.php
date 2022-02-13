<?php

namespace App\Exceptions;

use App\Exceptions\Handlers\DefaultHandler;
use App\Exceptions\Handlers\NotFoundHttpExceptionHandler;
use App\Exceptions\Handlers\ValidationExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected array $handlers = [
        ValidationException::class => ValidationExceptionHandler::class,
        NotFoundHttpException::class => NotFoundHttpExceptionHandler::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed|object|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (!$this->isApiRoute($request)) {
            return parent::render($request, $exception);
        }

        $className = get_class($exception);

        if (isset($this->handlers[$className])) {
            return (new $this->handlers[$className])->response($request, $exception);
        }

        return (new DefaultHandler())->response($request, $exception);
    }

    /**
     * @param $request
     * @return bool
     */
    private function isApiRoute($request): bool
    {
        return Str::startsWith($request->getRequestUri(), ['/api', 'api']);
    }
}
