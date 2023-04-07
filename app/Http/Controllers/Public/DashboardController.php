<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Report;
use App\Models\Country;
use App\Models\TopOffer;
use App\Models\TopAffiliate;
use App\Models\TopCountry;

class DashboardController extends Controller
{
    public function topCronJobs()
    {
        $carbon_date_from = Carbon::now();
        $date_from = $carbon_date_from->toDateString();
        $carbon_date_to = Carbon::now();
        $date_to = $carbon_date_to->toDateString();



        // Delete old top offers
        TopOffer::truncate();
        // Insert new top offers
        $top_offers =  Offer::withCount([
            'reports' => function ($query) {
                $query->where('date', Carbon::now()->toDateString());
            }
        ])
            ->with(['reports' => function ($query) {
                $query->where('date', Carbon::now()->toDateString())->where('status', 'approved');
            }])
            ->take(10)
            ->get();
        foreach ($top_offers as $top_offer) {
            if ($top_offer->reports_count > 0) {
                TopOffer::create([
                    'offer_id' => $top_offer->id,
                    'click' => $top_offer->reports_count,
                    'conversion' => $top_offer->reports->where('status', 'approved')->count(),
                    'revenue' => $top_offer->reports->where('status', 'approved')->sum('revenue'),
                    'payout' => $top_offer->reports->where('status', 'approved')->sum('payout'),
                    'profit' => $top_offer->reports->where('status', 'approved')->sum('profit'),
                ]);
            }
        }

        // Delete old top countries
        TopCountry::truncate();
        // Insert new top countries
        $top_countries = Country::withCount([
            'reports' => function ($query) {
                $query->where('date', Carbon::now()->toDateString());
            }
        ])
            ->with(['reports' => function ($query) {
                $query->where('date', Carbon::now()->toDateString())->where('status', 'approved');
            }])
            ->orderByDesc("reports_count")
            ->take(10)
            ->get();
        foreach ($top_countries as $top_country) {
            if ($top_country->reports_count > 0) {
                TopCountry::create([
                    'country_id' => $top_country->id,
                    'click' => $top_country->reports_count,
                    'conversion' => $top_country->reports->where('status', 'approved')->count(),
                    'revenue' => $top_country->reports->where('status', 'approved')->sum('revenue'),
                    'payout' => $top_country->reports->where('status', 'approved')->sum('payout'),
                    'profit' => $top_country->reports->where('status', 'approved')->sum('profit'),
                ]);
            }
        }


        // Delete old top users
        TopAffiliate::truncate();
        // Insert new top users
        $top_users =  User::withCount([
            'reports' => function ($query) {
                $query->where('date', Carbon::now()->toDateString());
            }
        ])
            ->with(['reports' => function ($query) {
                $query->where('date', Carbon::now()->toDateString())->where('status', 'approved');
            }])
            ->orderByDesc("reports_count")
            ->take(10)
            ->get();
        foreach ($top_users as $top_user) {
            if ($top_user->reports_count > 0) {
                TopAffiliate::create([
                    'user_id' => $top_user->id,
                    'click' => $top_user->reports_count,
                    'conversion' => $top_user->reports->where('status', 'approved')->count(),
                    'revenue' => $top_user->reports->where('status', 'approved')->sum('revenue'),
                    'payout' => $top_user->reports->where('status', 'approved')->sum('payout'),
                    'profit' => $top_user->reports->where('status', 'approved')->sum('profit'),
                ]);
            }
        }

        return response()->json(['success' => true], 200);
    }
}
