<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Account primaryAccount
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


    public function getPrimaryAccountAttribute($value)
    {
        return $this->accounts()->oldest()->first();
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
