<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index(){
        return view('author.settings');
    }
    public function updateProfile(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => 'required|image',
        ]);
        $image = $request->file('avatar');
        $user = User::find(Auth::id());
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imgName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }
            $profile = Image::make($image)->resize('500', '500')->stream();
            Storage::disk('public')->put('profile/' . $imgName, $profile);
        } else {
            $imgName = $user->image;
        }

        $user->name  = $request->name;
        $user->image = $imgName;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Profile Successfully Updated', 'success');
        return redirect()->back();
    }
    public function updatePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashPass = Auth::user()->password;
        if (Hash::check($request->old_password, $hashPass)) {
            if (!Hash::check($request->password, $hashPass)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed', 'success');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('New password can not be same old password', 'error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password does not match', 'error');
            return redirect()->back();
        }
    }
}
