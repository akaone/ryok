<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\App;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use \App\Uuids;
    
    protected $guard_name = 'web';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
