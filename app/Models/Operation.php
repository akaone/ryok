<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOperation
 */
class Operation extends Model
{
    use HasFactory;
    use Uuids;

    public static $CREATED = "CREATED";
    public static $PENDING = "PENDING";
    public static $PAID = "PAID";
    public static $FAILED = "FAILED";
    public static $EXPIRED = "EXPIRED";
    public static $SCAN = "SCAN";

    const FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT = "FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT";
    const FROM_CLIENT_ACCOUNT_TO_MOBILE_MONEY = "FROM_CLIENT_ACCOUNT_TO_MOBILE_MONEY";
    const FROM_CLIENT_ACCOUNT_TO_APP_ACCOUNT = "FROM_CLIENT_ACCOUNT_TO_APP_ACCOUNT";

    const FROM_APP_ACCOUNT_TO_MOBILE_MONEY = "FROM_APP_ACCOUNT_TO_MOBILE_MONEY";
    const FROM_APP_ACCOUNT_TO_RYOK_ACCOUNT = "FROM_APP_ACCOUNT_TO_RYOK_ACCOUNT";
    const FROM_APP_ACCOUNT_TO_CLIENT_ACCOUNT = "FROM_APP_ACCOUNT_TO_CLIENT_ACCOUNT";

    const FROM_RYOK_ACCOUNT_TO_CLIENT_ACCOUNT = "FROM_RYOK_ACCOUNT_TO_CLIENT_ACCOUNT";
    const FROM_RYOK_ACCOUNT_TO_MOBILE_MONEY = "FROM_RYOK_ACCOUNT_TO_MOBILE_MONEY";

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $guarded = [];


}
