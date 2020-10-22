<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Web\AppsRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

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

        $short = new ShortUuid();
        $encodedAppId = $short->encode(Uuid::fromString($firstApp->id));

        return redirect()->route('dashboard.apps.index', ['appId' => $encodedAppId]);
    }
}
