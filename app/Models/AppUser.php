<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperAppUser
 */
class AppUser extends Pivot
{
    use Uuids;
    use HasRoles;
    use HasFactory;

    protected $guard_name = 'web';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $table = "app_users";

}
