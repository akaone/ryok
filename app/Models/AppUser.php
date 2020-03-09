<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AppUser extends Pivot
{
    use HasRoles;
    use \App\Uuids;

    protected $guard_name = 'web';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $table = "app_users";

}
