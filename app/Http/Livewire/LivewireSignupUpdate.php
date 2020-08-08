<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\SignUpRepository;

class LivewireSignupUpdate extends Component
{
    public function render()
    {
        $signUpRepository = new SignUpRepository();
        $isVerified = $signUpRepository->verifyEmail(request()->emailLink);
        return view('livewire.livewire-signup-update', ['isVerified' => $isVerified]);
    }
}
