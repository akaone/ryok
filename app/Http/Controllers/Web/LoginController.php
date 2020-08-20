<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function index()
    {
        return view('login/login-index');
    }


    public function destroy()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
