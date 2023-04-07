<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Manager\CreateManagerRequest;
use App\Http\Requests\Admin\Manager\UpdateManagerRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manager.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Country::all();
        return view('admin.manager.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateManagerRequest $request)
    {
        // dd($request->all());
        $manager = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'Manager',
            'country' => $request->country,
            'skype' => $request->skype,
            'status' => $request->status,
        ]);
        if ($request->hasFile('avatar')) {
            $manager->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
        // return redirect()->route('admin.manager.index')->with('success', 'Manager created successfully');
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
        $manager = User::findOrFail($id);
        return view('admin.manager.form', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $manager, UpdateManagerRequest $request)
    {
        $request['password'] = $request->password ? bcrypt($request->password) : $manager->password;
        $manager->update($request->all());
        return redirect()->route('admin.manager.index')->with('success', 'Manager updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    #[NoReturn] public function search(Request $request): void
    {
        $columns = [
            'id',
            'id',
            'id',
            'name',
            'Email',
            'affiliate',
            'created_at',
            'status',
            'actions',
        ];
        $totalData = User::where('role', 'Manager')->where('id', '!=', 1)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if ($order == 'name') {
            $order = 'name';
        }
        $search = $request->input('search.value');
        $managers = User::where('role', 'Manager')
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
        if (!empty($managers)) {
            foreach ($managers as $manager) {
                $edit = route('admin.manager.edit', $manager->id);
                $login    = route('admin.manager.edit', $manager->id);
                if ($manager->status == 'Approved') {
                    $status = 'checked';
                } else {
                    $status = '';
                }
                $delete = null;
                $delete .= $manager->id;
                $nestedData['id']           = $manager->id;
                $nestedData['avatar']        = route('admin.manager.show', $manager->id);
                $nestedData['email']         = $manager->email;
                $nestedData['affiliate']       = $manager->affiliates->count() == 0 ? 0 : $manager->affiliates->count();
                $nestedData['name']          = $manager->name;
                $nestedData['created_at']    = $manager->created_at->format('d M Y');
                $nestedData['status']        = "<div class='form-check form-switch form-check-primary'>
                <input type='checkbox' class='form-check-input get_status' id='status_$manager->id' data-id='$manager->id' name='status' {$status}>
                <label class='form-check-label' for='status_$manager->id'>
                  <span class='switch-icon-left'><i data-feather='check'></i> </span>
                  <span class='switch-icon-right'><i data-feather='x'></i> </span>
                </label>
              </div>";

                $nestedData['edit']              = $edit;
                $nestedData['login_as']          = $login;
                $nestedData['delete']            = $manager->uid;
                $nestedData['delete_label']      = $delete;
                $nestedData['super_user']        = $manager->id;
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
        } elseif ($request->action == "Suspend") {
            $user->each(function ($user) {
                $user->update(['status' => 'Suspend']);
            });
        }
        return response([
            'status' => 'success',
        ]);
    }
}
