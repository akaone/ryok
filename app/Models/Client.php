<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @mixin IdeHelperClient
 */
class Client extends Authenticatable
{
    use Uuids;
    use HasFactory;

    public static $STATE_DEACTIVATED = "DEACTIVATED";
    public static $STATE_ACTIVATED = "ACTIVATED";
    public static $STATE_SMS = "SMS";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $hidden = [
        'password'
    ];


    public function getPrimaryAccountAttribute($value)
    {
        return $this->accounts()->oldest()->first();
    }


    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

}
