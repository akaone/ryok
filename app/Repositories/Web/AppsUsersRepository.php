<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Repositories\Web\AppKeysRepository;
use Carbon\Carbon;
use App\Models\AppUser;
use App\Models\User;
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
            ->orderBy('app_users.created_at', 'DESC')
            ->get()
        ;

        return $users;
    }


    /**
     * Register invitations for users for an app
     * @param $members
     * @param $appId
     */
    public function registerInvitedMembers($members, $appId)
    {
        foreach ($members as $key => $value) {
            $member = User::firstOrCreate(
                ['email' => $value['email']],
                [
                    'state' => 'INVITED',
                    'name' => $value['email'],
                    'email_link' => Uuid::generate()->string,
                    'password' => bcrypt(Uuid::generate()->string)
                ]
            );

            $appUser = AppUser::create([
                'user_id' => $member->id,
                'app_id' => $appId,
                'state' => 'ACTIVATED',
            ]);

            $appUser->assignRole($value['role']);
        }
    }


    /**
     * Tell if the providede email is already saved as an
     * app_user
     * @param $memberEmail
     * @param $appId
     */
    public function isMemberAlreadyAppUser($memberEmail, $appId)
    {
        $count = AppUser::join('users', 'users.id', '=', 'app_users.user_id')
            ->where(['app_id' => $appId, 'users.email' => $memberEmail])->count();

        return $count <= 0 ? false : true;
    }
}
