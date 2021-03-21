<?php

namespace App\Http\Livewire\Signup;

use Livewire\Component;
use App\Repositories\Web\SignUpRepository;

class SignupUpdate extends Component
{
    public function render()
    {
        $signUpRepository = new SignUpRepository();
        $isVerified = $signUpRepository->verifyEmail(request()->emailLink);
        return view('signup.signup-update', ['isVerified' => $isVerified])
            ->extends('layouts.home')
            ->section('body');
    }
}
