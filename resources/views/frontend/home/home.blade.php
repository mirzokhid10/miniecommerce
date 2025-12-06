@extends('frontend.layouts.master')
@section('title')
    e-Commerce HTML Template
@endsection

@section('content')
    {{-- <!--============================
        BANNER PART 2 START
    ==============================--> --}}

    @include('frontend.home.sections.banner-slider')

    {{-- <!--============================
        BANNER PART 2 END
    ==============================--> --}}


    {{-- <!--============================
        FLASH SELL START
    ==============================--> --}}
    @include('frontend.home.sections.flash-sale')
    {{-- <!--============================
        FLASH SELL END
    ==============================--> --}}


    {{-- <!--============================
        MONTHLY TOP PRODUCT START
    ==============================--> --}}
    @include('frontend.home.sections.top-category-product')
    {{-- <!--============================
        MONTHLY TOP PRODUCT END
    ==============================--> --}}

    {{-- <!--============================
        HOME BLOGS START
    ==============================--> --}}
    @include('frontend.home.sections.blog')
    {{-- <!--============================
        HOME BLOGS END
    ==============================--> --}}
@endsection
