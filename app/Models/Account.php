<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAccount
 */
class Account extends Model
{
    use HasFactory;

    public static $ACCOUNT_TYPE_APP = "APP";
    public static $ACCOUNT_TYPE_RYOK = "RYOK";
    public static $ACCOUNT_TYPE_CLIENT = "CLIENT";
    public static $ACCOUNT_TYPE_LOYALTIES = "LOYALTIES";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
