<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList()
    {
        $datas = User::latest()->get();
        return view('admin.user.userlist', compact('datas'));
    }

    public function deleteUser($id)
    {
        $photo = User::findOrFail($id);
        unlink(public_path('storage/user/' . $photo->image));
        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
