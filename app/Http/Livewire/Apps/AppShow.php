<?php

namespace App\Http\Livewire\Apps;

use App\Models\App;
use App\Repositories\Web\AppCarriersRepository;
use App\Repositories\Web\AppsUsersRepository;
use App\Utils\HashUuid;
use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;
use App\Exceptions\UserAccessLevelException;

/**
 * Display app details.
 * ACL -> ['staff-*', 'app-read']
 */
class AppShow extends Component
{
    public $appId;
    public $infos;
    public $members;
    public $creditOperations;
    public $debitOperations;
    public $pickedCarriers = [];
    public $carrierLoaded = false;

    public function mount()
    {
        $this->appId = request()->appId;
    }

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


        $appCarriers = $this->getAppCarriers($decodedAppId);

        if(collect($this->pickedCarriers)->isEmpty() && !$this->carrierLoaded) {
            $appCarriers->each(function($carrier, $key)  {
                if(!$carrier->where('activated', true)->isEmpty()) {
                    $this->pickedCarriers = collect($this->pickedCarriers)->push($key);
                }
            });
            $this->carrierLoaded = true;
        }

        return view('apps.app-show', [
            'appCarriers' => $appCarriers,
        ]);
    }

    private function getAppCarriers(string $appId): \Illuminate\Support\Collection
    {
        $appCarriersRep = new AppCarriersRepository();

        $carriers = $appCarriersRep->findAllAppCarriers($appId);
        return $carriers->groupBy('country');
    }
}
