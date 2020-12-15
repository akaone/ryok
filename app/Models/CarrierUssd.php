<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCarrierUssd
 */
class CarrierUssd extends Model
{
    use Uuids;
    use HasFactory;

    public static $ACTIVATED = "ACTIVATED";
    public static $DEACTIVATED = "DEACTIVATED";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
