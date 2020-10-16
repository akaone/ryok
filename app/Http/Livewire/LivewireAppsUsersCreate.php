<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Utils\FreshAppUser;
use App\Repositories\Web\AppsUsersRepository;
use App\Rules\IsMemberAlreadyAppUser;

class LivewireAppsUsersCreate extends Component
{
    public $members = [
        ['email' => '', 'role' => ''],
    ];
    public $appId;
    private $freshUser;


    public function mount($appId)
    {
        $this->appId = $appId;
        $this->freshUser = FreshAppUser::user(auth()->user()->id, $this->appId);
    }
    
    public function addRow()
    {
        $this->validate([
            'members.*.email' => ['required', 'email', new IsMemberAlreadyAppUser($this->appId)],
            'members.*.role' => 'required|in:support,admin,operation,developer',
        ]);

       $this->members [] = ['email' => '', 'role' => '']; 
    }

    public function removeRow($index)
    {
        if(count($this->members) == 1) {
            unset($this->members[$index]);
            $this->members [] = ['email' => '', 'role' => '']; 
        } else {
            unset($this->members[$index]);
        }
    }


    public function sendInvites(AppsUsersRepository $appsUsersRep)
    {
        $this->validate([
            'members.*.email' => ['required', 'email', new IsMemberAlreadyAppUser($this->appId)],
            'members.*.role' => 'required|in:support,admin,operation,developper',
        ]);

        $appsUsersRep->registerInvitedMembers($this->members, $this->appId);

        # todo: send email to users

        session()->flash('success', trans('apps.users.create.success'));

        return redirect()->to(route('dashboard.apps.users.index', ['appId' => $this->appId]));
    }
    

    public function render()
    {
        return view('livewire.livewire-apps-users-create');
    }
}
