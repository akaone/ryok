<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return JsonResponse|Response
     */
    public function render($request, Throwable $exception)
    {


        if (env('APP_ENV') == 'testing') {
            if($request->ajax() || $request->wantsJson()) {
                $json = [
                    'success' => false,
                    'error_code' => $exception->getMessage(),
                    'location' => $exception->getFile() . ":" . $exception->getLine(),
                ];

                return response()->json($json, 401);
            }
        }
        return parent::render($request, $exception);
    }
}
