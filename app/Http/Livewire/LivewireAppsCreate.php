<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Repositories\Web\AppsRepository;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;

class LivewireAppsCreate extends Component
{

    use WithFileUploads;

    public $appName;
    public $website;
    public $webhookUrl;
    public $organization;
    public $nif;
    public $cfe_recto;
    public $cfe_verso;
    public $appIcon;

    public function save(AppsRepository $appRep)
    {

        $this->validate([
            'appName' => 'required|string|min:4',
            'organization' => 'required|string|min:3',
            'nif' => 'required|string|min:3',
            'website' => 'required|url',
            'webhookUrl' => 'required|url',
            'cfe_recto' => 'image|max:2048',
            'cfe_verso' => 'image|max:2048',
            'appIcon' => 'image|max:2048',
        ]);

        $user = auth()->user();

        $input = [
            'name' => $this->appName,
            'webhook_url' => $this->webhookUrl,
            'website_url' => $this->website,
            'nif' => $this->nif,
            'organization' => $this->organization,
        ];

        $storedAppUuid = $appRep->storePendingApp(
            $input, $this->appIcon, $this->cfe_recto, $this->cfe_verso, $user->id);

        $appRep->createAccountForApp($storedAppUuid);

        session()->flash('success', 'Application crée avec succés');
        return redirect()->route('dashboard.apps.index', ['appId' => $storedAppUuid]);
        
    }

    public function render()
    {
        return view('livewire.livewire-apps-create');
    }
}
