<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactList()
    {
        $datas = ContactUs::latest()->get();
        return view('admin.contact.contaclist', compact('datas'));
    }

    public function deleteContact($id)
    {
        ContactUs::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Contact Us Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}