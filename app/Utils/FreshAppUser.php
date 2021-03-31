<?php

namespace App\Utils;
use App\Models\AppUser;
use App\Exceptions\UserAccessLevelException;
use PascalDeVink\ShortUuid\ShortUuid;


class FreshAppUser
{
    /**
     * Get fresh user app for checking permissions
     * @param $userId
     * @param $appId
     * @return AppUser|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @throws UserAccessLevelException
     */
    public static function user($userId, $appId)
    {

        $short = new ShortUuid();
        $decodedAppId = $short->decode($appId);

        $appUser = AppUser::where(['app_id' => $decodedAppId, 'user_id' => $userId ])->first();

        if(!$appUser) { throw new UserAccessLevelException(trans('acl.exception.cannot-get-app-user')); }
        return $appUser->fresh();
    }

}
