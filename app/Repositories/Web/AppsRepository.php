<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Repositories\Web\AppKeysRepository;
use Carbon\Carbon;
use App\Models\AppUser;
use Illuminate\Support\Facades\Storage;

class AppsRepository
{
    /**
     * List all apps for the user
     * @param $userType
     * @param $userId
     * @return Collection
     */
    public function getUserApps($userType, $userId)
    {
        if ($userType == 'staff') {
            $request = DB::table('apps');
        } else {
            $request = DB::table('apps')
                ->join('app_users', 'apps.id', '=', 'app_users.app_id')
                ->where('app_users.user_id', $userId)
                ->where('app_users.state', 'ACTIVATED')
            ;
        }

        $apps = $request
            ->select('apps.*')
            ->get()
        ;

        return $apps;
    }

    /**
     * Get an app
     * @param $appId
     * @return Collection
     */
    public function getApp($appId)
    {
        $app = DB::table('apps')
            ->where('id', $appId)
            ->first()
        ;

        return $app;
    }

    /**
     * Get first created app
     * @param $userId
     * @return Collection
     */
    public function getFirstApp($userId)
    {
        $app = DB::table('apps as a')
            ->join('app_users as au', 'au.app_id', '=', 'a.id')
            ->where('au.user_id', $userId)
            ->orderBy('a.created_at', 'ASC')
            ->select('a.*')
            ->first()
        ;

        return $app;
    }

    /**
     * Store a app creation request made buy a user
     * @param $data
     * @param $image
     * @param $userId
     * @return string appUuid
     */
    public function storePendingApp($data, $image, $cfeRecto, $cfeVerso, $userId)
    {
        $now = Carbon::now();

        $file = null;
        $appendData = $data;
        if($image) {
            $file = $image->store('apps', 'global_albums');
            $appendData['icon'] = Storage::disk('global_albums')->url($file);
        }
        $fileCfeRecto = $cfeRecto->store('apps', 'global_albums');
        $appendData['cfe_recto'] = Storage::disk('global_albums')->url($fileCfeRecto);

        $fileCfeVerso = $cfeVerso->store('apps', 'global_albums');
        $appendData['cfe_verso'] = Storage::disk('global_albums')->url($fileCfeVerso);
        
        $appUuid = Uuid::generate()->string;
        $appendData['id'] = $appUuid;
        $appendData['state'] = 'PENDING';
        $appendData['created_at'] = $now;
        $appendData['updated_at'] = $now;

        $app = DB::table('apps')
            ->insert($appendData)
        ;

        $appAdminUser = DB::table('app_users')
            ->insert([
                'id' => Uuid::generate()->string,
                'app_id' => $appUuid,
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ])
        ;

        $appAdminUser = AppUser::where([ 'app_id' => $appUuid, 'user_id' => $userId ])->first();
        $appAdminUser->assignRole('admin');

        $appKeyRepository = new AppKeysRepository();
        $appKeyRepository->generateInitialKeysForApp($appUuid);

        return $appUuid;
    }

    /**
     * Create a marchand account for the app
     * @param $appUuid
     */
    public function createAccountForApp($appUuid)
    {
        DB::table('accounts')
            ->insert([
                'id' => Uuid::generate()->string,
                'app_id' => $appUuid,
                'type'=> 'APP'
            ])
        ;
    }
}
