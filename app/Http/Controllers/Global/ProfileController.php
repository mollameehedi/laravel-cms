<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('global.profile.index');
    }
    public function update($request)
    {
        $user = User::find(Auth::id());
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->skype = $request->skype;
        $user->country = $request->country;
        Toastr::success('Profile Updated Successfully!!', 'Success', ["positionClass" => "toast-bottom-right"]);
        $user->save();
        return back();
    }
    public function password($request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        #Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            Toastr::error("Old Password Doesn't match!", 'error');
            return back();
        }
        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        Toastr::success("Password Change Successfully !!", 'Changed');
        return back();
    }
}
