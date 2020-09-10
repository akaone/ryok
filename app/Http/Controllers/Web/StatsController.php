<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Web\AppsRepository;

class StatsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if(auth()->user()->type != 'member') {
            return redirect()->route('dashboard.apps.list');
        }

        $appsRepo = new AppsRepository();
        $firstApp = $appsRepo->getFirstApp($user->id);

        if(!$firstApp) {
            return redirect()->route('dashboard.apps.create');
        }

        return redirect()->route('dashboard.apps.index', ['appId' => $firstApp->id]);
    }
}
