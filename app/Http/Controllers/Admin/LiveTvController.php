<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Models\LiveTv;

class LiveTvController extends Controller
{
    public function index()
    {
        // dd('hii');
        $data = LiveTv::findOrFail(1);
        return view('admin.livetv.index', compact('data'));
    } // End Method


    public function update(Request $request)
    {

        $id = $request->id;
        $old_img = $request->old_image;
        if ($request->file('image')) {
            @unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(784, 436)->save('storage/livetvbgimage/' . $name_gen);
            $save_url = 'storage/livetvbgimage/' . $name_gen;

            LiveTv::findOrFail($id)->update([

                'url' => $request->url,
                'post_date' => Carbon::now()->format('d F Y'),
                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Live Tv Update With Image Successfully',
                'alert-type' => 'success'

            );
            return redirect()->back()->with($notification);

        } else {

            LiveTv::findOrFail($id)->update([

                'url' => $request->url,
                'post_date' => Carbon::now()->format('d F Y'),

            ]);

            $notification = array(
                'message' => 'Live Tv Update Without Image Successfully',
                'alert-type' => 'success'

            );
            return redirect()->back()->with($notification);

        }

    }
}