<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Admin;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class NewsController extends Controller
{
    public function index()
    {
        $datas = News::latest()->get();
        return view('admin.news.index', compact('datas'));
    }

    public function create()
    {
        // dd('hii');
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $admins = Admin::latest()->get();

        return view('admin.news.create', compact('categories', 'subcategories', 'admins'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(784, 436)->save('storage/news/' . $name_gen);
        $save_url = 'storage/news/' . $name_gen;

        News::insert([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'admin_id' => $request->admin_id,
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),

            'details' => $request->details,
            'tags' => $request->tags,

            'breaking_news' => $request->breaking_news,
            'top_slider' => $request->top_slider,
            'first_section_three' => $request->first_section_three,
            'first_section_nine' => $request->first_section_nine,

            'post_date' => date('d-m-Y'),
            'post_month' => date('F'),
            'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'News Inserted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('news')->with($notification);


    }

    public function edit($id)
    {

        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $admins = Admin::latest()->get();
        $data = News::findOrFail($id);
        return view('admin.news.edit', compact('categories', 'subcategories', 'admins', 'data'));
    }

    public function update(Request $request)
    {

        $id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(784, 436)->save('storage/news/' . $name_gen);
            $save_url = 'storage/news/' . $name_gen;

            News::findOrFail($id)->update([

                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'admin_id' => $request->admin_id,
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'details' => $request->details,
                'tags' => $request->tags,
                'breaking_news' => $request->breaking_news,
                'top_slider' => $request->top_slider,
                'first_section_three' => $request->first_section_three,
                'first_section_nine' => $request->first_section_nine,
                'post_date' => date('d-m-Y'),
                'post_month' => date('F'),
                'image' => $save_url,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'News Updated with Image Successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('news')->with($notification);


        } else {

            News::findOrFail($id)->update([

                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'admin_id' => $request->admin_id,
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),

                'details' => $request->details,
                'tags' => $request->tags,

                'breaking_news' => $request->breaking_news,
                'top_slider' => $request->top_slider,
                'first_section_three' => $request->first_section_three,
                'first_section_nine' => $request->first_section_nine,

                'post_date' => date('d-m-Y'),
                'post_month' => date('F'),
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'News Updated without Image Successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('news')->with($notification);

        }

    }

    public function inactive($id)
    {
        News::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'News InActive Successfully',
            'alert-type' => 'error'

        );
        return redirect()->back()->with($notification);

    }

    public function active($id)
    {
        News::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'News Active Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }

    public function delete($id)
    {
        $data = News::findOrFail($id);
        $img = $data->image;
        unlink($img);

        News::findOrFail($id)->delete();

        $notification = array(
            'message' => 'News Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }



}