@extends('frontend.dashboard.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <h3>User Dashboard</h3>
                    <br>
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class="col-xl-2 col-6 col-md-4">
                                    {{-- {{ route('user.orders.index') }} --}}
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Order</p>
                                        {{-- {{ $totalOrder }} --}}
                                        <h4 style="color:#ffff"></h4>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
