<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperNerSentence
 */
class NerSentence extends Model
{
    use HasFactory;

    protected $guarded = [];
}
