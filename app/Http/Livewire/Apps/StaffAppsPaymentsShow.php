<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;

class StaffAppsPaymentsShow extends Component
{
    public $appId;
    public $paymentId;

    public function mount()
    {
        $this->appId = request()->appId;
        $this->paymentId = request()->paymentId;
    }

    public function render()
    {
        return view('apps.staff-apps-payments-show')->layout('layouts.no-modal');
    }
}
