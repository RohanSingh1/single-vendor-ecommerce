@extends('front.layouts.layout')

@section('content')
    @include('front.user.bread')
    <div class="">
        <div class="container">
            <div class="row">
                    @include('front.user.sidebar')
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-title-tab">
                                    <h4><i class="uil uil-apps"></i>Overview</h4>
                                </div>
                                <div class="welcome-text">
                                    <h2>Hi! {{ auth()->user()->name }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4>My Orders</h4>
                                    </div>
                                        @foreach ($data['my_orders'] as $order)
                                        @if ($loop->iteration == 3)
                                        @break
                                        @endif
                                        <div class="ddsh-body">
                                        <div class="smll-history">
                                            <div class="order-title">{{ $order->products->count()}} Items <span data-inverted=""
                                                data-tooltip="2kg broccoli, 1kg Apple"
                                                data-position="top center">?</span></div>
                                                <div class="order-status">{{ $order->status }}</div>
                                                <p>{{ $order->grand_totals }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    <a href="{{ route('front.myorders') }}" class="more-link14">All Orders <i
                                            class="uil uil-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
