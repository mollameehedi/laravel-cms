<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\Country;
use App\Models\Offer;
use App\Models\Report;
use App\Models\User;
use App\Models\CoustomCap;
use App\Models\CoustomPayout;
use App\Models\CostomCountryPayout;
use App\Models\CountryPayout;

class RedirectController extends Controller
{
    public function redirect(Request $request)
    {
        //core variable
        $offer_id = $request->get('offer_id');
        $offer_id = abs((int)filter_var($offer_id, FILTER_SANITIZE_NUMBER_INT));
        $aff_id = $request->get('aff_id');
        $aff_id = abs((int)filter_var($aff_id, FILTER_SANITIZE_NUMBER_INT));
        $aff_sub_1 = $request->get('aff_sub_1');
        $aff_sub_2 = $request->get('aff_sub_2');
        $aff_sub_3 = $request->get('aff_sub_3');
        $aff_click_id = $request->get('aff_click_id');
        $agent = new Agent();
        $click_id = Str::random(32);
        $source = request()->headers->get('referer');
        $ip = request()->ip();
        if (env('APP_ENV') == 'local') {
            $ip = '76.118.227.8';
        }
        $response = json_decode(file_get_contents(env('LOCATION_API_URL') . $ip . env('LOCATION_API_KEY')));
        $country = $response->country;
        $country_id = Country::where('name', $country)->first()->id;
        $offer = Offer::find($offer_id);
        $user = User::find($aff_id);

        $unique = 0;
        if (!Report::where('user_id', $aff_id)->where('offer_id', $offer_id)->where('ip_address', $ip)->where('date', Carbon::now()->toDateString())->exists()) {
            $unique = 1;
        }

        // check exist or not
        if (!$offer || !$user) {
            abort(404);
        }

        // check offer block
        if ($offer->blocked()->where('user_id', $aff_id)->exists()) {
            if ($offer->alt_offer_id) {
                $offer_id = $offer->alt_offer_id;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Offer blocked'
                ], 404);
            }
        }

        // check offer expired
        if ($offer->expiration_date < now()->toDateString()) {
            if ($offer->alt_offer_id) {
                $offer_id = $offer->alt_offer_id;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Offer expired'
                ], 404);
            }
        }

        // check offer request Approved
        if ($offer->status == 'RequestApproved') {
            if (!$offer->applications()->where('user_id', $aff_id)->where('status', 'approved')->exists()) {
                if ($offer->alt_offer_id) {
                    $offer_id = $offer->alt_offer_id;
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Offer not approved'
                    ], 404);
                }
            }
        }

        // Offer Cap limit check
        $offer_cap_count = Report::where('offer_id', $offer_id)->where('user_id', $aff_id)->where('status', 'approved')->count();
        $costom_cap = CoustomCap::where('offer_id', $offer_id)->where('user_id', $aff_id)->first();
        if ($costom_cap) {
            if ($offer_cap_count >= $costom_cap->count) {
                if ($offer->alt_offer_id) {
                    $offer_id = $offer->alt_offer_id;
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Offer cap limit'
                    ], 404);
                }
            }
        } else {
            if ($offer_cap_count >= $offer->daily_cap) {
                if ($offer->alt_offer_id) {
                    $offer_id = $offer->alt_offer_id;
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Offer cap limit'
                    ], 404);
                }
            }
        }
        // Allow Country Check
        if (!$offer->countries->isEmpty()) {
            if (!$offer->countries->contains($country_id)) {

                if ($offer->alt_offer_id) {
                    $offer_id = $offer->alt_offer_id;
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Offer not allow country'
                    ], 404);
                }
            }
        }

        $revenue = $offer->revenue;
        $payout = $offer->payout;
        // Check Costom Payout
        $coustom_payout = CoustomPayout::where('offer_id', $offer_id)->where('user_id', $aff_id)->first();
        if ($coustom_payout) {
            $revenue = $coustom_payout->revenue;
            $payout = $coustom_payout->payout;
        }

        //costom country payout
        $coustom_country_payout = CostomCountryPayout::where('offer_id', $offer_id)->where('user_id', $aff_id)->where('country_id', $country_id)->first();
        $country_payout = CountryPayout::where('offer_id', $offer_id)->where('country_id', $country_id)->first();
        if ($coustom_country_payout) {
            $revenue = $coustom_country_payout->revenue;
            $payout = $coustom_country_payout->payout;
        } elseif ($country_payout) {
            $revenue = $country_payout->revenue;
            $payout = $country_payout->payout;
        }


        // Store Data
        $url = $offer->url;
        $link_generate = str_replace(
            array("{click_id}", "{aff_id}", "{aff_sub_1}", "{aff_sub_2}", "{aff_sub_3}"),
            array($click_id, $aff_id, $aff_sub_1, $aff_sub_2, $aff_sub_3),
            $url
        );
        Report::create([
            'offer_id' => $offer_id,
            'user_id' => $aff_id,
            'country_id' => $country_id,
            'unique' => $unique,
            'source' => $source,
            'aff_sub_1' => $aff_sub_1,
            'aff_sub_2' => $aff_sub_2,
            'aff_sub_3' => $aff_sub_3,
            'os_name' => $agent->platform(),
            'browser' => $agent->browser(),
            'browser_version' => $agent->version($agent->browser()),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'os_version' => $agent->version($agent->platform()),
            'device_brand' => $agent->device(),
            'device_model' => $agent->device(),
            'ip_address' => $ip,
            'geo_city' => $response->city,
            'geo_region' => $response->regionName,
            'revenue' => $revenue,
            'payout' => $payout,
            'click_id' => $click_id,
            'aff_click_id' => $aff_click_id,
            'date' => Carbon::now()->toDateString(),
        ]);
        return Redirect($link_generate);
    }
}
