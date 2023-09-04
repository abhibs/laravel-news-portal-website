<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoGallery;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $datas = PhotoGallery::latest()->get();
        return view('admin.photo.index', compact('datas'));

    } // End Method


    public function create()
    {
        return view('admin.photo.create');
    } // End Method


    public function store(Request $request)
    {
        $image = $request->file('multi_image');

        foreach ($image as $mulit_image) {

            $name_gen = hexdec(uniqid()) . '.' . $mulit_image->getClientOriginalExtension();
            Image::make($mulit_image)->resize(700, 400)->save('storage/multiplephotos/' . $name_gen);
            $save_url = 'storage/multiplephotos/' . $name_gen;

            PhotoGallery::insert([
                'photo_gallery' => $save_url,
                'post_date' => Carbon::now()->format('d F Y'),

            ]);
        } // End Foreach

        $notification = array(
            'message' => 'Photo Gallery Inserted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('photo')->with($notification);

    } // End Method



    public function edit($id)
    {

        $data = PhotoGallery::findOrFail($id);
        return view('admin.photo.edit', compact('data'));

    } // End Method


    public function update(Request $request)
    {
        $id = $request->id;

        if ($request->file('multi_image')) {

            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(700, 400)->save('storage/multiplephotos/' . $name_gen);
            $save_url = 'storage/multiplephotos/' . $name_gen;

            PhotoGallery::findOrFail($id)->update([
                'photo_gallery' => $save_url,
                'post_date' => Carbon::now()->format('d F Y'),

            ]);

            $notification = array(
                'message' => 'Photo Gallery Updated Successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('photo')->with($notification);

        } // End If

    } // End Method


    public function delete($id)
    {

        $photo = PhotoGallery::findOrFail($id);
        $img = $photo->photo_gallery;
        unlink($img);

        PhotoGallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Photo Gallery Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);


    } // End Method
}