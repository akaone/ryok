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
        $user = Auth::user();
        $apps = $this->rp->getUserApps($user->type, $user->id);
        return Inertia::render('apps.apps-index', [
            'apps' => $apps,
        ]);
    }

    /**
     * Show the form for creating an app.
     * ACL -> []
     */
    public function create()
    {
        return Inertia::render('Apps/AppsCreate');
    }

    /**
     * Store a newly created app.
     * ACL -> []
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'icon' => 'nullable|image',
            'platform' => 'required|in:ANDROID,IOS,WEB,HYBRIDE',
            'package_name' => 'required_if:platform,ANDROID,IOS',
            'website_url' => 'required_if:platform,WEB|url',
            'webhook_url' => 'nullable|url',
        ]);

        $user = Auth::user();

        $input = $request->except(['icon']);
        $image = $request->hasFile('icon') ? $request->file('icon') : null;

        $storedAppUuid = $this->rp->storePendingApp($input, $image, $user->id);

        $this->rp->createAccountForApp($storedAppUuid);

        return redirect()->route('dashboard.apps.index');
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
