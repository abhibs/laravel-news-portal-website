@extends('user.body.app')
@section('content')

@section('title')
    Video Gallery | Online Easy News
@endsection
<div class="container">
    <div class="archive-info-cats">
        <a href="https://newssitedesign.com/newsflash/"><i class="la la-home"> </i> </a> <i
            class="la la-chevron-right"></i>
        Video Gallery
    </div>
    <div class="video-page-content">
        <div class="row">
            @foreach ($videogalleries as $item)
                <div class="themesBazar-4 themesBazar-m2">
                    <div class="video-page-wrpp">
                        <div class="video-page-image">
                            <img src="{{ asset($item->image) }}">
                            <a href="{{ $item->url }}" class="video-pageIcon popup"> <i class="las la-video"></i>
                            </a>
                        </div>
                        <div class="video-page-title">
                            <a href="{{ $item->url }}">{{ $item->title }} </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
