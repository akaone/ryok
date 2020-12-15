<?php

namespace App\Repositories\Web;

use App\Models\App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Repositories\Web\AppKeysRepository;
use Carbon\Carbon;
use App\Models\AppUser;
use App\Models\Carrier;
use App\Models\AppCarrier;
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
            $request = DB::table('apps')
                ->select('apps.*')
            ;
        } else {
            $request = DB::table('apps')
                ->join('app_users', 'apps.id', '=', 'app_users.app_id')
                ->where('app_users.user_id', $userId)
                ->where('app_users.state', 'ACTIVATED')
                ->select('apps.id', 'apps.name', 'apps.state')
            ;
        }

        $apps = $request ->get();

        return $apps;
    }


    /**
     * Get an app
     * @param $appId
     * @return App|Builder|Model|Collection|object
     */
    public function getApp($appId)
    {
        return App::where('id', $appId)->first();
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


    /**
     * activate, reject or deactivate an app
     * @param $appId
     * @param $action 'PENDING' | 'ACTIVATED' | 'DEACTIVATED' | 'REJECTED' | 'DELETED'
     */
    public function validationAction($appId, $action)
    {
        $now = Carbon::now();
        DB::table('apps')
            ->where('id', $appId)
            ->update([
                'state' => $action,
                'updated_at' => $now,
            ])
        ;
    }


    /**
     * Link carriers to app
     */
    public function linkInitialCarriers($appId, $pickedCarriers)
    {
        $now = Carbon::now();
        foreach ($pickedCarriers as $key => $value) {
            $carrier = Carrier::whereIbm($value)->select('id')->first();
            AppCarrier::updateOrCreate(
                ['app_id' => $appId, 'carrier_id' => $carrier->id],
                [
                    'activated' => true,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
