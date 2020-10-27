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
    public function appUsersList($appId, $currentUserId)
    {
        $users = DB::table('app_users')
            ->join('users', 'users.id', '=', 'app_users.user_id')
            ->join('model_has_roles as mhr', 'mhr.model_id', '=', 'app_users.id')
            ->join('roles', 'mhr.role_id', '=', 'roles.id')
            ->where(['app_users.app_id' => $appId])
            ->where('users.id', '!=', $currentUserId)
            ->select('app_users.state as apps_users_state', 'roles.name as role_name',
                'app_users.created_at as apps_users_created_at', 'users.name', 'users.email', 'users.state', 'app_users.id as app_users_id')
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
     * Tell if the provided email is already saved as an
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

    /**
     * Get the details of an app_users given his id
     */
    public function appUserDetails($appUserId)
    {
        $appUser = DB::table('users as u')
            ->join('app_users as au', 'au.user_id', '=', 'u.id')
            ->where('au.id', $appUserId)
            ->select('u.name', 'u.email', 'au.state', 'au.created_at', 'u.id')
            ->first()
        ;

        return $appUser;
    }


    /**
     * Retreive the role of an app_user
     */
    public function appUserRole($appUserId)
    {
        $appUser = AppUser::find($appUserId);
        return $appUser->getRoleNames()[0];
    }


    public function updateAppUserRole($appUserId, $role)
    {
        $appUser = AppUser::find($appUserId);

        $oldRoles = $appUser->getRoleNames();
        $oldRoles->each(function($item, $key) use ($appUser) {
            $appUser->removeRole($item);
        });

        $appUser->assignRole($role);
    }

}
