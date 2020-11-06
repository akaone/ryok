<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAppCarrier
 */
class AppCarrier extends Model
{
    use HasFactory;
    
    protected $guarded = [];
}
