<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @mixin IdeHelperCountry
 */
class Country extends Model
{
    use Sushi;

    protected $rows = [
        ['code' => 'TG', 'code3' => 'TGO', 'name' => 'Togo', 'number' => '768', 'calling_code' => 228],
        ['code' => 'BJ', 'code3' => 'BEN', 'name' => 'Benin', 'number' => '204', 'calling_code' => 229],
        ['code' => 'GH', 'code3' => 'GHA', 'name' => 'Ghana', 'number' => '288', 'calling_code' => 233],
        ['code' => 'CI', 'code3' => 'CIV', 'name' => 'Côte d\'Ivoire', 'number' => '384', 'calling_code' => 225],
    ];
}
