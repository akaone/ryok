<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use \App\Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
