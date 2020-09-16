<?php

namespace App\Utils;
use App\Models\AppUser;
use App\Exceptions\UserAccessLevelException;


class FreshAppUser
{
    /**
     * Get fresh user app for checking permissions
     */
    public static function user($userId, $appId)
    {
        $appUser = AppUser::where(['app_id' => $appId, 'user_id' => $userId ])->first();
        
        if(!$appUser) { throw new UserAccessLevelException(trans('acl.exception.cannot-get-app-user')); }
        return $appUser->fresh();
    }

}
