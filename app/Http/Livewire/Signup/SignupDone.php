<?php

namespace App\Http\Livewire\Signup;

use Livewire\Component;
use App\Repositories\Web\SignUpRepository;

/**
 * Page to display that email has been sent.
 *
 */
class SignupDone extends Component
{

    public function render()
    {
        $signUpRepository = new SignUpRepository();
        $email = $signUpRepository->getEmailFromId(request()->userId);
        return view('signup.signup-done', [
            'email' => $email,
        ])
        ->extends('layouts.home')
        ->section('body');
    }
}
