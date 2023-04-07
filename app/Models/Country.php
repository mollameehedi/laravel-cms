<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_country', 'country_id', 'offer_id')->withPivot('id');
    }

    public function costomCountryPayouts()
    {
        return $this->hasMany(CostomCountryPayout::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function countryPayout()
    {
        return $this->hasMany(CountryPayout::class);
    }

    public function postbackLogs()
    {
        return $this->hasMany(PostbackLog::class);
    }
    public function topCountries()
    {
        return $this->hasMany(TopCountry::class);
    }
}
