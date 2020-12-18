<?php

namespace App\Exceptions;

use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\Exceptions\BypassViewHandler;

class MerchantApiAuthlException extends Exception
{
    use BypassViewHandler;
    protected $message = ApiErrorCode::MERCHANT_API_AUTH_PROVIDE_SECRET_KEY;


    public function __construct($msg = null)
    {
        if($msg) {
            $this->message = $msg;
        }
    }


    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  Request
     * @return Application|Factory|View|JsonResponse|Response
     */
    public function render($request)
    {
        if($request->ajax() || $request->wantsJson()) {
            return ApiResponse::create(
                false,
                $this->message,
                null,
                null,
                401
            );
        }

        return view('acl.no-access', [
            'title' => $this->message,
        ]);
    }
}
