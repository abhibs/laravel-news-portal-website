<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;

class SeoController extends Controller
{
    public function index()
    {
        $data = Seo::find(1);
        return view('admin.seo.index', compact('data'));

    } // End Method

    public function update(Request $request)
    {
        $id = $request->id;

        Seo::findOrFail($id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);


        $notification = array(
            'message' => 'Seo Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);


    } // End Method
}