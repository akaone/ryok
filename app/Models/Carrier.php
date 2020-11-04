<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
