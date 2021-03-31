<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\App;
use App\Models\AppUser;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Web\AppsStateRepository;
use App\Exceptions\UserAccessLevelException;

class AppsStateController extends Controller
{
    /**
     * @var AppsStateRepository
     */
    protected $rp;

    public function __construct() {
        $this->rp = new AppsStateRepository();
    }

    /**
     * Update the specified app's state.
     * ACL staff-admin & app-state
     * @param Request $request
     * @param $appId
     * @return \Illuminate\Http\RedirectResponse
     * @throws UserAccessLevelException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $appId)
    {
        $this->validate($request, [
            'state' => 'required|in:ACTIVATED,DEACTIVATED,REJECTED,DELETED',
            'state_reason' => 'required_if:state,REJECTED,DEACTIVATED'
        ]);

        $user = Auth::user();
        $app = App::findOrFail($appId);
        $state = $request->input('state');
        $stateReason = $request->input('state_reason');

        if(!$user->fresh()->hasPermissionTo('app-state')) {
            $appUser = AppUser::where([
                'user_id' => $user->id,
                'app_id' => $app->id,
            ])->first();
            if($appUser == null || !$appUser->fresh()->hasPermissionTo('app-state')) {
                throw new UserAccessLevelException;
            }
        }
        switch ($state) {
            case 'ACTIVATED':
                if(!$user->fresh()->hasRole('staff-admin')) { throw new UserAccessLevelException; }
            case 'REJECTED':
                if(!$user->fresh()->hasRole('staff-admin')) { throw new UserAccessLevelException; }
            default:
                break;
        }

        $this->rp->editAppState($user->id, $appId, [
            'state' => $state,
            'state_reason' => $stateReason,
        ]);

        return back();
    }
}
