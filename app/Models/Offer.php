<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];

    public static function filterAff($status, $name, $category_id, $country_id)
    {
        return Offer::when(!empty($status), function ($query) use ($status) {
            return $query->whereIn('status', $status);
        })->when(!empty($name), function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%')->orWhere('id', $name);
        })
            ->when(!empty($category_id), function ($query) use ($category_id) {
                return $query->whereIn('category_id', $category_id);
            })
            ->when(!empty($country_id), function ($query) use ($country_id) {
                return $query->whereHas('countries', function ($q) use ($country_id) {
                    $q->whereIn('country_id', $country_id);
                });
            });
    }
    public static function filterAffLive($get_offer_id, $status, $name, $category_id, $country_id)
    {
        return Offer::when(!empty($get_offer_id), function ($query) use ($get_offer_id) {
            return $query->whereIn('id', $get_offer_id);
        })->when(!empty($status), function ($query) use ($status) {
            return $query->whereIn('status', $status);
        })->when(!empty($name), function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%')->orWhere('id', $name);
        })
            ->when(!empty($category_id), function ($query) use ($category_id) {
                return $query->whereIn('category_id', $category_id);
            })
            ->when(!empty($country_id), function ($query) use ($country_id) {
                return $query->whereHas('countries', function ($q) use ($country_id) {
                    $q->whereIn('country_id', $country_id);
                });
            });
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'offer_country', 'offer_id', 'country_id')->withPivot('revenue', 'payout', 'id');
    }

    public function coustomPayouts()
    {
        return $this->hasMany(CoustomPayout::class);
    }

    public function costomCountryPayouts()
    {
        return $this->hasMany(CostomCountryPayout::class);
    }

    public function coustomCaps()
    {
        return $this->hasMany(CoustomCap::class);
    }

    public function ratio()
    {
        return $this->hasOne(Ratio::class);
    }

    public function costomRatios()
    {
        return $this->hasMany(CostomRatio::class);
    }

    public function blocked()
    {
        return $this->hasMany(OfferBlock::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function applications()
    {
        return $this->hasMany(OfferApplication::class);
    }

    public function countryPayouts()
    {
        return $this->hasMany(CountryPayout::class);
    }

    public function postbackLogs()
    {
        return $this->hasMany(PostbackLog::class);
    }

    public function postbackSendLogs()
    {
        return $this->hasMany(PostbackSendLog::class);
    }
    public function localPostbacks()
    {
        return $this->hasMany(LocalPostback::class);
    }

    public function topOffers()
    {
        return $this->hasMany(TopOffer::class);
    }
}
