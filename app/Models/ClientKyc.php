<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClientKyc
 */
class ClientKyc extends Model
{
    use \App\Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
