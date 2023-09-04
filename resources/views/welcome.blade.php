@extends('user.body.app')
@section('content')

@section('title')
    Home Page | Online Easy News
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">

        </div>
    </div>
</div>

<section class="themesBazar_section_one">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="themesbazar_led_active owl-carousel owl-loaded owl-drag">



                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(-1578px, 0px, 0px); transition: all 1s ease 0s; width: 3684px;">
                                    @foreach ($news_slider_datas as $item)
                                        <div class="owl-item" style="width: 506.25px; margin-right: 20px;">
                                            <div class="secOne_newsContent">
                                                <div class="sec-one-image">
                                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img
                                                            class="lazyload" src="{{ asset($item->image) }}"></a>
                                                    <h6 class="sec-small-cat">
                                                        <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                                            {{ $item->created_at->format('M d Y') }}

                                                        </a>
                                                    </h6>
                                                    <h1 class="sec-one-title">
                                                        <a
                                                            href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ $item->title }}</a>
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i
                                        class="fa-solid fa-angle-left"></i></button>
                                <button type="button" role="presentation" class="owl-next"><i
                                        class="fa-solid fa-angle-right"></i></button>
                            </div>
                            <div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button
                                    role="button" class="owl-dot active"><span></span></button><button role="button"
                                    class="owl-dot"><span></span></button></div>
                        </div>


                    </div>
                    <div class="col-lg-5 col-md-5">

                        @foreach ($section_three_datas as $item)
                            <div class="secOne-smallItem">
                                <div class="secOne-smallImg">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }} "><img
                                            class="lazyload" src="{{ asset($item->image) }}"></a>
                                    <h5 class="secOne_smallTitle">
                                        <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
                <div class="sec-one-item2">
                    <div class="row">
                        @foreach ($section_nine_datas as $item)
                            <div class="themesBazar-3 themesBazar-m2">
                                <div class="sec-one-wrpp2">
                                    <div class="secOne-news">
                                        <div class="secOne-image2">
                                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }} "><img
                                                    class="lazyload" src="{{ asset($item->image) }}"></a>
                                        </div>
                                        <h4 class="secOne-title2">
                                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="cat-meta">
                                        <a href="{{ route('news-detail', [$item->id, $item->slug]) }} "> <i
                                                class="lar la-newspaper"></i>
                                            {{ $item->created_at->format('M d Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="live-item">
                    <div class="live_title">
                        <a href=" ">LIVE TV </a>
                        <div class="themesBazar"></div>
                    </div>
                    <div class="popup-wrpp">
                        <div class="live_image">
                            <img width="700" height="400" src="{{ asset($livetv->image) }}"
                                class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                loading="lazy">
                            <div data-mfp-src="#mymodal" class="live-icon modal-live"> <i class="las la-play"></i>
                            </div>
                        </div>
                        <div class="live-popup">
                            <div id="mymodal" class="mfp-hide" role="dialog" aria-labelledby="modal-titles"
                                aria-describedby="modal-contents">
                                <div id="modal-contents">
                                    <div class="embed-responsive embed-responsive-16by9 embed-responsive-item">
                                        <iframe class="" src="{{ $livetv->url }}"
                                            allowfullscreen="allowfullscreen" width="100%" height="400px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="themesBazar_widget">
                    <h3 style="margin-top:5px"> OLD NEWS </h3>
                </div>
                <form class="wordpress-date" action="{{ route('search-by-date') }}" method="post">
                    @csrf
                    <input type="date" placeholder="Select Date" autocomplete="off" value="" name="m"
                        class="hasDatepicker">
                    <input type="submit" value="Search">
                </form>
                <div class="recentPopular">
                    <ul class="nav nav-pills" id="recentPopular-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <div class="nav-link active" id="recent-tab" data-bs-toggle="pill"
                                data-bs-target="#recent" role="tab" aria-controls="recent"
                                aria-selected="false"> LATEST </div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <div class="nav-link" id="popular-tab" data-bs-toggle="pill" data-bs-target="#popular"
                                role="tab" aria-controls="popular" aria-selected="false"> POPULAR </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane active show  fade" id="recent" role="tabpanel" aria-labelledby="recent">
                        <div class="news-titletab">
                            @foreach ($newnewspost as $item)
                                <div class="tab-image tab-border">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img
                                            class="lazyload" src="{{ asset($item->image) }}"></a>
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"
                                        class="tab-icon"><i class="la la-play"></i></a>
                                    <h4 class="tab_hadding"><a
                                            href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}
                                        </a>
                                    </h4>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="tab-pane fade" id="popular" role="tabpanel" aria-labelledby="popular">
                        <div class="news-titletab">
                            @foreach ($newspopular as $item)
                                <div class="tab-image tab-border">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img
                                            class="lazyload" src="{{ asset($item->image) }}"></a>
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"
                                        class="tab-icon"><i class="la la-play"></i></a>
                                    <h4 class="tab_hadding"><a
                                            href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}</a>
                                    </h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="themesBazar_widget">
                <div class="textwidget">
                    <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                            src="{{ asset($banners->home_one) }}" alt="" width="100%" height="auto"></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="themesBazar_widget">
                <div class="textwidget">
                    <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                            src="{{ asset($banners->home_two) }}" alt="" width="100%" height="auto"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $news = App\Models\News::where('status', 1)
        ->inRandomOrder()
        ->get();
    $categories = App\Models\Category::orderBy('name', 'ASC')->get();
    
@endphp
<section class="section-two">
    <div class="container">
        <div class="secTwo-color">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="themesBazar_cat6">
                        <ul class="nav nav-pills" id="categori-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <div class="nav-link active" id="categori-tab1" data-bs-toggle="pill"
                                    data-bs-target="#Info-tabs1" role="tab" aria-controls="Info-tabs1"
                                    aria-selected="true">
                                    ALL
                                </div>
                            </li>

                            @foreach ($categories as $category)
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link" id="categori-tab2" data-bs-toggle="pill"
                                        data-bs-target="#category{{ $category->id }}" role="tab"
                                        aria-controls="Info-tabs2" aria-selected="false">
                                        {{ $category->name }} </div>
                                </li>
                            @endforeach

                            <span class="themeBazar6"></span>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="Info-tabs1" role="tabpanel"
                            aria-labelledby="categori-tab1 ">
                            <div class="row">

                                @foreach ($news as $item)
                                    <div class="themesBazar-4 themesBazar-m2">
                                        <div class="sec-two-wrpp">
                                            <div class="section-two-image">

                                                <a href=" "><img class="lazyload"
                                                        src="{{ asset($item->image) }}"></a>
                                            </div>
                                            <h5 class="sec-two-title">
                                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }} ">{{ $item->title }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach





                            </div>
                        </div>


                        @foreach ($categories as $category)
                            <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel"
                                aria-labelledby="categori-tab2">
                                <div class="row">

                                    @php
                                        $catwiseNews = App\Models\News::where('category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->get();
                                    @endphp

                                    @foreach ($catwiseNews as $item)
                                        <div class="themesBazar-4 themesBazar-m2">
                                            <div class="sec-two-wrpp">
                                                <div class="section-two-image">
                                                    <a href=" {{ route('news-detail', [$item->id, $item->slug]) }}  "><img
                                                            class="lazyload" src="{{ asset($item->image) }}"></a>
                                                </div>
                                                <h5 class="sec-two-title">
                                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  ">{{ $item->title }}
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="themesBazar_widget">
                <div class="textwidget">
                    <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                            src="{{ asset($banners->home_three) }}" alt="" width="100%" height="auto">
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="themesBazar_widget">
                <div class="textwidget">
                    <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                            src="{{ asset($banners->home_four) }}" alt="" width="100%" height="auto">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section-three">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="themesBazar_cat07"> <a
                        href=" {{ route('category-news', [$politicalCategory->id, $politicalCategory->slug]) }}"> <i
                            class="las la-align-justify"></i>
                        {{ $politicalCategory->name }} </a>
                    @if (@$politicalSubCategory)
                        @foreach ($politicalSubCategory as $item)
                            >
                            <a href="{{ route('sub-category-news', [$item->id, $item->slug]) }} ">
                                {{ $item->name }} </a>
                        @endforeach
                    @else
                    @endif
                </h2>

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="secThree-bg">
                            <div class="sec-theee-image">
                                <a href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }}"><img
                                        class="lazyload" src="{{ asset($recentNews->image) }}"></a>
                            </div>
                            <h4 class="secThree-title">
                                <a href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }}">
                                    {{ $recentNews->title }} </a>
                            </h4>
                        </div>
                        <div class="row">
                            @foreach ($relatedTwoNews as $item)
                                <div class="themesBazar-2 themesBazar-m2">
                                    <div class="secThree-wrpp">
                                        <div class="sec-theee-image2">
                                            <a href=" {{ route('news-detail', [$item->id, $item->slug]) }} "><img
                                                    class="lazyload" src="{{ asset($item->image) }}"></a>
                                        </div>
                                        <h4 class="secThree-title2">
                                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }} ">
                                                {{ $item->title }} </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="bg2">
                            @foreach ($relatedFiveNews as $item)
                                <div class="secThree-smallItem">
                                    <div class="secThree-smallImg">
                                        <a href=" {{ route('news-detail', [$item->id, $item->slug]) }} "><img
                                                class="lazyload" src="{{ asset($item->image) }}"></a>
                                        <a href=" {{ route('news-detail', [$item->id, $item->slug]) }} "
                                            class="small-icon3"><i class="la la-play"></i></a>
                                        <h5 class="secOne_smallTitle">
                                            <a href=" {{ route('news-detail', [$item->id, $item->slug]) }} ">
                                                {{ $item->title }} </a>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>



<section class="section-four">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="themesBazar_cat04"> <a
                        href="{{ route('category-news', [$entertainmentCategory->id, $entertainmentCategory->slug]) }} ">
                        <i class="las la-align-justify"></i>
                        {{ $entertainmentCategory->name }} </a>
                    @if (@$entertainmentSubCategory)
                        @foreach ($entertainmentSubCategory as $item)
                            >
                            <a href="{{ route('sub-category-news', [$item->id, $item->slug]) }}">
                                {{ $item->name }} </a>
                        @endforeach
                    @else
                    @endif
                </h2>

                <div class="secFour-slider owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(-3294px, 0px, 0px); transition: all 1s ease 0s; width: 4792px;">
                            @foreach ($entertaimentAllNews as $item)
                                <div class="owl-item" style="width: 289.5px; margin-right: 10px;">
                                    <div class="secFour-wrpp ">
                                        <div class="secFour-image">
                                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img
                                                    class="lazyload" src="{{ asset($item->image) }}"></a>
                                            <h5 class="secFour-title">
                                                <a
                                                    href="{{ route('news-detail', [$item->id, $item->slug]) }} ">{{ Str::limit($item->title, 40) }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i
                                class="las la-angle-left"></i></button><button type="button" role="presentation"
                            class="owl-next"><i class="las la-angle-right"></i></button></div>
                    <div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button
                            role="button" class="owl-dot active"><span></span></button></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-five">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">

                <h2 class="themesBazar_cat01"> <a
                        href="{{ route('category-news', [$automobilesCategory->id, $automobilesCategory->slug]) }} ">
                        {{ $automobilesCategory->name }} </a>
                    @if (@$automobilesSubCategory)
                        @foreach ($automobilesSubCategory as $item)
                            >
                            <a href=" {{ route('sub-category-news', [$item->id, $item->slug]) }} ">
                                {{ $item->name }} </a>
                        @endforeach
                    @else
                    @endif
                </h2>

                <div class="white-bg">
                    <div class="secFive-image">
                        <a
                            href=" {{ route('news-detail', [$recentAutomobilesNews->id, $recentAutomobilesNews->slug]) }}"><img
                                class="lazyload" src="{{ asset($recentAutomobilesNews->image) }}"></a>
                        <div class="secFive-title">
                            <a
                                href="{{ route('news-detail', [$recentAutomobilesNews->id, $recentAutomobilesNews->slug]) }} ">{{ Str::limit($recentAutomobilesNews->title, 40) }}
                            </a>
                        </div>
                    </div>

                    @foreach ($relatedAutomobilesNews as $item)
                        <div class="secFive-smallItem">
                            <div class="secFive-smallImg">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }} "><img class="lazyload"
                                        src="{{ asset($item->image) }}"></a>
                                <h5 class="secFive_title2">
                                    <a
                                        href="{{ route('news-detail', [$item->id, $item->slug]) }} ">{{ Str::limit($item->title, 40) }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <div class="col-lg-4 col-md-4">

                <h2 class="themesBazar_cat01"> <a
                        href="{{ route('category-news', [$crimeCategory->id, $crimeCategory->slug]) }} ">
                        {{ $crimeCategory->name }} </a>
                    @if (@$crimeSubCategory)
                        @foreach ($crimeSubCategory as $item)
                            >
                            <a href=" {{ route('sub-category-news', [$item->id, $item->slug]) }} ">
                                {{ $item->name }} </a>
                        @endforeach
                    @else
                    @endif
                </h2>

                <div class="white-bg">
                    <div class="secFive-image">
                        <a href=" {{ route('news-detail', [$recentCrimeNews->id, $recentCrimeNews->slug]) }} "><img
                                class="lazyload" src="{{ asset($recentCrimeNews->image) }}"></a>
                        <div class="secFive-title">
                            <a href=" {{ route('news-detail', [$recentCrimeNews->id, $recentCrimeNews->slug]) }} ">
                                {{ Str::limit($recentCrimeNews->title, 40) }} </a>
                        </div>
                    </div>
                    @foreach ($relatedCrimeNews as $item)
                        <div class="secFive-smallItem">
                            <div class="secFive-smallImg">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  "><img
                                        class="lazyload" src="{{ asset($item->image) }}"></a>
                                <h5 class="secFive_title2">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  ">
                                        {{ Str::limit($item->title, 40) }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <div class="col-lg-4 col-md-4">

                <h2 class="themesBazar_cat01"> <a
                        href=" {{ route('category-news', [$healthCategory->id, $healthCategory->slug]) }}">
                        {{ $healthCategory->name }} </a>
                    @if (@$healthSubCategory)
                        @foreach ($healthSubCategory as $item)
                            >
                            <a href=" {{ route('sub-category-news', [$item->id, $item->slug]) }} ">
                                {{ $item->name }} </a>
                        @endforeach
                    @else
                    @endif
                </h2>

                <div class="white-bg">
                    <div class="secFive-image">
                        <a href=" "><img class="lazyload" src="{{ asset($recentHealthNews->image) }}"></a>
                        <div class="secFive-title">
                            <a href="{{ route('news-detail', [$recentHealthNews->id, $recentHealthNews->slug]) }} ">
                                {{ Str::limit($recentHealthNews->title, 40) }} </a>
                        </div>
                    </div>
                    @foreach ($relatedHealthNews as $item)
                        <div class="secFive-smallItem">
                            <div class="secFive-smallImg">
                                <a href=" {{ route('news-detail', [$item->id, $item->slug]) }}"><img class="lazyload"
                                        src="{{ asset($item->image) }}"></a>
                                <h5 class="secFive_title2">
                                    <a href=" {{ route('news-detail', [$item->id, $item->slug]) }}">
                                        {{ Str::limit($item->title, 40) }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-seven">
    <div class="container">

        <h2 class="themesBazar_cat01"> <a
                href="{{ route('category-news', [$sportsCategory->id, $sportsCategory->slug]) }} ">
                {{ $sportsCategory->name }} </a>
            @if (@$sportsSubCategory)
                @foreach ($sportsSubCategory as $item)
                    > <a href=" {{ route('sub-category-news', [$item->id, $item->slug]) }} ">
                        {{ $item->name }} </a>
                @endforeach
            @else
            @endif
        </h2>

        <div class="secSecven-color">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="black-bg">
                        <div class="secSeven-image">
                            <a href="{{ route('news-detail', [$recentSportsNews->id, $recentSportsNews->slug]) }} "><img
                                    class="lazyload" src="{{ asset($recentSportsNews->image) }}"></a>
                            <a href="{{ route('news-detail', [$recentSportsNews->id, $recentSportsNews->slug]) }} "
                                class="video-icon6"><i class="la la-play"></i></a>
                        </div>
                        <h6 class="secSeven-title">
                            <a href="{{ route('news-detail', [$recentSportsNews->id, $recentSportsNews->slug]) }} ">{{ $recentSportsNews->title }}
                            </a>
                        </h6>

                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="row">
                        @foreach ($relatedSportsNews as $item)
                            <div class="themesBazar-2 themesBazar-m2">
                                <div class="secSeven-wrpp ">
                                    <div class="secSeven-image2">
                                        <a href=" {{ route('news-detail', [$item->id, $item->slug]) }} "><img
                                                class="lazyload" src="{{ asset($item->image) }}"></a>
                                        <h5 class="secSeven-title2">
                                            <a
                                                href=" {{ route('news-detail', [$item->id, $item->slug]) }} ">{{ $item->title }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-ten">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">

                <h2 class="themesBazar_cat01"> <a href=" "> <i class="las la-camera"></i> PHOTO
                        GALLERY </a></h2>

                <div class="homeGallery owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(-4764px, 0px, 0px); transition: all 1s ease 0s; width: 5558px;">
                            @foreach ($photogalleries as $item)
                                <div class="owl-item" style="width: 784px; margin-right: 10px;">
                                    <div class="item">
                                        <div class="photo">
                                            <a class="themeGallery" href="{{ asset($item->photo_gallery) }}">
                                                <img src="{{ asset($item->photo_gallery) }}" alt="PHOTO"></a>
                                            <h3 class="photoCaption">
                                                <a href=" "> {{ $item->post_date }} </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i
                                class="las la-angle-left"></i></button><button type="button" role="presentation"
                            class="owl-next disabled"><i class="las la-angle-right"></i></button></div>
                    <div class="owl-dots disabled"></div>
                </div>
                <div class="homeGallery1 owl-carousel owl-loaded owl-drag">







                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transition: all 1s ease 0s; width: 2515px; transform: translate3d(-463px, 0px, 0px);">
                            @foreach ($photogalleries1 as $item)
                                <div class="owl-item" style="width: 122.333px; margin-right: 10px;">
                                    <div class="item">
                                        <div class="phtot2">
                                            <a class="themeGallery" href="{{ asset($item->photo_gallery) }}">
                                                <img src="{{ asset($item->photo_gallery) }}" alt="PHOTO"></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                                aria-label="Previous">‹</span></button><button type="button" role="presentation"
                            class="owl-next"><span aria-label="Next">›</span></button></div>
                    <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                            role="button" class="owl-dot"><span></span></button><button role="button"
                            class="owl-dot"><span></span></button><button role="button"
                            class="owl-dot"><span></span></button><button role="button"
                            class="owl-dot"><span></span></button><button role="button"
                            class="owl-dot"><span></span></button><button role="button"
                            class="owl-dot"><span></span></button></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">

                <h2 class="themesBazar_cat01"> <a href=" "> <i class="las la-video"></i> VIDEO
                        GALLERY </a></h2>

                <div class="white-bg">
                    @foreach ($videogalleries as $item)
                        <div class="secFive-smallItem">
                            <div class="secFive-smallImg">
                                <img src="{{ asset($item->image) }}">
                                <a href="{{ $item->url }}" class="home-video-icon popup"><i
                                        class="las la-video"></i></a>
                                <h5 class="secFive_title2">
                                    <a href="{{ $item->url }}" class="popup">
                                        {{ $item->title }} </a>
                                </h5>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
@endsection
