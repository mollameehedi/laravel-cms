<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Advertiser\CreateAdvertiser;
use App\Http\Requests\Admin\Advertiser\UpdateAdvertiser;
use App\Models\User;
use App\Models\Advertiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use voku\helper\ASCII;
use Yajra\Datatables\Datatables;

class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Advertiser::latest()->get();
            if (request()->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actionBtn = ('<div class="d-flex justify-content-evenly">
                        
                        <a class="btn btn-primary btn-icon btn-sm rounded-pill ms-2" href="' . route('admin.advertiser.edit', $row->id) . '" role="button">
                            <span class="btn-inner">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M19.9927 18.9534H14.2984C13.7429 18.9534 13.291 19.4124 13.291 19.9767C13.291 20.5422 13.7429 21.0001 14.2984 21.0001H19.9927C20.5483 21.0001 21.0001 20.5422 21.0001 19.9767C21.0001 19.4124 20.5483 18.9534 19.9927 18.9534Z" fill="currentColor"></path>
                                    <path d="M10.309 6.90385L15.7049 11.2639C15.835 11.3682 15.8573 11.5596 15.7557 11.6929L9.35874 20.0282C8.95662 20.5431 8.36402 20.8344 7.72908 20.8452L4.23696 20.8882C4.05071 20.8903 3.88775 20.7613 3.84542 20.5764L3.05175 17.1258C2.91419 16.4915 3.05175 15.8358 3.45388 15.3306L9.88256 6.95545C9.98627 6.82108 10.1778 6.79743 10.309 6.90385Z" fill="currentColor"></path>
                                    <path opacity="0.4" d="M18.1208 8.66544L17.0806 9.96401C16.9758 10.0962 16.7874 10.1177 16.6573 10.0124C15.3927 8.98901 12.1545 6.36285 11.2561 5.63509C11.1249 5.52759 11.1069 5.33625 11.2127 5.20295L12.2159 3.95706C13.126 2.78534 14.7133 2.67784 15.9938 3.69906L17.4647 4.87078C18.0679 5.34377 18.47 5.96726 18.6076 6.62299C18.7663 7.3443 18.597 8.0527 18.1208 8.66544Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-danger btn-icon btn-sm rounded-pill ms-2" href="' . route('admin.advertiser.destroy', $row->id) . '" role="button">
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
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }

        return view('admin.advertiser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertiser.create');
    }

    public function active(Request $request)
    {
        $advertiser = User::find($request->id);
        if ($advertiser->status == 'Approved') {
            $advertiser->update(['status' => 'Pending']);
        } else {
            $advertiser->update(['status' => 'Approved']);
        }
        return response([
            'status' => 'success',
        ]);
    }

    public function bulkAction(Request $request)
    {
        $user = User::findMany($request->ids);
        if ($request->action == "Approved") {
            $user->each(function ($user) {
                $user->update(['status' => 'Approved']);
            });
        } elseif ($request->action == "Pending") {
            $user->each(function ($user) {
                $user->update(['status' => 'Pending']);
            });
        }
        return response([
            'status' => 'success',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdvertiser $request)
    {

        Advertiser::create($request->all());
        return redirect()->route('admin.advertiser.index')->with('success', 'Advertiser created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertiser = User::find($id);
        return view('admin.advertiser.form', compact('advertiser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $advertiser, UpdateAdvertiser $request)
    {
        $password = $request->password ? bcrypt($request->password) : $advertiser->password;
        $request['password'] = $password;
        $advertiser->update($request->all());
        return redirect()->route('admin.advertiser.index')->with('success', 'Advertiser updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    #[NoReturn] public function search(Request $request): void
    {

        $columns = [
            'id',
            'id',
            'id',
            'name',
            'Email',
            'role',
            'created_at',
            'status',
            'actions',
        ];
        $totalData = User::where('role', 'Advertiser')->where('id', '!=', 1)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if ($order == 'name') {
            $order = 'name';
        }
        $search = $request->input('search.value');
        $advertisers = User::where('role', 'Advertiser')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('role', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalFiltered = User::where('role', 'Advertiser')
            ->where('id', 'LIKE', "%{$search}%")
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->orWhere('status', 'LIKE', "%{$search}%")
            ->orWhere('created_at', 'LIKE', "%{$search}%")
            ->count();
        $data = [];
        if (!empty($advertisers)) {
            foreach ($advertisers as $administrator) {
                $edit = route('admin.advertiser.edit', $administrator->id);
                $login    = route('admin.advertiser.edit', $administrator->id);
                if ($administrator->status == 'Approved') {
                    $status = 'checked';
                } else {
                    $status = '';
                }
                $get_roles = collect($administrator->roles)->map(function ($key) {
                    return ucfirst($key->display_name());
                })->join(',');
                $delete = null;
                $delete .= $administrator->id;
                $nestedData['id']           = $administrator->id;
                $nestedData['avatar']        = route('admin.advertiser.show', $administrator->id);
                $nestedData['email']         = $administrator->email;
                $nestedData['name']          = $administrator->name;
                $nestedData['created_at']    = $administrator->created_at->format('d M Y');
                $nestedData['status']        = "<div class='form-check form-switch form-check-primary'>
                <input type='checkbox' class='form-check-input get_status' id='status_$administrator->id' data-id='$administrator->id' name='status' {$status}>
                <label class='form-check-label' for='status_$administrator->id'>
                  <span class='switch-icon-left'><i data-feather='check'></i> </span>
                  <span class='switch-icon-right'><i data-feather='x'></i> </span>
                </label>
              </div>";

                $nestedData['edit']       = $edit;
                $nestedData['login_as']          = $login;
                $nestedData['delete']            = $administrator->uid;
                $nestedData['delete_label']      = $delete;
                $nestedData['super_user']        = $administrator->id;
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
