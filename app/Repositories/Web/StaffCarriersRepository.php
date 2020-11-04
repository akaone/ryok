<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Carrier;

class StaffCarriersRepository
{
    /**
     *  Get all available carriers on the platform
     */
    public function carriersList()
    {
        return Carrier::all();
    }


}
