<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.subcategory.create', compact('categories'));

    }



    public function store(Request $request)
    {

        Subcategory::insert([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),

        ]);


        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('subcategory')->with($notification);


    }

    public function index()
    {

        $subcategories = Subcategory::latest()->get();
        return view('admin.subcategory.index', compact('subcategories'));

    }

    public function edit($id)
    {
        $categories = Category::latest()->get();
        $data = Subcategory::findOrFail($id);
        return view('admin.subcategory.edit', compact('categories', 'data'));
    }


    public function update(Request $request)
    {

        $id = $request->id;

        Subcategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),

        ]);


        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('subcategory')->with($notification);


    }

    public function delete($id)
    {

        Subcategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    }

    public function GetSubCategory($category_id)
    {

        $subcat = Subcategory::where('category_id', $category_id)->orderBy('name', 'ASC')->get();
        // dd($subcat);
        return json_encode($subcat);

    }
}