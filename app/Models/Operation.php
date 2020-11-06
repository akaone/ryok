<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOperation
 */
class Operation extends Model
{
    use \App\Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
