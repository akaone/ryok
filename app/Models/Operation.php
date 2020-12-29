<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOperation
 */
class Operation extends Model
{
    public static $CREATED = "CREATED";
    public static $PENDING = "PENDING";
    public static $PAID = "PAID";
    public static $FAILED = "FAILED";
    public static $EXPIRED = "EXPIRED";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];


}
