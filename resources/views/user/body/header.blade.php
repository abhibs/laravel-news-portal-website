@php
    $cdate = new DateTime();
    $data = Auth::user();
    // dd($id);
@endphp

<header class="themesbazar_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="date">
                    <i class="lar la-calendar"></i>
                    {{ $cdate->format('l d-m-Y') }}
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <form class="header-search" action="{{ route('search-by-name') }} " method="post">
                    @csrf
                    <input type="text" name="search" placeholder=" Search Here ">
                    <button type="submit" value="Search"> <i class="las la-search"></i> </button>
                </form>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="header-social">
                    <ul>
                        {{-- <li> <a href="https://www.facebook.com/" target="_blank" title="facebook"><i
                                    class="lab la-facebook-f"></i> </a> </li>
                        <li><a href="https://twitter.com/" target="_blank" title="twitter"><i class="lab la-twitter">
                                </i> </a></li> --}}
                        @auth
                            <li><a href="{{ route('user-dashboard') }}"><b> {{ $data->name }} </b></a> </li>
                        @else
                            <li><a href="{{ route('user-login') }}"><b> Login </b></a> </li>
                            <li> <a href="{{ route('user-register') }}"> <b>Register</b> </a> </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="logo-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="logo">
                        <a href="{{ route('user-home') }}" title="NewsFlash">
                            <img src="{{ asset('user/assets/images/logo.png') }}" alt="NewsFlash" title="NewsFlash">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="banner">
                        <a href=" " target="_blank">

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</header>


<div class="menu_section sticky" id="myHeader">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="mobileLogo">
                    <a href=" " title="NewsFlash">
                        <img src="{{ asset('user/assets/images/footer_logo.gif') }}" alt="Logo" title="Logo">
                    </a>
                </div>
                <div class="stellarnav dark desktop"><a href="https://newssitedesign.com/newsflash/#"
                        class="menu-toggle full"><span class="bars"><span></span><span></span><span></span></span>
                    </a>
                    @php
                        $categories = App\Models\Category::orderBy('name', 'ASC')->get();
                        
                    @endphp
                    <ul id="menu-main-menu" class="menu">
                        <li id="menu-item-89"
                            class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-89">
                            <a href="{{ route('user-home') }}" aria-current="page"> <i
                                    class="fa-solid fa-house-user"></i> Home</a>
                        </li>

                        @foreach ($categories as $cat)
                            <li id="menu-item-291"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-291 has-sub">
                                <a href="{{ route('category-news', [$cat->id, $cat->slug]) }}">{{ $cat->name }}</a>
                                @php
                                    $subcategories = App\Models\Subcategory::where('category_id', $cat->id)
                                        ->orderBy('name', 'ASC')
                                        ->get();
                                @endphp
                                <ul class="sub-menu">
                                    @foreach ($subcategories as $subcat)
                                        <li id="menu-item-294"
                                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-294">
                                            <a
                                                href="{{ route('sub-category-news', [$subcat->id, $subcat->slug]) }}">{{ $subcat->name }}</a>
                                        </li>
                                    @endforeach



                                </ul>
                                <a class="dd-toggle" href=" "><span class="icon-plus"></span></a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
