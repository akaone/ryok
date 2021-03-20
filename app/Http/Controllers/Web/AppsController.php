<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AppsController extends Controller
{

    /**
     * Display a listing of user's apps.
     * ACL -> []
     *
     */
    public function index()
    {
        return view('apps.apps-index');
    }


    /**
     * Show the form for creating an app.
     * ACL -> []
     */
    public function create()
    {
        return view('apps.apps-create');
    }

    /**
     * Display app details.
     * ACL -> ['staff-*', 'app-read']
     */
    public function show($appId)
    {
        return view('apps.app-show', [
            'appId' => $appId
        ]);
    }

}
