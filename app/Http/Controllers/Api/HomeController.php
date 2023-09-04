<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\PhotoGallery;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function currentDateTime()
    {
        $date = new DateTime();

        $currentDateTime = $date->format('l d-m-Y');
        // dd($currentDateTime);
        return response([
            'message' => 'Current Date Time',
            'status' => 'success',
            'currentDateTime' => $currentDateTime,
            'code' => 200
        ], 200);
    }

    public function apiSearchByName(Request $request)
    {
        $request->validate(['search' => "required"]);

        $item = $request->search;

        $news = News::where('title', 'LIKE', "%$item%")->select('title', 'image', 'post_date')->get();
        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->select('title', 'image', 'post_date')->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->select('title', 'image', 'post_date')->get();

        foreach ($news as $data) {
            $data->image = asset($data->image);
        }

        foreach ($newnewspost as $data) {
            $data->image = asset($data->image);
        }

        foreach ($newspopular as $data) {
            $data->image = asset($data->image);
        }

        return response([
            'message' => 'News Search By Name',
            'status' => 'success',
            'search_field_name' => $item,
            'news' => $news,
            'newnewspost' => $newnewspost,
            'newspopular' => $newspopular,
            'code' => 200
        ], 200);

    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (User::where('email', $request->email)->first()) {
            return response([
                'message' => 'Email already exists',
                'status' => 'failed'
            ], 404);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('mytoken')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
            'message' => 'Registration Success',
            'status' => 'success'
        ], 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken("mytoken")->plainTextToken;
            return response([
                'token' => $token,
                'user' => $user,
                'message' => 'Login Success',
                'status' => 'success'
            ], 200);
        }
        return response([
            'message' => 'The Provided Credentials are incorrect',
            'status' => 'failed'
        ], 404);
    }

    public function logged_user()
    {
        $loggeduser = auth()->user();
        return response([
            'user' => $loggeduser,
            'message' => 'Logged User Data',
            'status' => 'success'
        ], 200);
    }

    public function userProfileUpdate(Request $request)
    {
        $id = auth()->user()->id;
        $data = User::find($id);
        if ($request->has('name')) {
            $data->name = $request->name;
        }
        if ($request->has('email')) {
            $data->email = $request->email;
        }
        if ($request->has('phone')) {
            $data->phone = $request->phone;
        }
        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('storage/user/' . $data->image));
            $filename = 'user' . time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(256, 256)->save('storage/user/' . $filename);
            $filePath = 'storage/user/' . $filename;
            $data->image = $filename;
        }
        $data->save();

        $data->image = asset($data->image);
        return response([
            'message' => 'User Profile Data',
            'status' => 'success',
            'userProfileUpdatedData' => $data,
            'code' => 200
        ], 200);
    }


    public function userChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $loggeduser = auth()->user();
        $loggeduser->password = Hash::make($request->password);
        $loggeduser->save();
        return response([
            'message' => 'Password Changed Successfully',
            'status' => 'success'
        ], 200);
    }

    public function userLogout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout Success',
            'status' => 'success'
        ], 200);
    }

    public function category()
    {
        $category = Category::orderBy('name', 'ASC')->get();
        return response([
            'message' => 'Navbar Category Data',
            'status' => 'success',
            'NavbarCategory' => $category,
            'code' => 200
        ], 200);
    }

    public function subcategory()
    {
        $subcategory = Subcategory::with('category')->orderBy('name', 'ASC')->get();
        return response([
            'message' => 'Navbar Subcategory Data',
            'status' => 'success',
            'NavbarSubcategory' => $subcategory,
            'code' => 200
        ], 200);
    }

    public function breakingNews()
    {
        $breakingNews = News::where('status', 1)
            ->where('breaking_news', 1)
            ->inRandomOrder()
            ->select('id', 'title', 'slug')->get();

        return response([
            'message' => 'Breaking News',
            'status' => 'success',
            'breakingNews' => $breakingNews,
            'code' => 200
        ], 200);


    }

    public function sliderNews()
    {
        $sliderNews = News::where('status', 1)
            ->where('top_slider', 1)
            ->inRandomOrder()
            ->select('id', 'title', 'slug', 'image')->get();

        foreach ($sliderNews as $data) {
            $data->image = asset($data->image);
        }

        return response([
            'message' => 'Slider News',
            'status' => 'success',
            'sliderNews' => $sliderNews,
            'code' => 200
        ], 200);
    }

    public function threeSectionNews()
    {
        $threeSectionNews = News::where('status', 1)->where('first_section_three', 1)->limit(3)->inRandomOrder()->select('id', 'title', 'slug', 'image')->get();
        foreach ($threeSectionNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Three Section News',
            'status' => 'success',
            'threeSectionNews' => $threeSectionNews,
            'code' => 200
        ], 200);
    }

    public function nineSectionNews()
    {
        $nineSectionNews = News::where('status', 1)->where('first_section_nine', 1)->inRandomOrder()->limit(9)->select('id', 'title', 'slug', 'image')->get();

        foreach ($nineSectionNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Nine Section News',
            'status' => 'success',
            'nineSectionNews' => $nineSectionNews,
            'code' => 200
        ], 200);
    }

    public function liveTv()
    {
        $liveTv = LiveTv::find(1);
        $liveTv->image = asset($liveTv->image);
        return response([
            'message' => 'Live Tv',
            'status' => 'success',
            'liveTv' => $liveTv,
            'code' => 200
        ], 200);
    }

    public function searchByDate(Request $request)
    {

        $date = new DateTime($request->date);
        $formatDate = $date->format('d-m-Y');

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();

        $news = News::where('post_date', $formatDate)->latest()->select('id', 'title', 'slug', 'image')->get();
        // dd($news);

        foreach ($news as $data) {
            $data->image = asset($data->image);
        }

        foreach ($newnewspost as $data) {
            $data->image = asset($data->image);
        }

        foreach ($newspopular as $data) {
            $data->image = asset($data->image);
        }

        return response([
            'message' => 'News Search By Date',
            'status' => 'success',
            'search_field_date' => $formatDate,
            'news' => $news,
            'newnewspost' => $newnewspost,
            'newspopular' => $newspopular,
            'code' => 200
        ], 200);
    }

    public function Adsbannner()
    {
        $banners = Banner::select('home_one', 'home_two', 'home_three', 'home_four')->first();
        $banners->home_one = asset($banners->home_one);
        $banners->home_two = asset($banners->home_two);
        $banners->home_three = asset($banners->home_three);
        $banners->home_four = asset($banners->home_four);


        return response([
            'message' => 'Home Banner',
            'status' => 'success',
            'banners' => $banners,
            'code' => 200
        ], 200);
    }

    public function catWiseTabNews()
    {

        $allNews = News::where('status', 1)->inRandomOrder()
            ->select('id', 'title', 'slug', 'image')
            ->get();

        foreach ($allNews as $data) {
            $data->image = asset($data->image);
        }
        $categories = Category::latest()->get();

        $catWiseNews = [];

        foreach ($categories as $category) {
            $catWiseNewsUsingCategoryId = News::where('status', 1)
                ->where('category_id', $category->id)
                ->inRandomOrder()
                ->select('id', 'title', 'slug', 'image')
                ->get();

            $catWiseNews[$category->name] = $catWiseNewsUsingCategoryId;
            foreach ($catWiseNewsUsingCategoryId as $data) {
                $data->image = asset($data->image);
            }
        }

        return response([
            'message' => 'All News and Category Wise News',
            'status' => 'success',
            'allNews' => $allNews,
            'catWiseNews' => $catWiseNews,
            'code' => 200
        ], 200);
    }

    public function policalCatNews()
    {
        $politicalCategory = Category::where('slug', 'politics')->first();
        $politicalSubCategory = Subcategory::where('category_id', $politicalCategory->id)->orderBy('id', 'DESC')->get();
        $recentNews = News::where('category_id', $politicalCategory->id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $relatedTwoNews = News::where('category_id', $politicalCategory->id)
            ->where('id', '!=', $recentNews->id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->select('id', 'title', 'slug', 'image')->get();
        $relatedTwoNewsIds = $relatedTwoNews->pluck('id');
        $relatedFiveNews = News::where('category_id', $politicalCategory->id)
            ->whereNotIn('id', [$recentNews->id])
            ->whereNotIn('id', $relatedTwoNewsIds->toArray())
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->select('id', 'title', 'slug', 'image')->get();

        $recentNews->image = asset($recentNews->image);
        foreach ($relatedTwoNews as $data) {
            $data->image = asset($data->image);
        }
        foreach ($relatedFiveNews as $data) {
            $data->image = asset($data->image);
        }

        return response([
            'message' => 'Political News',
            'status' => 'success',
            'politicalCategory' => $politicalCategory,
            'politicalSubCategory' => $politicalSubCategory,
            'recentNews' => $recentNews,
            'relatedTwoNews' => $relatedTwoNews,
            'relatedFiveNews' => $relatedFiveNews,
            'code' => 200
        ], 200);
    }

    public function entertainmentCatNews()
    {
        $entertainmentCategory = Category::where('slug', 'entertainment')->first();
        $entertainmentSubCategory = Subcategory::where('category_id', $entertainmentCategory->id)->orderBy('id', 'DESC')->get();
        $entertaimentAllNews = News::where('category_id', $entertainmentCategory->id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->get();
        foreach ($entertaimentAllNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Entertainment News',
            'status' => 'success',
            'entertainmentCategory' => $entertainmentCategory,
            'entertainmentSubCategory' => $entertainmentSubCategory,
            'entertaimentAllNews' => $entertaimentAllNews,
            'code' => 200
        ], 200);

    }

    public function automobilesCatNews()
    {
        $automobilesCategory = Category::where('slug', 'automobiles')->first();
        $automobilesSubCategory = Subcategory::where('category_id', $automobilesCategory->id)->orderBy('id', 'DESC')->get();

        $recentAutomobilesNews = News::where('category_id', $automobilesCategory->id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $relatedAutomobilesNews = News::where('category_id', $automobilesCategory->id)
            ->where('id', '!=', $recentAutomobilesNews->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->select('id', 'title', 'slug', 'image')->get();
        $recentAutomobilesNews->image = asset($recentAutomobilesNews->image);

        foreach ($relatedAutomobilesNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'automobiles News',
            'status' => 'success',
            'automobilesCategory' => $automobilesCategory,
            'automobilesSubCategory' => $automobilesSubCategory,
            'recentAutomobilesNews' => $recentAutomobilesNews,
            'relatedAutomobilesNews' => $relatedAutomobilesNews,
            'code' => 200
        ], 200);
    }

    public function crimeCatNews()
    {
        $crimeCategory = Category::where('slug', 'crime')->first();
        $crimeSubCategory = Subcategory::where('category_id', $crimeCategory->id)->orderBy('id', 'DESC')->get();
        $recentCrimeNews = News::where('category_id', $crimeCategory->id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $relatedCrimeNews = News::where('category_id', $crimeCategory->id)
            ->where('id', '!=', $recentCrimeNews->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->select('id', 'title', 'slug', 'image')->get();

        $recentCrimeNews->image = asset($recentCrimeNews->image);

        foreach ($relatedCrimeNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Crime News',
            'status' => 'success',
            'crimeCategory' => $crimeCategory,
            'crimeSubCategory' => $crimeSubCategory,
            'recentCrimeNews' => $recentCrimeNews,
            'relatedCrimeNews' => $relatedCrimeNews,
            'code' => 200
        ], 200);
    }

    public function healthCatNews()
    {
        $healthCategory = Category::where('slug', 'health-and-fitness')->first();
        $healthSubCategory = Subcategory::where('category_id', $healthCategory->id)->orderBy('id', 'DESC')->get();
        $recentHealthNews = News::where('category_id', $healthCategory->id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $relatedHealthNews = News::where('category_id', $healthCategory->id)
            ->where('id', '!=', $recentHealthNews->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->select('id', 'title', 'slug', 'image')->get();

        $recentHealthNews->image = asset($recentHealthNews->image);

        foreach ($relatedHealthNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Health News',
            'status' => 'success',
            'healthCategory' => $healthCategory,
            'healthSubCategory' => $healthSubCategory,
            'recentHealthNews' => $recentHealthNews,
            'relatedHealthNews' => $relatedHealthNews,
            'code' => 200
        ], 200);
    }

    public function sportsCatNews()
    {
        $sportsCategory = Category::where('slug', 'sports')->first();
        $sportsSubCategory = Subcategory::where('category_id', $sportsCategory->id)->orderBy('id', 'DESC')->get();
        $recentSportsNews = News::where('category_id', $sportsCategory->id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $relatedSportsNews = News::where('category_id', $sportsCategory->id)
            ->where('id', '!=', $recentSportsNews->id)
            ->orderBy('id', 'DESC')
            ->limit(4)->inRandomOrder()
            ->select('id', 'title', 'slug', 'image')->get();

        $recentSportsNews->image = asset($recentSportsNews->image);

        foreach ($relatedSportsNews as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Sports News',
            'status' => 'success',
            'sportsCategory' => $sportsCategory,
            'sportsSubCategory' => $sportsSubCategory,
            'recentSportsNews' => $recentSportsNews,
            'relatedSportsNews' => $relatedSportsNews,
            'code' => 200
        ], 200);
    }

    public function photoGallery()
    {
        $photoGalleries = PhotoGallery::latest()->get();
        foreach ($photoGalleries as $data) {
            $data->photo_gallery = asset($data->photo_gallery);
        }
        return response([
            'message' => 'Photo Galleries',
            'status' => 'success',
            'photoGalleries' => $photoGalleries,
            'code' => 200
        ], 200);
    }

    public function videoGallery()
    {
        $videogalleries = VideoGallery::latest()->get();
        foreach ($videogalleries as $data) {
            $data->image = asset($data->image);
        }
        return response([
            'message' => 'Video Galleries',
            'status' => 'success',
            'videogalleries' => $videogalleries,
            'code' => 200
        ], 200);
    }

    public function contactUs(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comments' => 'required',

        ]);

        $contact = new ContactUs;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->comments = $request->comments;


        $contact->save();

        return response([
            'message' => 'Contact Form Submited Successfully',
            'status' => 'success',
            'contact' => $contact,
            'code' => 200
        ], 200);
    }

    public function newsDetail($id, $slug)
    {
        $news = News::with('category', 'subcategory', 'admin')->findOrFail($id);
        $news->image = asset($news->image);
        $news->admin->image = asset($news->admin->image);


        $tags = $news->tags;
        $tags_all = explode(',', $tags);

        // dd($tags_all);
        foreach ($tags_all as $key => $tag) {
            $tag[$key];
        }

        $banners = Banner::select('news_details_one')->first();
        $banners->news_category_one = asset($banners->news_category_one);


        $reviews = Review::with('user')->where('news_id', $news->id)
            ->latest()
            ->limit(5)
            ->get();

        // dd($reviews);
        foreach ($reviews as $data) {
            $data->user->image = asset('storage/user/' . $data->user->image);
        }

        $cat_id = $news->category_id;
        $relatedNews = News::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(6)->select('id', 'title', 'slug', 'image')->get();


        foreach ($relatedNews as $data) {
            $data->image = asset($data->image);
        }
        $newsKey = 'blog' . $news->id;
        if (!Session::has($newsKey)) {
            $news->increment('view_count');
            Session::put($newsKey, 1);
        }



        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();

        foreach ($newnewspost as $data) {
            $data->image = asset($data->image);
        }

        foreach ($relatedNews as $data) {
            $data->image = asset($data->image);
        }

        return response([
            'message' => 'Single News With id and Slug',
            'status' => 'success',
            'singlenewsapi' => $news,
            'tags' => $tags_all,
            'banners' => $banners,
            'reviews' => $reviews,
            'relatedNews' => $relatedNews,
            'newnewspost' => $newnewspost,
            'newspopular' => $newspopular,
            'code' => 200
        ], 200);


    }

    public function categoryWiseNews($id, $slug)
    {

        $categoryName = Category::where('id', $id)->first();
        $recentNews = News::where('category_id', $id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $recentNews->image = asset($recentNews->image);
        $relatedTwoNews = News::where('category_id', $id)
            ->where('id', '!=', $recentNews->id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->select('id', 'title', 'slug', 'image')->get();

        foreach ($relatedTwoNews as $data) {
            $data->image = asset($data->image);
        }
        $relatedTwoNewsIds = $relatedTwoNews->pluck('id');

        $otherNews = News::where('category_id', $id)
            ->whereNotIn('id', [$recentNews->id])
            ->whereNotIn('id', $relatedTwoNewsIds->toArray())
            ->orderBy('id', 'DESC')
            ->select('id', 'title', 'slug', 'image')->get();

        foreach ($otherNews as $data) {
            $data->image = asset($data->image);
        }
        $banners = Banner::select('news_category_one')->first();
        $banners->news_category_one = asset($banners->news_category_one);

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();

        foreach ($newnewspost as $data) {
            $data->image = asset($data->image);
        }
        foreach ($newspopular as $data) {
            $data->image = asset($data->image);
        }


        return response([
            'message' => 'Category News With id and Slug',
            'status' => 'success',
            'categoryName' => $categoryName,
            'recentNews' => $recentNews,
            'relatedTwoNews' => $relatedTwoNews,
            'otherNews' => $otherNews,
            'banners' => $banners,
            'newnewspost' => $newnewspost,
            'newspopular' => $newspopular,
            'code' => 200
        ], 200);
    }


    public function subCategoryWiseNews($id, $slug)
    {
        $subCategoryName = Subcategory::with('category')->where('id', $id)->first();

        $recentNews = News::where('subcategory_id', $id)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'image')->first();
        $recentNews->image = asset($recentNews->image);

        $relatedTwoNews = News::where('subcategory_id', $id)
            ->where('id', '!=', $recentNews->id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->select('id', 'title', 'slug', 'image')->get();
        foreach ($relatedTwoNews as $data) {
            $data->image = asset($data->image);
        }
        $relatedTwoNewsIds = $relatedTwoNews->pluck('id');

        $otherNews = News::where('subcategory_id', $id)
            ->whereNotIn('id', [$recentNews->id])
            ->whereNotIn('id', $relatedTwoNewsIds->toArray())
            ->orderBy('id', 'DESC')
            ->select('id', 'title', 'slug', 'image')->get();
        foreach ($otherNews as $data) {
            $data->image = asset($data->image);
        }
        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->select('id', 'title', 'slug', 'image')->get();

        foreach ($newnewspost as $data) {
            $data->image = asset($data->image);
        }
        foreach ($newspopular as $data) {
            $data->image = asset($data->image);
        }


        return response([
            'message' => 'Sub Category News With id and Slug',
            'status' => 'success',
            'subCategoryName' => $subCategoryName,
            'recentNews' => $recentNews,
            'relatedTwoNews' => $relatedTwoNews,
            'otherNews' => $otherNews,
            'newnewspost' => $newnewspost,
            'newspopular' => $newspopular,
            'code' => 200
        ], 200);

    }


    public function reporterWiseNews($id)
    {
        $admin = Admin::select('name', 'email', 'phone', 'address', 'image', 'facebook', 'twitter', 'youtube', 'linkedin', 'instagram')
            ->where('id', $id)
            ->firstOrFail();
        $news = News::where('admin_id', $id)->select('id', 'title', 'slug', 'image')->get();

        $admin->image = asset($admin->image);
        foreach ($news as $data) {
            $data->image = asset($data->image);
        }


        return response([
            'message' => 'Reporter Wise News',
            'status' => 'success',
            'admin' => $admin,
            'news' => $news,
            'code' => 200
        ], 200);
    }

    public function reviewPost(Request $request)
    {
        $news_id = $request->news_id;
        $user_id = Auth::user()->id;
        Review::insert([
            'user_id' => $user_id,
            'news_id' => $news_id,
            'comments' => $request->comments,
            'created_at' => Carbon::now(),
        ]);

        return response([
            'message' => 'Review Will Approve By Admin',
            'status' => 'success',
            'code' => 200
        ], 200);
    }


}
