@extends('user.body.app')
@section('content')
@section('title')
    Reporter Wise News | Online Easy News
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="row">

                @foreach ($news as $item)
                    <div class="custom-col-6">
                        <div class="author-wrpp">
                            <div class="authorNews-image">

                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  "><img class="lazyload"
                                        src="{{ asset($item->image) }}"></a>
                            </div>
                            <div class="authorPage-content">
                                <h2 class="authorPage-title">
                                    <a
                                        href="{{ route('news-detail', [$item->id, $item->slug]) }}  ">{{ $item->title }}</a>
                                </h2>
                                <div class="author-date">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}  ">
                                        {{ $item->admin->name }}</a> <span> <i class="las la-clock"></i>
                                        {{ $item->created_at->format('l M d Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach




            </div>

        </div>
        <div class="col-lg-4 col-md-4">
            <div class="fixd-sitebar" style="position: sticky; top: 0;">
                <div class="authorPage-content"
                    style="background:
#fbf7f7; border: 2px solid
#e1dfdf; border-radius: 5px;">
                    <figure class="authorPage-image">
                        <img alt=""
                            src="{{ !empty($admin->image) ? url('storage/admin/' . $admin->image) : url('no_image.jpg') }}"
                            class="avatar avatar-96 photo" height="96" width="96" loading="lazy">
                    </figure>
                    <h1 class="authorPage-name">
                        <a href=" "> {{ $admin->name }} </a>
                    </h1>
                    <p class="text-center text-muted">{{ $admin->email }}</p>
                    <p class="text-center text-muted">{{ $admin->phone }}</p>
                    <p class="text-center text-muted">{{ $admin->address }}</p>


                    <div class="author-social">
                        <a href="{{ $admin->facebook }}" target="_black" title="Facebook"><i
                                class="lab la-facebook-f"></i></a>
                        <a href="{{ $admin->twitter }}" target="_black" title="Twitter"><i
                                class="lab la-twitter"></i></a>
                        <a href="{{ $admin->youtube }}" target="_black" title="Youtube"><i
                                class="lab la-youtube"></i></a>
                        <a href="{{ $admin->linkedin }}" target="_black" title="Linkedin"><i
                                class="lab la-linkedin-in"></i></a>
                        <a href="{{ $admin->instagram }}" target="_black" title="Instagram"><i
                                class="lab la-instagram"></i></a>
                    </div>
                    <div class="author-details" style="text-align:justify">


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
