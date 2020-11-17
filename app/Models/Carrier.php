<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCarrier
 */
class Carrier extends Model
{
    use Uuids;
    use HasFactory;


    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
