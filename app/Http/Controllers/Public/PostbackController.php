<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Country;
use App\Models\Offer;
use App\Models\User;
use App\Models\LocalPostback;
use App\Models\GlobalPostback;
use App\Models\PostbackLog;
use App\Models\PostbackSendLog;
use App\Models\CoustomPayout;
use Carbon\Carbon;

class PostbackController extends Controller
{
    public function postback(Request $request)
    {
        $click_id = request('click_id');
        $amount = request('amount');
        $client_url = url()->full();
        $user_agent = $request->server('HTTP_USER_AGENT');
        $source = request()->headers->get('referer');
        $ip = request()->ip();
        $status = 'approved';
        if (env('APP_ENV') == 'local') {
            $ip = '76.118.227.8';
        }
        $report = Report::where('click_id', $click_id)->first();
        $response = json_decode(file_get_contents(env('LOCATION_API_URL') . $ip . env('LOCATION_API_KEY')));
        $country = $response->country;
        $country_id = Country::where('name', $country)->first()->id;

        // Store Postback Log
        $postback_log = PostbackLog::create([
            'url' =>  $client_url,
            'ip_address' => $ip,
            'country_id' => $country_id,
            'user_agent' => $user_agent,
            'referrer' => $source,
            'status' => 'error',
            'date' => Carbon::now()->toDateString(),
        ]);
        if (Report::where('click_id', $click_id)->where('status', 'approved')->exists()) {
            $postback_log->update([
                'offer_id' => $report->offer_id,
                'user_id' => $report->user_id,
                'status' => 'Duplicate Conversion',
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Conversion already exist'
            ], 404);
        }
        if (!$report) {
            $postback_log->update(['status' => 'Invalid Click ID']);
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Click ID'
            ], 400);
        }
        $report = Report::where('click_id', $click_id)->first();
        $offer = Offer::find($report->offer_id);
        // Conversion Status Check
        if ($offer->conversion_status == false) {
            $status = 'pending';
        }
        if (Report::where('ip_address', $report->ip_address)->where('date', Carbon::now()->toDateString())->where('status', 'approved')->exists()) {
            $postback_log->update(['status' => 'duplicate ip try conversion']);
            $status = 'duplicate';
        }
        $revenue = $offer->revenue;
        $payout = $offer->payout;
        $profit = $revenue - $payout;

        // Smart link Payout
        if ($offer->type == 'smartlink') {
            $costom_payout = CoustomPayout::where('offer_id', $offer->id)->where('user_id', $report->user_id)->first();
            if ($costom_payout) {
                $payout = $costom_payout->payout;
            }
            $getPayout = ($payout / 100) * $amount;
            $payout = $getPayout;
            $revenue = $amount;
            $profit = $amount - $getPayout;
        }

        // Report Update
        $report->update([
            'status' => $status,
            'revenue' => $revenue,
            'payout' => $payout,
            'profit' => $profit,
        ]);
        // Check Pending Or Not
        if ($status != 'approved') {
            $postback_log->update(['status' => $status]);
            return response()->json([
                'status' => 'success',
                'message' => 'Conversion Success But ' . $status,
            ]);
        }
        // Increment Balance
        $user = User::find($report->user_id);
        $user->increment('balance', $payout);

        //        // Increment Manager Balance
        //        $manager = $user->manager;
        //        if ($manager) {
        //            $managerPayout = $user->manager->commission;
        //            $managerGetPayout = ($managerPayout / 100) * $payout;
        //            $user->manager->increment('balance',$managerGetPayout);
        //        }

        // Increment Refer Commission
        $refer = $user->refer;

        if ($refer) {
            $referPayout = setting('refer_commission');
            $referGetPayout = ($referPayout / 100) * $payout;
            $refer->increment('balance', $referGetPayout);
        }

        // Fire Postback
        $local_postback = LocalPostback::where('offer_id', $report->offer_id)->where('user_id', $report->user_id)->first();
        $postback = GlobalPostback::where('user_id', $report->user_id)->first();
        if ($local_postback) {
            $url = $local_postback->postback_url;
            $fire_link = str_replace(
                array("{aff_click_id}", "{payout}", "{aff_sub_1}", "{aff_sub_2}", "{aff_sub_3}"),
                array($report->aff_click_id, $report->payout, $report->aff_sub_1, $report->aff_sub_2, $report->aff_sub_3),
                $url
            );
            // Store Postback Send Log
            $response = Http::withHeaders(['User-Agent' => env('APP_NAME')])->get($fire_link);
            PostbackSendLog::create([
                'user_id' => $report->user_id,
                'offer_id' => $report->offer_id,
                'url' => $fire_link,
                'amount' => $report->payout,
                'status_code' => $response->status(),
                'response_data' => $response->body(),
            ]);
        } elseif ($postback) {
            $url = $postback->url;
            $fire_link = str_replace(
                array("{aff_click_id}", "{payout}", "{aff_sub_1}", "{aff_sub_2}", "{aff_sub_3}"),
                array($report->aff_click_id, $report->payout, $report->aff_sub_1, $report->aff_sub_2, $report->aff_sub_3),
                $url
            );
            // Store Postback Send Log
            $response = Http::withHeaders(['User-Agent' => env('APP_NAME')])->get($fire_link);
            PostbackSendLog::create([
                'user_id' => $report->user_id,
                'offer_id' => $report->offer_id,
                'url' => $fire_link,
                'amount' => $payout,
                'status_code' => $response->status(),
                'response_data' => $response->body(),
            ]);
        }
        $postback_log->update([
            'status' => true,
            'user_id' => $report->user_id,
            'offer_id' => $report->offer_id,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Conversion Success',
        ]);
    }
}
