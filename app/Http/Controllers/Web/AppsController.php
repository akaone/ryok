<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Web\AppsRepository;

class AppsController extends Controller
{
    /**
     * @var AppsRepository
     */
    private $rp;

    public function __construct() {
        $this->rp = new AppsRepository();
    }

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
     * Display the specified app.
     *
     * @param  int  $appId
     */
    public function show($appId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
