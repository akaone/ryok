<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    use \App\Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
