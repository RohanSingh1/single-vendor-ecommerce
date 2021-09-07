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
                                    <h4><i class="uil uil-location-point"></i>My Address</h4>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4>My Address</h4>
                                    </div>
                                    <div class="address-body">
                                        <a href="#" class="add-address hover-btn" data-toggle="modal" data-target="#address_model">Add New Address</a>

                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Home</h4>
                                                <p>{{ auth()->user()->address1 ?? 'Not Found' }}</p>
                                                <ul class="action-btns">
                                                    <li><a href="{{ route('front.editmyaddress') }}" class="action-btn"><i class="uil uil-edit"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Other</h4>
                                                <p>{{ auth()->user()->address2 ?? 'Not Found' }}</p>
                                                <ul class="action-btns">
                                                    <li><a href="{{ route('front.editmyaddress') }}" class="action-btn"><i class="uil uil-edit"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if($shipping_address)
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Current Shipping Address</h4>
                                                <p>Address Line 1{{ $shipping_address->address1 ?? 'Not Found' }}</p>
                                                <p>Address Line 2{{ $shipping_address->address2 ?? 'Not Found' }}</p>
                                                <ul class="action-btns">
                                                    <li><a href="{{ route('front.editmyaddress') }}" class="action-btn"><i class="uil uil-edit"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                        @if($billing_address)
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-home-alt"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>Current Billing Address</h4>
                                                <p>Address Line 1{{ $billing_address->address1 }}</p>
                                                <p>Address Line 2{{ $billing_address->address2 }}</p>
                                                <ul class="action-btns">
                                                    <li><a href="{{ route('front.editmyaddress') }}" class="action-btn"><i class="uil uil-edit"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
