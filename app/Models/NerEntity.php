<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperNerEntity
 */
class NerEntity extends Model
{
    use HasFactory;

    public static $CURRENCY = "CURRENCY";
    public static $AMOUNT = "AMOUNT";
    public static $REFERENCE = "REFERENCE";

    protected $guarded = [];
}
