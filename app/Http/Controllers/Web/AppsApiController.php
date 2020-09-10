<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppsApiController extends Controller
{
    /**
     */
    public function index()
    {
        return view("apps-api.apps-api-index");
    }
}
