@extends('user.body.app')
@section('content')
@section('title')
    Photo Gallery | Online Easy News
@endsection
<div class="container">
    <div class="archive-info-cats">
        <a href="https://newssitedesign.com/newsflash"><i class="la la-home"> </i> </a> <i class="la la-chevron-right"></i>
        Photo Gallery
    </div>
    <div class="photo-page-content">
        <div class="row">
            @foreach ($photogalleries as $item)
                <div class="themesBazar-4 themesBazar-m2">
                    <div class="photo-page-wrpp">
                        <div class="photo-page-image">
                            <a class="photo-pageIcon themesbazar" href="{{ asset($item->photo_gallery) }}"> <i
                                    class="las la-camera"></i>
                                <img src="{{ asset($item->photo_gallery) }}" alt="Photo one"></a>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
