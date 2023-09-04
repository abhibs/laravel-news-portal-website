<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $notification = array(
            'message' => 'User Registered Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('user-login')->with($notification);

    }

    public function login()
    {
        return view('user.login');
    }

    public function loginPost(Request $request)
    {
        // dd($request->all());
        $credentials = $request->only('email', 'password');
        $credentials['password'] = $request->password;
        // dd($credentials);
        if (Auth::guard('web')->attempt($credentials)) {
            // dd('hi');
            $notification1 = array(
                'message' => 'User Login Successful',
                'alert-type' => 'success'
            );
            return redirect()->route('user-dashboard')->with($notification1);
        } else {
            $notification2 = array(
                'message' => 'Invalid Credentials',
                'alert-type' => 'error'
            );
            return back()->with($notification2);
        }
    }

    public function userDashboard()
    {
        $id = Auth::guard('web')->user()->id;
        // dd($id);
        $data = User::find($id);
        return view('user.dashboard', compact('data'));
    }

    public function userProfileUpdate(Request $request)
    {

        $id = Auth::guard('web')->user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('storage/user/' . $data->image));
            $filename = 'user' . time() . '.' . $image->getClientOriginalExtension();

            // installing image intervention
            // composer require intervention/image

            // config/app.php
            // Intervention\Image\ImageServiceProvider::class,
            // 'Image' => Intervention\Image\Facades\Image::class,

            // php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"


            Image::make($image)->resize(256, 256)->save('storage/user/' . $filename);
            $filePath = 'storage/user/' . $filename;
            $data->image = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user-dashboard')->with($notification);


    }

    public function userChangePassword()
    {
        $id = Auth::guard('web')->user()->id;
        // dd($id);
        $data = User::find($id);
        return view('user.change_password', compact('data'));
    }

    public function userChangePasswordUpdate(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with('error', "Old Password Doesn't Match!!");
        }
        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);


        $notification = array(
            'message' => 'User Change Password Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user-login')->with($notification);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user-login')->with($notification);
    }
}