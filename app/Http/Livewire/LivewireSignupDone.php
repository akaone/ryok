<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\SignUpRepository;

class LivewireSignupDone extends Component
{

    public function render()
    {
        $signUpRepository = new SignUpRepository();
        $email = $signUpRepository->getEmailFromId(request()->userId);
        return view('livewire.livewire-signup-done', [
            'email' => $email,
        ]);
    }
}
