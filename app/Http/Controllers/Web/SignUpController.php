<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class SignUpController extends Controller
{
    public function index()
    {
        return view('signup/signup-index');
    }

    /**
     * Page to display that email has been sent.
     *
     */
    public function done()
    {
        return view('signup.signup-done');
    }

    /**
     * Verify the user email.
     *
     */
    public function update()
    {
        return view('signup.signup-update');
    }
}
