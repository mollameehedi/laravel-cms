<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Affiliate\CreateAffiliateRequest;
use App\Http\Requests\Admin\Affiliate\UpdateAffiliateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Brian2694\Toastr\Facades\Toastr;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = User::where('role', 'Affiliate')->get();
        return view('admin.affiliate.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['managers'] = User::where('role', 'Manager')->get();
        $data['countries'] = Country::all();
        return view('admin.affiliate.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAffiliateRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'country' => $request->country,
            'skype' => $request->skype,
            'status' => $request->status,
            'manager_id' => $request->manager_id,
        ]);
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        return redirect()->route('admin.affiliate.index');
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
        $affiliate = User::findOrFail($id);
        $managers = User::where('role', 'Manager')->get();
        return view('admin.affiliate.form', compact('affiliate', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $affiliate, UpdateAffiliateRequest $request)
    {
        $password = $request->password ? bcrypt($request->password) : $affiliate->password;
        $request['password'] = $password;
        $affiliate->update($request->all());
        return redirect()->route('admin.affiliate.index')->with([
            'status' => 'success',
            'message' => 'Affiliate Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $affiliate = User::findOrFail($id);
        $affiliate->delete();
        return response([
            'status' => 'success',
            'message' => 'Affiliate Deleted Successfully',
        ]);
    }


    public function active(Request $request)
    {
        $affiliate = User::findOrFail($request->id);
        if ($affiliate->manager_id == null) {
            return;
        }
        $affiliate->status == "Pending" ? $status = "Approved" : $status = "Pending";
        $affiliate->update(compact('status'));
        return response([
            'status' => 'success',
            'message' => 'Affiliate Status Changes',
        ]);
    }

    public function search(Request $request)
    {
        $columns = [
            'id',
            'id',
            'id',
            'name',
            'manager',
            'balance',
            'role',
            'created_at',
            'status',
            'actions',
        ];

        // Filter Payload
        $name =  $request->name;
        $email =  $request->email;
        $manager =  $request->manager_id;
        $status =  $request->status;


        $totalData = User::where('role', 'Affiliate')->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search.value');
        $affiliates = User::where('role', 'Affiliate')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            })
            ->when(!empty($name), function ($query) use ($name) {
                $query->where('name', 'LIKE', "%{$name}%");
            })
            ->when(!empty($email), function ($query) use ($email) {
                $query->where('email', 'LIKE', "%{$email}%");
            })
            ->when(!empty($manager), function ($query) use ($manager) {
                $query->where('manager_id', $manager);
            })
            ->when(!empty($status), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderByDesc('id')
            ->offset($start)
            ->limit($limit)
            ->get();

        $data = [];
        if (!empty($affiliates)) {
            foreach ($affiliates as $affiliate) {
                $show = route('admin.affiliate.edit', $affiliate->id);
                $login    = route('admin.affiliate.login', $affiliate->id);
                if ($affiliate->status == "Approved") {
                    $status = 'checked';
                } else {
                    $status = '';
                }

                $edit   = null;
                $delete = null;
                $edit .= $show;
                $delete .= $affiliate->id;
                $login .= $affiliate->id;


                $nestedData['id']           = $affiliate->id;
                $nestedData['avatar']        = route('admin.affiliate.show', $affiliate->id);
                $nestedData['email']         = $affiliate->email;
                $nestedData['roles']         = 'Affiliate';
                $nestedData['manager']         = $affiliate->manager->name ?? "Not assign";
                $nestedData['balance']         = $affiliate->balance;
                $nestedData['name']          = $affiliate->name;
                $nestedData['created_at']    = $affiliate->created_at->format('d M Y');
                $nestedData['status']        = "<div class='form-check form-switch form-check-primary'>
                <input type='checkbox' class='form-check-input get_status' id='status_$affiliate->id' data-id='$affiliate->id' name='status' $status>
                <label class='form-check-label' for='status_$affiliate->id'>

                </label>
              </div>";


                $nestedData['edit']   = $edit;
                $nestedData['login']   = $login;
                $nestedData['delete'] = $delete;
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

    public function login(Request $request, $id)
    {
        $id = $request->id;
        // switch user
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->ids;
        $users = User::whereIn('id', $ids)->get();
        $action = $request->action;
        if ($action == "Approved") {
            $users->each(static function ($user) {
                $user->update(['status' => 'Approved']);
            });
            $messages = "Affiliate Approved Successfully";
        } elseif ($action == "Suspend") {
            $users->each(static function ($user) {
                $user->update(['status' => 'Pending']);
            });
            $messages = "Affiliate Pending Successfully";
        } elseif ($action == "Delete") {
            $users->each(static function ($user) {
                $user->delete();
            });
            $messages = "Affiliate Deleted Successfully";
        }
        $messages = "Affiliate Deleted Successfully";
        return response([
            'status' => 'success',
            'message' => $messages,
        ]);
    }
}
