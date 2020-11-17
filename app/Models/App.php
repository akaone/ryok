<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperApp
 */
class App extends Model
{
    use Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
