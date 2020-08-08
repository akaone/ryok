<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Repositories\Web\SignUpRepository;

class LivewireSignupIndex extends Component
{
    public $email;
    public $name;
    public $gender = 'M';
    public $password;
    public $confirmPassword;


    public function createAccount(SignUpRepository $signUpRepository)
    {
        $this->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'min:3'],
            'password' => ['required', 'string', 'min:6'],
            'confirmPassword' => ['required', 'same:password'],
            'gender' => ['required', 'in:M,F'],
        ]);

        $data = [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'gender' => $this->gender,
        ];

        $createdUser = $signUpRepository->newMemberUser($data, Uuid::generate()->string);
        // todo: send email

        return redirect()->route('sign-up.done', ['userId' => $createdUser->id]);
    }


    public function render()
    {
        return view('livewire.livewire-signup-index');
    }
}
