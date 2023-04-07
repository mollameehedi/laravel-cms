<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getByName($name, $default = null)
    {
        $setting = self::where('name', $name)->first();
        if (isset($setting)) {
            return $setting->value;
        } else {
            return $default;
        }
    }
}
