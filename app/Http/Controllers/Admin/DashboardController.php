<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\TopOffer;
use App\Models\TopAffiliate;
use App\Models\TopCountry;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->date_filter)) {
            $parts = explode(' - ', $request->date_filter);
            $date_from = $parts[0];
            $date_to = $parts[1];
            $dash_date_form =  $parts[0];
            $dash_date_to =  $parts[1];
        } else {
            $carbon_date_from = Carbon::now()->subDay(7);
            $date_from = $carbon_date_from->toDateString();
            $carbon_date_to = Carbon::now();
            $date_to = $carbon_date_to->toDateString();
            $dash_date_form =  Carbon::now()->toDateString();
            $dash_date_to =  Carbon::now()->toDateString();
        }
        $period = \Carbon\CarbonPeriod::create($date_from, $date_to);
        $reports = [];
        foreach ($period as $date) {
            $query = Report::where('date', $date->toDateString());
            $click = $query->count();
            $unique = $query->sum('unique');
            $conversion = $query->where('status', 'approved')->count();
            $revenue = $query->sum('revenue');
            $payout = $query->sum('payout');
            $profit = $query->sum('profit');
            $reports[$date->toDateString()] = compact('click', 'unique', 'conversion', 'revenue', 'payout', 'profit');
        }
        $total = Report::adminDashTotal($dash_date_form, $dash_date_to);
        $top_offers = TopOffer::orderBy('click', 'desc')->get();
        $top_affiliates = TopAffiliate::orderBy('click', 'desc')->get();
        $top_countries = TopCountry::orderBy('click', 'desc')->get();
        return view('admin.dashboard.index', compact('reports', 'total', 'top_offers', 'top_affiliates', 'top_countries'));
    }
}
