<?php

namespace App\Exceptions;

use Exception;

class UserAccessLevelException extends Exception
{
    protected $message = "USER_ACL_EXCEPTION";


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
                'message' => 'USER_ACL_EXCEPTION',
                'error' => [],
            ];

            return response()->json($json, 401);
        }

        return back()->withErrors("USER_ACL_EXCEPTION");
    }
}
