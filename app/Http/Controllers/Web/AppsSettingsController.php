<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppsSettingsController extends Controller
{
    public function index()
    {
        return view('apps-settings.apps-settings-index');
    }
}
