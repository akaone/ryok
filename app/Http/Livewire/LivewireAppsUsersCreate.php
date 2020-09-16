<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Utils\FreshAppUser;

class LivewireAppsUsersCreate extends Component
{
    public $members = [
        ['email' => '', 'role' => ''],
    ];
    private $appId;
    private $freshUser;


    public function mount()
    {
        $this->appId = request()->appId;
        $this->freshUser = FreshAppUser::user(auth()->user()->id, $this->appId);

    }
    
    public function addRow()
    {
        $this->validate([
            'members.*.email' => 'required|email',
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


    public function sendInvites()
    {
        $this->validate([
            'members.*.email' => 'required|email',
            'members.*.role' => 'required|in:support,admin,operation,developer',
        ]);
    }
    

    public function render()
    {
        return view('livewire.livewire-apps-users-create');
    }
}
