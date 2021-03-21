<?php

namespace App\Http\Livewire\AppsUsers;

use App\Repositories\Web\AppsUsersRepository;
use Livewire\Component;
use App\Utils\FreshAppUser;
use App\Rules\IsMemberAlreadyAppUser;
use PascalDeVink\ShortUuid\ShortUuid;
class AppsUsersCreate extends Component
{
    public $members = [
        ['email' => '', 'role' => ''],
    ];
    public $appId;
    private $freshUser;


    public function mount()
    {
        $this->appId = request()->appId;
        $this->freshUser = FreshAppUser::user(auth()->user()->id, $this->appId);
    }

    public function addRow()
    {
        $short = new ShortUuid();
        $decodedAppId = $short->decode($this->appId);
        $this->validate([
            'members.*.email' => ['required', 'email', new IsMemberAlreadyAppUser($decodedAppId)],
            'members.*.role' => 'required|in:support,admin,operation,developper',
        ]);

       $this->members [] = ['email' => '', 'role' => ''];
    }

    public function removeRow($index)
    {
        if(count($this->members) == 1) {
            unset($this->members[$index]);
            $this->members [] = ['email' => '', 'role' => ''];
        } else {
            unset($this->members[$index]);
        }
    }


    public function sendInvites(AppsUsersRepository $appsUsersRep)
    {
        $short = new ShortUuid();
        $decodedAppId = $short->decode($this->appId);
        $this->validate([
            'members.*.email' => ['required', 'email', new IsMemberAlreadyAppUser($decodedAppId)],
            'members.*.role' => 'required|in:support,admin,operation,developper',
        ]);

        $appsUsersRep->registerInvitedMembers($this->members, $decodedAppId);

        # todo: send email to users

        session()->flash('success', trans('apps.apps-users.create.success'));

        return redirect()->to(route('dashboard.apps.users.index', ['appId' => $this->appId]));
    }


    public function render()
    {
        return view('apps-users.apps-users-create')
            ->extends('layouts.no-modal')
            ->section('body');
    }
}
