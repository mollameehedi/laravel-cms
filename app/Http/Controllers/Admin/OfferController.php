<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Offer\CountryPayoutRequest;
use App\Http\Requests\Admin\Offer\CreateOfferRequest;
use App\Http\Requests\Admin\Offer\CustomPayoutRequest;
use App\Http\Requests\Admin\Offer\UpdateOfferRequest;
use App\Models\Cap;
use App\Models\Category;
use App\Models\Country;
use App\Models\CountryPayout;
use App\Models\CustomPayout;
use App\Models\Device;
use App\Models\Domain;
use App\Models\Offer;
use App\Models\OfferPermission;
use App\Models\Optimize;
use App\Models\Advertiser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\Datatables\Datatables;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Offer::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ('<div class="d-flex justify-content-evenly">
                    <a class="btn btn-info btn-icon btn-sm rounded-pill" href="' . route('admin.offer.show', $row->id) . '." role="button">
                        <span class="btn-inner">
                       
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="32" viewBox="0 0 24 24" fill="none">
                        <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></path>
                        <path d="M12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17Z" stroke="currentColor"></path>
                        <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="currentColor"></path>
                        <mask id="mask0_18_1031" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">
                        <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="currentColor"></path>
                        </mask>
                        <g mask="url(#mask0_18_1031)">
                        <path opacity="0.53" d="M13.5 12C14.3284 12 15 11.3284 15 10.5C15 9.67157 14.3284 9 13.5 9C12.6716 9 12 9.67157 12 10.5C12 11.3284 12.6716 12 13.5 12Z" fill="white"></path>
                        </g>
                        </svg>

                    
                    
                        </span>
                    </a>
                    <a class="btn btn-primary btn-icon btn-sm rounded-pill ms-2" href="' . route('admin.offer.edit', $row->id) . '" role="button">
                        <span class="btn-inner">
                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M19.9927 18.9534H14.2984C13.7429 18.9534 13.291 19.4124 13.291 19.9767C13.291 20.5422 13.7429 21.0001 14.2984 21.0001H19.9927C20.5483 21.0001 21.0001 20.5422 21.0001 19.9767C21.0001 19.4124 20.5483 18.9534 19.9927 18.9534Z" fill="currentColor"></path>
                                <path d="M10.309 6.90385L15.7049 11.2639C15.835 11.3682 15.8573 11.5596 15.7557 11.6929L9.35874 20.0282C8.95662 20.5431 8.36402 20.8344 7.72908 20.8452L4.23696 20.8882C4.05071 20.8903 3.88775 20.7613 3.84542 20.5764L3.05175 17.1258C2.91419 16.4915 3.05175 15.8358 3.45388 15.3306L9.88256 6.95545C9.98627 6.82108 10.1778 6.79743 10.309 6.90385Z" fill="currentColor"></path>
                                <path opacity="0.4" d="M18.1208 8.66544L17.0806 9.96401C16.9758 10.0962 16.7874 10.1177 16.6573 10.0124C15.3927 8.98901 12.1545 6.36285 11.2561 5.63509C11.1249 5.52759 11.1069 5.33625 11.2127 5.20295L12.2159 3.95706C13.126 2.78534 14.7133 2.67784 15.9938 3.69906L17.4647 4.87078C18.0679 5.34377 18.47 5.96726 18.6076 6.62299C18.7663 7.3443 18.597 8.0527 18.1208 8.66544Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </a>
                    <a class="btn btn-danger btn-icon btn-sm rounded-pill ms-2" href="' . route('admin.offer.destroy', $row->id) . '" role="button">
                        <span class="btn-inner">
                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </a>
                </div>');
                    return $actionBtn;
                })
                ->addColumn('photo', function ($row) {
                    $photo = (' <div class="d-flex align-items-center">
                    <img class="rounded img-fluid avatar-60 me-3" src="' . $row->getFirstMediaUrl('photo') . '" alt="" loading="lazy" />
                    <div class="media-support-info">
                    <p class="mb-0">' . $row->name . '</p>
                    </div>
                </div>');
                    return $photo;
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }
        return view('admin.offer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $data['countries'] = Country::all();
        $data['alt_offers'] = Offer::where('type', 'smartlink')->get();
        $data['advertisers'] = Advertiser::all();
        $data['categories'] = Category::all();
        return view('admin.offer.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
    {

        $offer = Offer::create([
            'category_id' => $request->category_id,
            'advertiser_id' => $request->advertiser_id,
            'name' => $request->name,
            'description' => $request->description,
            'preview' => $request->preview,
            'url' => $request->url,
            'revenue' => $request->revenue,
            'payout' => $request->payout,
            'daily_cap' => $request->daily_cap,
            'expiration_date' => $request->expiration_date,
            'type' => $request->type,
            'status' => $request->status,
            'conversion_status' => $request->conversion_status,
            'alt_offer_id' => $request->alt_offer_id,
        ]);
        if ($request->hasFile('photo')) {
            $offer->addMedia($request->photo)->toMediaCollection('photo');
        }
        $offer->countries()->sync($request->country_id);
        Toastr::success('Offer Created Successfully!!', 'Success', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin.offer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['offer'] = Offer::findOrFail($id);
        $data['affiliates'] = User::where('role', 'Affiliate')
            ->where('status', 'Approved')->get();
        return view('admin.offer.show')->with($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertisers = User::where('role', 'Advertiser')->get();
        $categories = Category::all();
        $countries = Country::all();
        $devices = Device::all();
        $alt_offers = Offer::where('payout_type', 'RevenueShare')->get();
        $offer = Offer::find($id);
        return view('admin.offer.form', compact('advertisers', 'categories', 'countries', 'devices', 'alt_offers', 'offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $country_id = $request->country_id;
        $device_id = $request->device_id;

        $request->request->remove('country_id');
        $request->request->remove('device_id');

        $offer->update($request->all());
        $offer->countries()->sync($country_id);
        $offer->devices()->sync($device_id);
        return redirect()->route('admin.offer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->countries()->detach();
        $offer->delete();
        return redirect()->route('admin.offer.index');
    }

    public function bulkAction(Request $request)
    {
        $message = '';
        if ($request->action == "Approved") {
            $offers = Offer::findMany($request->ids);
            $offers->each(function ($offer) {
                $offer->status = "Approved";
                $offer->save();
            });
            $message = "Offer Approved Successfully";
        }
        if ($request->action == "Pending") {
            $offers = Offer::findMany($request->ids);
            $offers->each(function ($offer) {
                $offer->status = "Pending";
                $offer->save();
            });
            $message = "Offer Pending Successfully";
        }

        if ($request->action == "RequestApproved") {
            $offers = Offer::findMany($request->ids);
            $offers->each(function ($offer) {
                $offer->status = "RequestApproved";
                $offer->save();
            });
            $message = "Offer Request Approved Successfully";
        }
        if ($request->action == "Delete") {
            $offers = Offer::findMany($request->ids);
            $offers->each(function ($offer) {
                $offer->delete();
            });
            $message = "Offer Deleted Successfully";
        }
        return response([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    public function payout(Offer $offer)
    {
        $countries = Country::all();
        $countryPayouts = $offer->countryPayouts;
        $affiliates = User::where('role', 'Affiliate')->get();
        return view('admin.offer.payout', compact('offer', 'countries', 'countryPayouts', 'affiliates'));
    }

    public function countryPayoutStore(CountryPayoutRequest $request, Offer $offer)
    {
        $countries = Country::findMany($request->country_id);
        $countries->each(function ($country) use ($request, $offer) {
            CountryPayout::updateOrCreate([
                'offer_id' => $offer->id,
                'country_id' => $country->id,
                'payout_type' => $request->payout_type,
                'revenue' => $request->revenue,
                'payout' => $request->payout,
            ]);
        });
        return back();
    }

    public function countryPayoutDelete(CountryPayout $payout)
    {
        $payout->delete();
        return back();
    }

    public function customPayoutStore(CustomPayoutRequest $request, Offer $offer)
    {
        $affiliates = User::findMany($request->affiliate_id);
        $affiliates->each(function ($affiliate) use ($request, $offer) {
            CustomPayout::updateOrCreate([
                'offer_id' => $offer->id,
                'affiliate_id' => $affiliate->id,
                'revenue' => $request->revenue,
                'payout' => $request->payout,
            ]);
        });
        return back();
    }

    public function customPayoutStoreDelete($id)
    {
        $customPayout = CustomPayout::findOrFail($id);
        $customPayout->delete();
        return back();
    }

    public function permission(Request $request, Offer $offer)
    {
        $affiliates = User::where('role', 'Affiliate')->get();
        $notApprovedAffiliates = User::where('role', 'Affiliate')
            ->whereDoesntHave('offerPermissions', static function ($query) use ($offer) {
                $query->where('offer_id', $offer->id);
            })->get();
        $approvedAffiliates = User::where('role', 'Affiliate')
            ->whereHas('offerPermissions', static function ($query) use ($offer) {
                $query->where('offer_id', $offer->id)->where('status', 'Approved');
            })->get();
        $blockedAffiliates = User::where('role', 'Affiliate')
            ->whereHas('offerPermissions', static function ($query) use ($offer) {
                $query->where('offer_id', $offer->id)->where('status', 'Blocked');
            })->get();
        $domains = Domain::all();
        return view('admin.offer.permission', compact('offer', 'affiliates', 'domains', 'notApprovedAffiliates', 'approvedAffiliates', 'blockedAffiliates'));
    }

    public function approved(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        $affiliates = User::findMany($request->affiliate_id);
        $status = $request->status;
        if ($status == "Approved") {
            foreach ($affiliates as $affiliate) {
                $offer->permissions()->updateOrCreate(
                    [
                        'offer_id' => $offer->id,
                        'affiliate_id' => $affiliate->id,
                    ],
                    compact('status')
                );
            }
            $message = "Offer Approved Successfully";
        }
        if ($status == "Blocked") {
            foreach ($affiliates as $affiliate) {
                $offer->permissions()->updateOrCreate(
                    [
                        'offer_id' => $offer->id,
                        'affiliate_id' => $affiliate->id,
                    ],
                    compact('status')
                );
            }
            $message = "Offer Blocked Successfully";
        }
        if ($status == "Delete") {
            foreach ($affiliates as $affiliate) {
                $offer->permissions()->where('offer_id', $offer->id)->where('affiliate_id', $affiliate->id)->delete();
            }
            $message = "Offer Permission Deleted Successfully";
        }
        return response([
            'status' => 'success',
            'message' => $message,
            'affiliates' => $affiliates,
        ]);
    }

    public function advance(Offer $offer)
    {
        $affiliates = User::where('role', 'Affiliate')->get();
        return view('admin.offer.advance', compact('offer', 'affiliates'));
    }

    public function capStore(Request $request, Offer $offer)
    {
        if ($request->affiliate_id) {
            $affiliates = User::findMany($request->affiliate_id);
            $affiliates->each(function ($affiliate) use ($request, $offer) {
                $offer->caps()->updateOrCreate(
                    [
                        'offer_id' => $offer->id,
                        'affiliate_id' => $affiliate->id,
                    ],
                    [
                        'cap' => $request->cap,
                        'cap_type' => $request->cap_type,
                    ]
                );
            });
        } else {
            $offer->caps()->updateOrCreate(
                [
                    'offer_id' => $offer->id,
                    'affiliate_id' => null,
                ],
                [
                    'cap' => $request->cap,
                    'cap_type' => $request->cap_type,
                ]
            );
        }
        return back();
    }

    public function capDelete(Cap $cap)
    {
        $cap->delete();
        return back();
    }
    public function optimizeStore(Request $request, Offer $offer)
    {
        if ($request->affiliate_id) {
            $affiliates = User::findMany($request->affiliate_id);
            $affiliates->each(function ($affiliate) use ($request, $offer) {
                $offer->optimizes()->updateOrCreate(
                    [
                        'offer_id' => $offer->id,
                        'affiliate_id' => $affiliate->id,
                    ],
                    [
                        'optimize' => $request->optimize_value,
                    ]
                );
            });
        } else {
            $offer->optimizes()->updateOrCreate(
                [
                    'offer_id' => $offer->id,
                    'affiliate_id' => null,
                ],
                [
                    'optimize' => $request->optimize_value,
                ]
            );
        }
        return back();
    }

    public function optimizeDelete(Optimize $optimize)
    {
        $optimize->delete();
        return back();
    }
    public function search(Request $request)
    {
        $columns = [
            'id',
            'id',
            'id',
            'name',
            'advertiser',
            'countries',
            'devices',
            'revenue',
            'payout',
            'payout_type',
            'same_ip_click',
            'same_ip_conversion',
            'status',
            'actions',
        ];
        $name = $request->name;
        $country_id = [];
        $device_id = [];
        $category_id = [];
        // json to array
        if ($request->country_id) {
            $country_id = json_decode($request->country_id);
        }
        if ($request->device_id) {
            $device_id = json_decode($request->device_id);
        }
        if ($request->category_id) {
            $category_id = json_decode($request->category_id);
        }


        $totalData = Offer::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $offers = Offer::when(!empty($search), function ($query) use ($search) {
            $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%");
        })
            ->when(!empty($name), function ($query) use ($name) {
                $query->where('name', 'LIKE', "%{$name}%");
            })
            ->when(!empty($country_id), function ($query) use ($country_id) {
                $query->whereHas('countries', static function ($query) use ($country_id) {
                    $query->whereIn('country_id', $country_id);
                });
            })
            ->when(!empty($device_id), function ($query) use ($device_id) {
                $query->whereHas('devices', static function ($query) use ($device_id) {
                    $query->whereIn('device_id', $device_id);
                });
            })->when(!empty($category_id), function ($query) use ($category_id) {
                $query->whereIn('category_id', $category_id);
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalFiltered = Offer::when(!empty($search), static function ($query) use ($search) {
            $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%");
        })->count();
        $data = [];
        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $show = route('admin.offer.show', $offer->id);
                $edit = route('admin.offer.edit', $offer->id);
                $delete = route('admin.offer.destroy', $offer->id);
                $clone = route('admin.offer.clone', $offer->id);

                // status check

                $status_class = "badge badge-success";
                if ($offer->status == "Approved") {
                    $status_class = "badge bg-success";
                } elseif ($offer->status == "Pending") {
                    $status_class = "badge bg-warning";
                } elseif ($offer->status == "Private") {
                    $status_class = "badge bg-info";
                } elseif ($offer->status == "RequestApproved") {
                    $status_class = "badge bg-success";
                }

                $countries = '';
                foreach ($offer->countries as $country) {
                    $country_code = strtolower($country->code);
                    $countries .= '<span class="fi fi-' . $country_code . ' rounded"></span>' . ' ';
                }
                $countries != '' ? $countries : $countries = 'All';
                $devices = '';
                foreach ($offer->devices as $device) {
                    $device_name = strtolower($device->name);
                    $devices .= '<i class="fa fa-' . $device_name . '"></i>' . ' ';
                }
                $devices != '' ? $devices : $devices = 'All';
                $revenue = $offer->payout_type == 'RevenueShare' ? '<span class="badge bg-primary">' . $offer->revenue . ' %' . '</span>' : '<span class="badge bg-success">' . $offer->revenue . '$' . '</span>';
                $payout = $offer->payout_type == 'RevenueShare' ? '<span class="badge bg-primary">' . $offer->payout . ' %' . '</span>' : '<span class="badge bg-success">' . $offer->payout . '$' . '</span>';
                $delete = null;
                $delete .= $offer->id;
                $nestedData['id']           = $offer->id;
                $nestedData['avatar']        = route('admin.offer.show', $offer->id);
                $nestedData['name']          = '<a href="' . $show . '">' . $offer->name . '</a>';
                $nestedData['country']       = $countries;
                $nestedData['device']        = $devices;
                $nestedData['revenue']        = $revenue;
                $nestedData['payout']        = $payout;
                $nestedData['advertiser']     = $offer->advertiser->name ?? 'N/A';
                $nestedData['category']     = $offer->category->name ?? 'N/A';
                $nestedData['created_at']    = $offer->created_at->format('d M Y');
                $nestedData['status']        = " <span class='$status_class'>" . $offer->status . "</span>";
                $nestedData['edit']       = $edit;
                $nestedData['show']          = $show;
                $nestedData['clone']          = $clone;
                $nestedData['delete']            = $offer->id;
                $nestedData['delete_label']      = $delete;
                $nestedData['super_user']        = $offer->id;
                $data[]               = $nestedData;
            }
        }

        $json_data = [
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data,
        ];

        echo json_encode($json_data);
        exit();
    }
}
