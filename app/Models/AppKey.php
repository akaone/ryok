<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAppKey
 */
class AppKey extends Model
{
    use Uuids;
    use HasFactory;

    public static $STATE_DEACTIVATED = "DEACTIVATED";
    public static $STATE_ACTIVATED = "ACTIVATED";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
