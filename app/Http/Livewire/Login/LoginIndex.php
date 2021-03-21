<?php

namespace App\Http\Livewire\Login;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginIndex extends Component
{
    public $email;
    public $password;


    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if(auth()->attempt(['email' => $this->email, 'password' => $this->password, 'state' => 'ACTIVATED'])) {
            if(auth()->user()->type == 'member') {
                return redirect()->route('dashboard.stats.index');
            }
            return redirect()->route('dashboard.staff.apps.list');
        }
        session()->flash('error', trans('login.error_email'));
        $this->password = "";
    }


    public function render()
    {
        return view('login.login-index')
            ->extends('layouts.home')
            ->section('body');
    }
}