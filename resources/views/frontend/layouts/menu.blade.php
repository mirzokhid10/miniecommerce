<?php

use App\Enums\UserRole;

?>

<!--============================
        MAIN MENU START
    ==============================-->
<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">

                        @foreach ($categories as $category)
                            <li>
                                <a class="wsus__droap_arrow" href="#">
                                    <i class="{{ $category->icon }}"></i> {{ $category->name }}
                                </a>

                                {{-- SUBCATEGORIES --}}
                                @if ($category->children->count() > 0)
                                    <ul class="wsus_menu_cat_droapdown">

                                        @foreach ($category->children as $sub)
                                            <li>
                                                <a href="#">
                                                    {{ $sub->name }}
                                                    @if ($sub->children->count() > 0)
                                                        <i class="fas fa-angle-right"></i>
                                                    @endif
                                                </a>

                                                {{-- CHILD CATEGORIES --}}
                                                @if ($sub->children->count() > 0)
                                                    <ul class="wsus__sub_category">

                                                        @foreach ($sub->children as $child)
                                                            <li>
                                                                <a href="#">{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                @endif

                                            </li>
                                        @endforeach

                                    </ul>
                                @endif

                            </li>
                        @endforeach

                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="active" href="index.html">home</a></li>

                        <li><a href="blog.html">blog</a></li>
                        <li><a href="track_order.html">track order</a></li>
                        <li><a href="daily_deals.html">daily deals</a></li>
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        <li><a href="contact.html">contact</a></li>
                        <li><a href="dsahboard.html">my account</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle p-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false">
                                {{ strtoupper(session('locale', 'en')) }}
                            </a>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item lh-sm" href="{{ route('lang.switch', 'uz') }}">O'zbekcha</a>
                                <a class="dropdown-item lh-sm" href="{{ route('lang.switch', 'en') }}">English</a>
                                <a class="dropdown-item lh-sm" href="{{ route('lang.switch', 'ru') }}">Русский</a>
                            </ul>
                        </li>


                        @auth
                            @if (auth()->user()->role === \App\Enums\UserRole::User)
                                <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                            @elseif (auth()->user()->role === \App\Enums\UserRole::Admin)
                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}">{{ __('app.login') }}</a></li>
                        @endauth

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!--============================
        MAIN MENU END
    ==============================-->

<!--============================
        MOBILE MENU START
    ==============================-->
<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        <li><a href="wishlist.html"><i class="far fa-heart"></i> <span>2</span></a></li>

        <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li>
    </ul>
    <form>
        <input type="text" placeholder="Search">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">

                    <ul class="wsus_menu_cat_item show_home toggle_menu">

                        @foreach ($categories as $category)
                            <li>
                                <a class="wsus__droap_arrow" href="#">
                                    <i class="{{ $category->icon }}"></i> {{ $category->name }}
                                </a>

                                {{-- SUBCATEGORIES --}}
                                @if ($category->children->count() > 0)
                                    <ul class="wsus_menu_cat_droapdown">

                                        @foreach ($category->children as $sub)
                                            <li>
                                                <a href="#">
                                                    {{ $sub->name }}
                                                    @if ($sub->children->count() > 0)
                                                        <i class="fas fa-angle-right"></i>
                                                    @endif
                                                </a>

                                                {{-- CHILD CATEGORIES --}}
                                                @if ($sub->children->count() > 0)
                                                    <ul class="wsus__sub_category">

                                                        @foreach ($sub->children as $child)
                                                            <li>
                                                                <a href="#">{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                @endif

                                            </li>
                                        @endforeach

                                    </ul>
                                @endif

                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="blog.html">blog</a></li>
                        <li><a href="track_order.html">track order</a></li>
                        <li><a href="daily_deals.html">daily deals</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        MOBILE MENU END
    ==============================-->
