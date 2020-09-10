<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivewireLoginIndex extends Component
{
    public $email;
    public $password;


    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password, 'state' => 'ACTIVATED'])) {
            if(auth()->user()->type == 'member') {
                return redirect()->route('dashboard.stats.index');
            }
            return redirect()->route('dashboard.apps.list');
        }
        session()->flash('error', trans('login.error_email'));
        $this->password = "";
    }


    public function render()
    {
        return view('livewire.livewire-login-index');
    }
}
