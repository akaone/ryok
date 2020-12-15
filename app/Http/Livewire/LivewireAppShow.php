<?php

namespace App\Http\Livewire;

use App\Models\App;
use App\Repositories\Web\AppsUsersRepository;
use App\Utils\HashUuid;
use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;
use App\Exceptions\UserAccessLevelException;

class LivewireAppShow extends Component
{
    public $appId;
    public $infos;
    public $members;
    public $creditOperations;
    public $debitOperations;

    public function activateApp(AppsRepository $appsRep)
    {
        if(!auth()->user()->fresh()->hasPermissionTo('app-state')) {
            throw new UserAccessLevelException;
        }
        # todo: send notification mail to user

        $short = new ShortUuid();
        $appsRep->validationAction($short->decode($this->appId), 'ACTIVATED');

        session()->flash('success',  trans('apps.app.show.app-activated'));
    }


    public function deactivateApp(AppsRepository $appsRep)
    {

        if(!auth()->user()->fresh()->hasPermissionTo('app-state')) {
            throw new UserAccessLevelException;
        }
        # todo: send notification mail to user

        $short = new ShortUuid();
        $appsRep->validationAction($short->decode($this->appId), 'DEACTIVATED');

        session()->flash('success',  trans('apps.app.show.app-deactivated'));
    }


    public function rejectApp(AppsRepository $appsRep)
    {

        if(!auth()->user()->fresh()->hasPermissionTo('app-state')) {
            throw new UserAccessLevelException;
        }
        # todo: send notification mail to user

        $short = new ShortUuid();
        $appsRep->validationAction($short->decode($this->appId), 'REJECTED');

        session()->flash('success',  trans('apps.app.show.app-rejected'));
    }


    public function render()
    {
        $appsRep = new AppsRepository();
        $appsUsersRep = new AppsUsersRepository();

        $short = new ShortUuid();
        $decodedAppId = $short->decode($this->appId);

        /** @var App $infos */
        $infos = $appsRep->getApp($decodedAppId);

        $primaryAccount = $infos->primaryAccount;
        $this->creditOperations = HashUuid::forArrayCollection($primaryAccount->creditOperations, ["id", "account_id"]);
        $this->debitOperations = HashUuid::forArrayCollection($primaryAccount->debitOperations, ["id", "account_id"]);

        $this->infos =  HashUuid::forCollection($infos, ["id"]);

        $this->members = HashUuid::forArrayCollection(
            $appsUsersRep->appUsersList($decodedAppId, null),
            ["app_users_id"]
        );

        return view('livewire.livewire-app-show');
    }
}
