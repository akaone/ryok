<?php

namespace App\Http\Livewire\AppsApi;

use App\Repositories\Web\AppsRepository;
use App\Utils\FreshAppUser;
use App\Utils\HashUuid;
use Livewire\Component;

class AppsApiIndex extends Component
{
    public $appId;
    public $webhookUrl;

    public function mount()
    {
        $this->appId = request()->appId;
    }

    /**
     * @param AppsRepository $appsRepository
     */
    public function updateAppWebhook(AppsRepository $appsRepository)
    {
        $this->validate([
            'webhookUrl' => ["required", "url", "starts_with:https"],
        ]);

        $appUser = FreshAppUser::user(auth()->user()->id, $this->appId);
        if(!$appUser->fresh()->hasPermissionTo('app-keys-reset')) {
            session()->flash('error', trans('user.acl.exception'));
            return null;
        }

        $appsRepository->updateAppWebhook($this->webhookUrl, HashUuid::decode($this->appId));

        session()->flash('success', trans('apps.apps-api.index.update-webhook-success'));
    }

    public function render()
    {
        $appsRep = new AppsRepository();
        $appInfos = $appsRep->getApp(HashUuid::decode($this->appId));

        return view('apps-api.apps-api-index', [
            'appId' => $this->appId,
            'appInfos' => $appInfos,
        ]);
    }
}
