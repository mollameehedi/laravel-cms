<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function affTotal($offer_id, $country_id, $date_from, $date_to)
    {
        $query = Report::where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->where('user_id', Auth::id())
            ->when(!empty($offer_id), function ($query) use ($offer_id) {
                return $query->whereIn('offer_id', $offer_id);
            })->when(!empty($country_id), function ($query) use ($country_id) {
                return $query->whereIn('country_id', $country_id);
            });
        $click = $query->count();
        $unique = $query->sum('unique');
        $conversion = $query->where('status', 'approved')->count();
        $payout = $query->where('status', 'approved')->sum('payout');
        return [
            'click' => $click,
            'unique' => $unique,
            'conversion' => $conversion,
            'payout' => $payout,
        ];
    }

    public static function managerTotal($offer_id, $user_id, $country_id, $date_from, $date_to)
    {
        $query = Report::where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->whereIn('user_id', $user_id)
            ->when(!empty($offer_id), function ($query) use ($offer_id) {
                return $query->whereIn('offer_id', $offer_id);
            })->when(!empty($country_id), function ($query) use ($country_id) {
                return $query->whereIn('country_id', $country_id);
            });
        $click = $query->count();
        $unique = $query->sum('unique');
        $conversion = $query->where('status', 'approved')->count();
        $payout = $query->where('status', 'approved')->sum('payout');
        return [
            'click' => $click,
            'unique' => $unique,
            'conversion' => $conversion,
            'payout' => $payout,
        ];
    }

    public static function affDashTotal($date_from, $date_to): array
    {
        $query = Report::where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->where('user_id', Auth::id());
        $click = $query->count();
        $unique = $query->sum('unique');
        $conversion = $query->where('status', 'approved')->count();
        $payout = $query->where('status', 'approved')->sum('payout');
        return [
            'click' => $click,
            'unique' => $unique,
            'conversion' => $conversion,
            'payout' => $payout,
        ];
    }

    public static function adminDashTotal($dash_date_form, $dash_date_to): array
    {
        $query = Report::where('date', '>=', $dash_date_form)
            ->where('date', '<=', $dash_date_to);
        $click = $query->count();
        $unique = $query->sum('unique');
        $conversion = $query->where('status', 'approved')->count();
        $revenue = $query->where('status', 'approved')->sum('revenue');
        $payout = $query->where('status', 'approved')->sum('payout');
        $profit = $query->where('status', 'approved')->sum('profit');
        return [
            'click' => $click,
            'unique' => $unique,
            'conversion' => $conversion,
            'revenue' => $revenue,
            'payout' => $payout,
            'profit' => $profit,
        ];
    }

    public static function managerDashTotal($date_from, $date_to): array
    {
        $user_id = User::where('manager_id', Auth::id())->pluck('id')->toArray();
        $query = Report::where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->whereIn('user_id', $user_id);
        $click = $query->count();
        $unique = $query->sum('unique');
        $conversion = $query->where('status', 'approved')->count();
        $payout = $query->where('status', 'approved')->sum('payout');
        return [
            'click' => $click,
            'unique' => $unique,
            'conversion' => $conversion,
            'payout' => $payout,
        ];
    }

    public static function adminTotal($offer_id, $user_id, $advertiser_id, $country_id, $status, $date_from, $date_to)
    {
        $query = Report::where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->when(!empty($user_id), function ($query) use ($user_id) {
                return $query->whereIn('user_id', $user_id);
            })
            ->when(!empty($advertiser_id), function ($query) use ($advertiser_id) {
                return $query->whereHas('offer', function ($q) use ($advertiser_id) {
                    $q->where('advertiser_id', $advertiser_id);
                });
            })->when(!empty($status), function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when(!empty($offer_id), function ($query) use ($offer_id) {
                return $query->whereIn('offer_id', $offer_id);
            })->when(!empty($country_id), function ($query) use ($country_id) {
                return $query->whereIn('country_id', $country_id);
            });
        $click = $query->count();
        $unique = $query->sum('unique');
        $conversion = $query->where('status', 'approved')->count();
        $revenue = $query->where('status', 'approved')->sum('revenue');
        $payout = $query->where('status', 'approved')->sum('payout');
        $profit = $query->where('status', 'approved')->sum('profit');
        return [
            'click' => $click,
            'unique' => $unique,
            'conversion' => $conversion,
            'revenue' => $revenue,
            'payout' => $payout,
            'profit' => $profit,
        ];
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
