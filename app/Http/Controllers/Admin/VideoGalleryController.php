<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoGallery;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class VideoGalleryController extends Controller
{
    public function index()
    {

        $datas = VideoGallery::latest()->get();
        return view('admin.video.index', compact('datas'));

    } // End Method


    public function create()
    {
        return view('admin.video.create');
    } // End Method


    public function store(Request $request)
    {

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(784, 436)->save('storage/bgvideoimage/' . $name_gen);
        $save_url = 'storage/bgvideoimage/' . $name_gen;

        VideoGallery::insert([

            'title' => $request->title,
            'url' => $request->url,
            'post_date' => Carbon::now()->format('d F Y'),
            'image' => $save_url,

        ]);

        $notification = array(
            'message' => 'Video Inserted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('video')->with($notification);


    } // End Method



    public function edit($id)
    {

        $data = VideoGallery::findOrFail($id);
        return view('admin.video.edit', compact('data'));

    } // End Method


    public function update(Request $request)
    {

        $id = $request->id;
        $old_img = $request->image;

        if ($request->file('image')) {
            @unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(784, 436)->save('storage/bgvideoimage/' . $name_gen);
            $save_url = 'storage/bgvideoimage/' . $name_gen;

            VideoGallery::findOrFail($id)->update([

                'title' => $request->title,
                'url' => $request->url,
                'post_date' => Carbon::now()->format('d F Y'),
                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Video Update With Image Successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('video')->with($notification);

        } else {

            VideoGallery::findOrFail($id)->update([

                'title' => $request->title,
                'url' => $request->url,
                'post_date' => Carbon::now()->format('d F Y'),

            ]);

            $notification = array(
                'message' => 'Video Update Without Image Successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('video')->with($notification);

        }

    } // End Method


    public function delete($id)
    {

        $photo = VideoGallery::findOrFail($id);
        $img = $photo->image;
        unlink($img);

        VideoGallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Video Gallery Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);


    } // End Method
}