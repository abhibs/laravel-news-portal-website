@php
    
    $datas = App\Models\News::where('status', 1)
        ->where('breaking_news', 1)
        ->inRandomOrder()
        ->get();
@endphp

<div class="top-scroll-section5">
    <div class="container">
        <div class="alert" role="alert">
            <div class="scroll-section5">
                <div class="row">
                    <div class="col-md-12 top_scroll2">
                        <div class="scroll5-left">
                            <div id="scroll5-left">
                                <span> Breaking News :: </span>
                            </div>
                        </div>
                        <div class="scroll5-right">
                            <marquee direction="left" scrollamount="15px" onmouseover="this.stop()"
                                onmouseout="this.start()">
                                @foreach ($datas as $item)
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                        <img src="{{ asset('user/assets/images/favicon.gif') }}" alt="Logo"
                                            title="Logo" width="30px" height="auto">
                                        {{ Str::limit($item->title, 50) }} </a>
                                @endforeach


                            </marquee>
                        </div>
                        <div class="scroolbar5">
                            <button data-bs-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
