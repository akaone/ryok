<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StaffNerIndex extends Component
{
    public function render()
    {
        return view('livewire.staff-ner-index')
            ->extends('layouts.dash')
            ->section('body');
    }
}
