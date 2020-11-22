<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Utils\FreshAppUser;
use App\Repositories\Web\AppsUsersRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

class LivewireAppsUsersShow extends Component
{

    public $appId;
    public $userId;
    private $freshUser;

    public $newRole;

    public function updateUserRole(AppsUsersRepository $appUsersRep)
    {
        $this->validate([
            'newRole' => 'required|in:support,admin,operation,developper',
        ]);

        $short = new ShortUuid();
        # todo: check if user is allowed to update user role
        $role = $appUsersRep->appUserRole($short->decode($this->userId));
        if($role == 'admin') {
            session()->flash('error', trans('apps.apps-users.show.cannot-change-admin-role'));
            return;
        }

        $appUsersRep->updateAppUserRole($short->decode($this->userId), $this->newRole);

        session()->flash('success', trans('apps.apps-users.show.change-role-success'));
    }


    public function mount()
    {

    }

    public function render()
    {
        $this->freshUser = FreshAppUser::user(auth()->user()->id, $this->appId);
        $appUsersRep = new AppsUsersRepository();

        $short = new ShortUuid();
        $appUser = $appUsersRep->appUserDetails($short->decode($this->userId));

        $role = $appUsersRep->appUserRole($short->decode($this->userId));

        return view('livewire.livewire-apps-users-show', [
            'appUser' => $appUser,
            'role' => $role,
        ]);
    }
}
