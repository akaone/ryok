<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LivewireAppsUsersCreate extends Component
{
    public $members = [
        ['email' => '', 'role' => ''],
    ];

    
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
