<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StaffUsersIndex extends Component
{
    public function render()
    {
        return view('livewire.staff-users-index')
            ->extends('layouts.dash')
            ->section('body');;
    }
}
