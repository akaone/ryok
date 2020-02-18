<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class AppUser extends Model
{
    use HasRoles;
    use \App\Uuids;

    protected $guard_name = 'web';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

}
