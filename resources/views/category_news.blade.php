@extends('user.body.app')
@section('content')
@section('title')
    {{ $categoryName->name }} | Online Easy News
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="archive-topAdd">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="rachive-info-cats">
                <a href=" {{ route('user-home') }}"><i class="las la-home"></i> </a> <i class="las la-chevron-right"></i>
                {{ $categoryName->name }}
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="archive-shadow arch_margin">
                        <div class="archive1_image">
                            <a href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }} "><img
                                    class="lazyload" src="{{ asset($recentNews->image) }}"></a>
                            <div class="archive1-meta">
                                <a href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }} "><i
                                        class="la la-tags"> </i>
                                    {{ $recentNews->created_at->format('l M d Y') }}

                                </a>
                            </div>
                        </div>
                        <div class="archive1-padding">
                            <div class="archive1-title"><a
                                    href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }} ">{{ Str::limit($recentNews->title, 40) }}</a>
                            </div>
                            <div class="content-details"> <a
                                    href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }} ">
                                    Read More </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="row">
                        @foreach ($relatedTwoNews as $item)
                            <div class="archive1-custom-col-12">
                                <div class="archive-item-wrpp2">
                                    <div class="archive-shadow arch_margin">
                                        <div class="archive1_image2">
                                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }} "><img
                                                    class="lazyload" src="{{ asset($item->image) }}"></a>
                                            <div class="archive1-meta">
                                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }} "><i
                                                        class="la la-tags"> </i>
                                                    {{ $item->created_at->format('l M d Y') }}

                                                </a>
                                            </div>
                                        </div>
                                        <div class="archive1-padding">
                                            <div class="archive1-title2"><a
                                                    href="{{ route('news-detail', [$item->id, $item->slug]) }} ">{{ Str::limit($item->title, 18) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($otherNews as $item)
                    <div class="archive1-custom-col-3">
                        <div class="archive-item-wrpp2">
                            <div class="archive-shadow arch_margin">
                                <div class="archive1_image2">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  "><img
                                            class="lazyload" src="{{ asset($item->image) }}"></a>
                                    <div class="archive1-meta">
                                        <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  "><i
                                                class="la la-tags"> </i>
                                            {{ $item->created_at->format('l M d Y') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="archive1-padding">
                                    <div class="archive1-title2"><a
                                            href="{{ route('news-detail', [$item->id, $item->slug]) }}  ">{{ Str::limit($item->title, 18) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach









            </div>
            <div style="text-align: center;margin:50px;">
                {{ $otherNews->links() }}
            </div>


        </div>
        <div class="col-lg-4 col-md-4">
            <div class="sitebar-fixd" style="position: sticky; top: 0;">
                <div class="siteber-add">
                    <div class="themesBazar_widget">
                        <div class="textwidget">
                            <p><img loading="lazy" class="aligncenter size-full wp-image-74"
                                    src="{{ asset($banner->news_category_one) }}" alt="" width="100%"
                                    height="auto"></p>
                        </div>
                    </div>
                </div>
                <div class="archivePopular">
                    <ul class="nav nav-pills" id="archivePopular-tab" role="tablist">
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
@endsection
