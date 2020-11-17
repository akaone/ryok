<?php


namespace App\Repositories\Server;


use App\Models\App;
use App\Models\AppKey;
use Illuminate\Support\Facades\DB;

class MerchantApiAuthRepository
{

    /**
     * Auth merchant for api secret
     * @param $secret_key
     * @return array
     */
    public function checkSecretKey($secret_key)
    {
        $exist = false;
        $live = false;
        $app_id = null;

        $app_key_select = AppKey::where(['secret_key' => $secret_key, 'state' => AppKey::$STATE_ACTIVATED])
            ->orWhere(function($query) use ($secret_key){
                $query->where('test_secret_key', $secret_key)
                    ->where('state',  AppKey::$STATE_ACTIVATED);
            })
            ->get();

        if(count($app_key_select) >= 2 || count($app_key_select) <= 0) {
            return [
                'exists' => $exist,
                'live' => $live,
                'app_id' => $app_id,
            ];
        }
        $exist = true;
        $app_key_select = $app_key_select->first();

        if(strpos($secret_key, "-live-")) {
            $live = true;
        }

        $app = App::find($app_key_select->app_id);
        $app_id = $app->id;

        return [
            'exists' => $exist,
            'live' => $live,
            'app_id' => $app_id,
        ];
    }

}
