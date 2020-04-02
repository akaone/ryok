<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class AppsStateRepository
{
    /**
     * Edit app state
     * @param $userId
     * @param $appId
     * @param $data
     */
    public function editAppState($userId, $appId, $data)
    {
        DB::table('apps')
            ->where('apps.id', $appId)
            ->update($data)
        ;
    }

}
