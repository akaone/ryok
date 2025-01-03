<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCarrierMessage
 */
class CarrierMessage extends Model
{
    use HasFactory;

    public static $TREATED = "TREATED";
    public static $PENDING = "PENDING";

    protected $guarded = [];
}
