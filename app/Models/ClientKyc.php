<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientKyc extends Model
{
    use \App\Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
