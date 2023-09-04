<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\PhotoGallery;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DateTime;
use Auth;
use Carbon\Carbon;



class HomeController extends Controller
{
    public function index()
    {
        $news_slider_datas = News::where('status', 1)->where('top_slider', 1)->limit(36)->inRandomOrder()->get();
        $section_three_datas = News::where('status', 1)->where('first_section_three', 1)->limit(3)->inRandomOrder()->get();
        $section_nine_datas = News::where('status', 1)->where('first_section_nine', 1)->inRandomOrder()->limit(9)->get();

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->get();

        $livetv = LiveTv::find(1);
        $banners = Banner::find(1);

        $politicalCategory = Category::where('slug', 'politics')->first();
        $politicalSubCategory = Subcategory::where('category_id', $politicalCategory->id)->orderBy('id', 'DESC')->get();



        $recentNews = News::where('category_id', $politicalCategory->id)->orderBy('id', 'DESC')->first();
        $relatedTwoNews = News::where('category_id', $politicalCategory->id)
            ->where('id', '!=', $recentNews->id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();

        $relatedTwoNewsIds = $relatedTwoNews->pluck('id');

        $relatedFiveNews = News::where('category_id', $politicalCategory->id)
            ->whereNotIn('id', [$recentNews->id])
            ->whereNotIn('id', $relatedTwoNewsIds->toArray())
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        $photogalleries = PhotoGallery::latest()->get();
        $photogalleries1 = PhotoGallery::latest()->get();
        $videogalleries = VideoGallery::latest()->limit(5)->get();


        $entertainmentCategory = Category::where('slug', 'entertainment')->first();
        $entertainmentSubCategory = Subcategory::where('category_id', $entertainmentCategory->id)->orderBy('id', 'DESC')->get();

        $entertaimentAllNews = News::where('category_id', $entertainmentCategory->id)->orderBy('id', 'DESC')->get();

        $automobilesCategory = Category::where('slug', 'automobiles')->first();
        $automobilesSubCategory = Subcategory::where('category_id', $automobilesCategory->id)->orderBy('id', 'DESC')->get();

        $recentAutomobilesNews = News::where('category_id', $automobilesCategory->id)->orderBy('id', 'DESC')->first();
        $relatedAutomobilesNews = News::where('category_id', $automobilesCategory->id)
            ->where('id', '!=', $recentAutomobilesNews->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        $crimeCategory = Category::where('slug', 'crime')->first();
        $crimeSubCategory = Subcategory::where('category_id', $crimeCategory->id)->orderBy('id', 'DESC')->get();

        $recentCrimeNews = News::where('category_id', $crimeCategory->id)->orderBy('id', 'DESC')->first();
        $relatedCrimeNews = News::where('category_id', $crimeCategory->id)
            ->where('id', '!=', $recentCrimeNews->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        $healthCategory = Category::where('slug', 'health-and-fitness')->first();
        $healthSubCategory = Subcategory::where('category_id', $healthCategory->id)->orderBy('id', 'DESC')->get();

        $recentHealthNews = News::where('category_id', $healthCategory->id)->orderBy('id', 'DESC')->first();
        $relatedHealthNews = News::where('category_id', $healthCategory->id)
            ->where('id', '!=', $recentHealthNews->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        $sportsCategory = Category::where('slug', 'sports')->first();
        $sportsSubCategory = Subcategory::where('category_id', $sportsCategory->id)->orderBy('id', 'DESC')->get();
        $recentSportsNews = News::where('category_id', $sportsCategory->id)->orderBy('id', 'DESC')->first();
        $relatedSportsNews = News::where('category_id', $sportsCategory->id)
            ->where('id', '!=', $recentSportsNews->id)
            ->orderBy('id', 'DESC')
            ->limit(4)->inRandomOrder()
            ->get();


        return view(
            'welcome',
            compact(
                'news_slider_datas',
                'section_three_datas',
                'section_nine_datas',
                'newnewspost',
                'newspopular',
                'livetv',
                'banners',
                'politicalCategory',
                'politicalSubCategory',
                'recentNews',
                'relatedTwoNews',
                'relatedFiveNews',
                'photogalleries',
                'photogalleries1',
                'videogalleries',
                'entertainmentCategory',
                'entertainmentSubCategory',
                'entertaimentAllNews',
                'automobilesCategory',
                'automobilesSubCategory',
                'recentAutomobilesNews',
                'relatedAutomobilesNews',
                'crimeCategory',
                'crimeSubCategory',
                'recentCrimeNews',
                'relatedCrimeNews',
                'healthCategory',
                'healthSubCategory',
                'recentHealthNews',
                'relatedHealthNews',
                'sportsCategory',
                'sportsSubCategory',
                'recentSportsNews',
                'relatedSportsNews'
            )
        );
    }

    public function newsDetais($id, $slug)
    {
        $banner = Banner::find(1);

        $news = News::findOrFail($id);

        $tags = $news->tags;
        $tags_all = explode(',', $tags);

        $cat_id = $news->category_id;
        $relatedNews = News::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(6)->get();

        $newsKey = 'blog' . $news->id;
        if (!Session::has($newsKey)) {
            $news->increment('view_count');
            Session::put($newsKey, 1);
        }

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->get();

        return view('news_details', compact('news', 'tags_all', 'relatedNews', 'newnewspost', 'newspopular', 'banner'));
    }


    public function categoryNews($id, $slug)
    {
        $banner = Banner::find(1);

        $categoryName = Category::where('id', $id)->first();

        $recentNews = News::where('category_id', $id)->orderBy('id', 'DESC')->first();
        $relatedTwoNews = News::where('category_id', $id)
            ->where('id', '!=', $recentNews->id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();
        // $otherNews = News::where('category_id', $id)->orderBy('id', 'DESC')->paginate(3);
        // dd($otherNews);
        $relatedTwoNewsIds = $relatedTwoNews->pluck('id');

        $otherNews = News::where('category_id', $id)
            ->whereNotIn('id', [$recentNews->id])
            ->whereNotIn('id', $relatedTwoNewsIds->toArray())
            ->orderBy('id', 'DESC')
            ->simplePaginate(3);

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->get();


        return view('category_news', compact('recentNews', 'relatedTwoNews', 'otherNews', 'newnewspost', 'newspopular', 'categoryName', 'banner'));
    }

    public function subCategoryNews($id, $slug)
    {
        $subCategoryName = Subcategory::where('id', $id)->first();

        $recentNews = News::where('subcategory_id', $id)->orderBy('id', 'DESC')->first();
        $relatedTwoNews = News::where('subcategory_id', $id)
            ->where('id', '!=', $recentNews->id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();

        $relatedTwoNewsIds = $relatedTwoNews->pluck('id');

        $otherNews = News::where('subcategory_id', $id)
            ->whereNotIn('id', [$recentNews->id])
            ->whereNotIn('id', $relatedTwoNewsIds->toArray())
            ->orderBy('id', 'DESC')
            ->simplePaginate(3);

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->get();

        return view('sub_category_news', compact('subCategoryName', 'recentNews', 'relatedTwoNews', 'otherNews', 'newnewspost', 'newspopular'));
    }

    public function searchByDate(Request $request)
    {

        $date = new DateTime($request->date);
        $formatDate = $date->format('d-m-Y');

        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->get();

        $news = News::where('post_date', $formatDate)->latest()->get();

        return view('search_by_date', compact('news', 'formatDate', 'newnewspost', 'newspopular'));

    }

    public function searchByName(Request $request)
    {
        $request->validate(['search' => "required"]);

        $item = $request->search;

        $news = News::where('title', 'LIKE', "%$item%")->get();
        $newnewspost = News::orderBy('id', 'DESC')->limit(8)->get();
        $newspopular = News::orderBy('view_count', 'DESC')->limit(8)->get();

        return view('search_by_name', compact('news', 'newnewspost', 'newspopular', 'item'));
    }

    public function adminNews($id)
    {
        $admin = Admin::findOrFail($id);

        $news = News::where('admin_id', $id)->get();
        return view('admin_wise_news', compact('admin', 'news'));
    }

    public function reviewPost(Request $request)
    {
        $news_id = $request->id;
        $user_id = Auth::guard('web')->user()->id;
        

        Review::insert([
            'user_id' => $user_id,
            'news_id' => $news_id,
            'comments' => $request->comments,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Review Will Approve By Admin',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function allPhotoGallery()
    {
        $photogalleries = PhotoGallery::latest()->get();
        return view('photo_gallery', compact('photogalleries'));
    }

    public function allVideoGallery()
    {
        $videogalleries = VideoGallery::latest()->get();
        return view('video_gallery', compact('videogalleries'));
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function contactUsPost(Request $request)
    {
        ContactUs::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comments' => $request->comments,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Contact Us Submitted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


}
