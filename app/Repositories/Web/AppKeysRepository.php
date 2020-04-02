<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class AppKeysRepository
{
    /**
     * Generate the initial app keys for an app
     * @param $appId
     */
    public function generateInitialKeysForApp($appId)
    {
        $isFirstEntry = DB::table('app_keys')
            ->where('app_id', $appId)
            ->first()
        ;
        if(!$isFirstEntry) {
            DB::table('app_keys')
                ->insert([
                    'id' => Uuid::generate()->string,
                    'app_id' => $appId,
                    'secret_key' => 'sk-' . Uuid::generate()->string,
                    'public_key' => 'pk-' . Uuid::generate()->string,
                    'test_secret_key' => 'sk-test-' . Uuid::generate()->string,
                    'test_public_key' => 'pk-test-' . Uuid::generate()->string,
                ])
            ;
        }
    }
}
