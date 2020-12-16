<?php

namespace App\Http\Livewire;

use App\Repositories\Web\StaffMessagesRepository;
use Livewire\Component;

class StaffMessagesIndex extends Component
{
    public $transactionAmount;
    public $transactionReference;
    private $pendingMessages = [];
    private $treatedMessages = [];

    public function messages(StaffMessagesRepository $messagesRepository)
    {
        $this->pendingMessages = $messagesRepository->pendingMessages();
        $this->treatedMessages = $messagesRepository->treatedMessages();
    }

    public function render()
    {
        $this->messages(new StaffMessagesRepository());
        return view('livewire.staff-messages-index', [
            'pendingMessages' => $this->pendingMessages,
            'treatedMessages' => $this->treatedMessages,
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
