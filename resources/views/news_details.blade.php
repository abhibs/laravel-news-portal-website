@extends('user.body.app')
@section('content')

@section('title')
    {{ $news->title }} | Online Easy News
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8">

            <div class="single-add">
            </div>

            <div class="single-cat-info">
                <div class="single-home">
                    <i class="la la-home"> </i><a href="{{ route('user-home') }}"> HOME </a>
                </div>
                <div class="single-cats">
                    <i class="la la-bars"></i> <a href=" " rel="category tag">{{ $news->category->name }}</a>
                    @if ($news->subcategory_id == null)
                    @else
                        ,
                        <a href=" " rel="category tag">{{ $news->subcategory->name }}</a>
                    @endif
                </div>
            </div>

            <h1 class="single-page-title">
                {{ $news->title }} </h1>
            <div class="row g-2">
                <div class="col-lg-1 col-md-2 ">
                    <div class="reportar-image">
                        <img
                            src="{{ !empty($news->admin->image) ? url('storage/admin/' . $news->admin->image) : url('no_image.jpg') }}">
                    </div>
                </div>
                <div class="col-lg-11 col-md-10">
                    <div class="reportar-title">
                        Posted By: <a href="{{ route('admin-news', $news->admin_id) }}">{{ $news->admin->name }}</a>
                    </div>
                    <div class="viwe-count">
                        <ul>
                            <li><i class="la la-clock-o"></i> Updated
                                {{ $news->created_at->format('l M d Y') }}

                            </li>
                            <li> / <i class="la la-eye"></i>
                                {{ $news->view_count }}
                                Read
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="single-image">
                <a href=" "><img class="lazyload" src="{{ asset($news->image) }}"></a>
                <h2 class="single-caption2">
                    {{ $news->title }}

                </h2>
            </div>

            <div class="single-page-add2">
                <div class="themesBazar_widget">
                    <div class="textwidget">
                        <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                                src="assets/images/biggapon-1.gif" alt="" width="100%" height="auto"></p>
                    </div>
                </div>
            </div>
            <button id="inc">A+</button>
            <button id="dec">A-</button>

            <news-font>
                <div class="single-details">
                    <p> {!! $news->details !!} </p>
                </div>
            </news-font>
            <div class="singlePage2-tag">
                <span> Tags : </span>
                @foreach ($tags_all as $tag)
                    <a href=" " rel="tag">{{ ucwords($tag) }}</a>
                @endforeach
            </div>

            <div class="single-add">
                <div class="themesBazar_widget">
                    <div class="textwidget">
                        <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                                src="{{ asset($banner->news_details_one) }}" alt="" width="100%"
                                height="auto"></p>
                    </div>
                </div>
            </div>

            <h3 class="single-social-title">
                Share News </h3>
            {{-- <div class="single-page-social">
                    <a href=" " target="_blank" title="Facebook"><i class="lab la-facebook-f"></i></a><a
                        href=" " target="_blank"><i class="lab la-twitter"></i></a><a href=" "
                        target="_blank"><i class="lab la-linkedin-in"></i></a><a href=" " target="_blank"><i
                            class="lab la-digg"></i></a><a href=" " target="_blank"><i
                            class="lab la-pinterest-p"></i></a><a onclick="printFunction()" target="_blank"><i
                            class="las la-print"></i>
                        <script>
                            function printFunction() {
                                window.print();
                            }
                        </script>
                    </a>
                </div> --}}
            <div class="addthis_inline_share_toolbox"></div>
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style mt-2 pb-2">
                <a class="a2a_button_whatsapp"
                    href="whatsapp://send?text={{ urlencode('News Project: ' . $news->title) }}%0A{{ urlencode(route('news-detail', [$news->id, $news->slug])) }}"></a>

                <a class="a2a_dd"></a>
            </div>

            @php
                $review = App\Models\Review::where('news_id', $news->id)
                    ->latest()
                    ->limit(5)
                    ->get();
            @endphp


            @foreach ($review as $item)
                @if ($item->status == 0)
                @else
                    <div class="author2">
                        <div class="author-content2">
                            <h6 class="author-caption2">
                                <span> COMMENTS </span>
                            </h6>
                            <div class="author-image2">
                                <img alt=""
                                    src="{{ !empty($item->user->image) ? url('storage/user/' . $item->user->image) : url('no_image.jpg') }} "
                                    class="avatar avatar-96 photo" height="96" width="96" loading="lazy">
                            </div>
                            <div class="authorContent">
                                <h1 class="author-name2">
                                    <a href=" "> {{ $item->user->name }} </a>
                                </h1>
                                <p> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </p>
                                <div class="author-details">{{ $item->comments }}</div>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach


            <hr>


            @guest
                <p><b> For Add News Review. You Need To Login First <a href="{{ route('user-login') }}"> Login Page</a>
                    </b>
                </p>
            @else
                <form action="{{ route('review-post') }}" method="post" class="wpcf7-form init"
                    enctype="multipart/form-data" novalidate="novalidate" data-status="init">
                    @csrf
                    <input type="hidden" name="id" value="{{ $news->id }}">

                    <div style="display: none;">

                    </div>
                    <div class="main_section">


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-title">
                                    Comments *
                                </div>
                                <div class="contact-form">
                                    <span class="wpcf7-form-control-wrap news_details">
                                        <textarea name="comments" cols="20" rows="5"
                                            class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false"
                                            placeholder="News Details...."></textarea>
                                    </span>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-btn">
                                <input type="submit" value="Submit Comments"
                                    class="wpcf7-form-control has-spinner wpcf7-submit"><span
                                    class="wpcf7-spinner"></span>
                            </div>
                        </div>
                    </div>

                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                </form>
            @endguest





            <div class="single_relatedCat">
                <a href=" ">Related News </a>
            </div>
            <div class="row">
                @foreach ($relatedNews as $item)
                    <div class="themesBazar-3 themesBazar-m2">
                        <div class="related-wrpp">
                            <div class="related-image">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img class="lazyload"
                                        src="{{ asset($item->image) }}"></a>
                            </div>
                            <h4 class="related-title">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}
                                </a>
                            </h4>
                            <div class="related-meta">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><i class="la la-tags">
                                    </i>
                                    {{ $item->created_at->format('l M d Y') }}

                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach








            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="sitebar-fixd" style="position: sticky; top: 0;">
                <div class="siteber-add">
                    <div class="themesBazar_widget">
                        <div class="textwidget">
                            <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                                    src="assets/images/biggapon-1.gif" alt="" width="100%" height="auto">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="singlePopular">
                    <ul class="nav nav-pills" id="singlePopular-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <div class="nav-link active" data-bs-toggle="pill" data-bs-target="#archiveTab_recent"
                                role="tab" aria-controls="archiveRecent" aria-selected="true"> LATEST </div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <div class="nav-link" data-bs-toggle="pill" data-bs-target="#archiveTab_popular"
                                role="tab" aria-controls="archivePopulars" aria-selected="false"> POPULAR </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContentarchive">
                    <div class="tab-pane fade active show" id="archiveTab_recent" role="tabpanel"
                        aria-labelledby="archiveRecent">

                        <div class="archiveTab-sibearNews">

                            @foreach ($newnewspost as $key => $item)
                                <div class="archive-tabWrpp archiveTab-border">
                                    <div class="archiveTab-image ">
                                        <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img
                                                class="lazyload" src="{{ asset($item->image) }}"></a>
                                    </div>
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"
                                        class="archiveTab-icon2"><i class="la la-play"></i></a>
                                    <h4 class="archiveTab_hadding"><a
                                            href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}
                                        </a>
                                    </h4>
                                    <div class="archive-conut">
                                        {{ $key + 1 }}
                                    </div>

                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="tab-pane fade" id="archiveTab_popular" role="tabpanel"
                        aria-labelledby="archivePopulars">
                        <div class="archiveTab-sibearNews">

                            @foreach ($newspopular as $key => $item)
                                <div class="archive-tabWrpp archiveTab-border">
                                    <div class="archiveTab-image ">
                                        <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"><img
                                                class="lazyload" src="{{ asset($item->image) }}"></a>
                                    </div>
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}"
                                        class="archiveTab-icon2"><i class="la la-play"></i></a>
                                    <h4 class="archiveTab_hadding"><a
                                            href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ Str::limit($item->title, 40) }}
                                        </a>
                                    </h4>
                                    <div class="archive-conut">
                                        {{ $key + 1 }}
                                    </div>

                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
                <div class="siteber-add2">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=example"></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<script type="text/javascript">
    var size = 16;

    function setFontSize(s) {
        size = s;
        $('news-font').css('font-size', '' + size + 'px');
    }

    function increaseFontSize() {
        setFontSize(size + 5);
    }

    function decreaseFontSize() {
        if (size > 5)
            setFontSize(size - 5);
    }

    $('#inc').click(increaseFontSize);
    $('#dec').click(decreaseFontSize);
    setFontSize(size);
</script>
@endsection
