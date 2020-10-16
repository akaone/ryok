<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Livewire\Exceptions\BypassViewHandler;

class UserAccessLevelException extends Exception
{
    use BypassViewHandler;
    protected $message = "USER_ACL_EXCEPTION";

    
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
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if($request->ajax() || $request->wantsJson()) {
            $json = [
                'success' => false,
                'message' => $this->message,
                'error' => [],
            ];

            return response()->json($json, 401);
        }

        return view('acl.no-access', [
            'title' => $this->message,
        ]);
    }
}
