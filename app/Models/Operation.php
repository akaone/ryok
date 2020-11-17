<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOperation
 */
class Operation extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
