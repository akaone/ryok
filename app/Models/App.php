<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperApp
 */
class App extends Model
{
    use Uuids;

    public static $DEACTIVATED = "DEACTIVATED";
    public static $ACTIVATED = "ACTIVATED";
    public static $PENDING = "PENDING";
    public static $REJECTED = "REJECTED";
    public static $DELETED = "DELETED";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
