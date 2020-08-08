<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Repositories\Web\AppKeysRepository;

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
     * Store a app creation request made buy a user
     * @param $data
     * @param $image
     * @param $userId
     * @return string appUuid
     */
    public function storePendingApp($data, $image, $userId)
    {

        $file = null;
        if($image) {
            $file = $image->store('images');
        }
        $appUuid = Uuid::generate()->string;
        $appendData = $data;
        $appendData['id'] = $appUuid;
        $appendData['state'] = 'PENDING';
        $appendData['icon'] = $file;

        $app = DB::table('apps')
            ->insert($appendData)
        ;

        $appAdminUser = DB::table('app_users')
            ->insert([
                'id' => Uuid::generate()->string,
                'app_id' => $appUuid,
                'user_id' => $userId,
            ])
        ;

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
