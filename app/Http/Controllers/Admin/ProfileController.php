<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Controllers\Global\ProfileController as Profile;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Global\Profile\UpdateProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $data['countries'] = Country::all();
        return view('admin.profile.index')->with($data);
    }
    public function update(UpdateProfile $request)
    {
        $profile_update = new Profile();
        $profile_update->update($request);
        return back();
    }
    public function password(Request $request)
    {
        $profile_update = new Profile();
        $profile_update->password($request);
        return back();
    }
}
