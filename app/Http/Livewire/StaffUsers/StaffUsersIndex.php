<?php

namespace App\Http\Livewire\StaffUsers;

use Livewire\Component;

class StaffUsersIndex extends Component
{
    public function render()
    {
        return view('staff-users.staff-users-index')
            ->extends('layouts.dash')
            ->section('body');;
    }
}
