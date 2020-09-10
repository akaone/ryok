<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Repositories\Web\AppKeysRepository;
use Carbon\Carbon;
use App\Models\AppUser;
use Illuminate\Support\Facades\Storage;

class AppsUsersRepository
{
    /**
     * List all users of a given app
     * @param $appId
     * @return Collection
     */
    public function appUsersList($appId)
    {
        $users = DB::table('app_users')
            ->join('users', 'users.id', '=', 'app_users.user_id')
            ->join('model_has_roles as mhr', 'mhr.model_id', '=', 'app_users.id')
            ->join('roles', 'mhr.role_id', '=', 'roles.id')
            ->where('app_users.app_id', $appId)
            ->select('app_users.state as apps_users_state', 'roles.name as role_name',
                'app_users.created_at as apps_users_created_at', 'users.name', 'users.email', 'users.state')
            ->get()
        ;

        return $users;
    }
}
