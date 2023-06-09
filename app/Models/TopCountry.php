<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopCountry extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
