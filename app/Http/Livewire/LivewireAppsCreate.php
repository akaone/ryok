<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Repositories\Web\AppsRepository;
use App\Repositories\Web\StaffCarriersRepository;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

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

    public $carriersList;
    public $pickedCarriers = [];

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
            'appIcon' => 'image|max:2048',
            'pickedCarriers' => 'required|array|distinct|exists:carriers,ibm',
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


        $appRep->linkInitialCarriers($storedAppUuid, $this->pickedCarriers);

        $short = new ShortUuid();

        session()->flash('success', 'Application crée avec succés');
        return redirect()->route('dashboard.apps.index', ['appId' => $short->encode(Uuid::fromString($storedAppUuid))]);
        
    }


    public function render()
    {
        $staffCarriersRep = new StaffCarriersRepository();
        $short = new ShortUuid();

        $carriersList = $staffCarriersRep->activeCarriersList();
        $carriersList->each(function($item, $key) use ($short, $carriersList) {
            $carriersList[$key]->id = $short->encode(Uuid::fromString($item->id));
        });
        $this->carriersList = $carriersList;


        return view('livewire.livewire-apps-create');
    }
}
