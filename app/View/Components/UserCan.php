<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use App\Models\AppUser;
use App\Utils\FreshAppUser;

class UserCan extends Component
{
    private $acl;
    private $appId;
    private $enabled = false;


    /**
     * Create a new component instance.
     *
     * @param $acl
     * @param $id
     * @throws \App\Exceptions\UserAccessLevelException
     */
    public function __construct($acl, $id)
    {
        $user = auth()->user();
        $this->acl = $acl;
        $this->appId = $id;

        $appUser = FreshAppUser::user($user->id, $this->appId);
        $this->enabled = $appUser->hasPermissionTo($this->acl);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if($this->enabled) {
            return <<<'blade'
                {{ $slot }}
            blade;
        }
        return null;
    }
}
