<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClient
 */
class Client extends Model
{
    use Uuids;
    use HasFactory;

    public static $STATE_DEACTIVATED = "DEACTIVATED";
    public static $STATE_ACTIVATED = "ACTIVATED";
    public static $STATE_SMS = "SMS";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
