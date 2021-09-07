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
                                    <h4><i class="uil uil-location-point"></i>My Shipping Address</h4>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h4>My Shipping Address</h4>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="" action="{{ route('front.updateAddress') }}" method="POST">
                                                    @csrf
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="address-fieldset">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Name*</label>
                                                                    <input id="name" name="name" type="text"
                                                                        placeholder="Name" class="form-control input-md"
                                                                        required="" value="{{ auth()->user()->name ?? old('name') }}">
                                                                        @error('name')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Phone Contact*</label>
                                                                    <input name="phone_no" type="text" id="phone_no"
                                                                        placeholder="Enter Contact No" value="{{ auth()->user()->phone_no ?? old('phone_no') }} "
                                                                        class="form-control input-md" required="">
                                                                        @error('phone_no')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Address*</label>
                                                                    <input id="s_address1" name="address_1" type="text"
                                                                        placeholder="Address" value="{{  auth()->user()->address_1 ?? old('address_1')  }} "
                                                                        class="form-control input-md" required="">
                                                                        @error('address1')
                                                                            <span class="alert alert-danger">
                                                                            {{ $message }}</span>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Street Address*</label>
                                                                    <input id="address2" name="address_2" type="text"
                                                                        placeholder="Street Address"  value="{{  auth()->user()->address_2 ?? old('address_2')  }}"
                                                                        class="form-control input-md">
                                                                        @error('address2')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>



                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <div class="address-btns">
                                                                        <button class="save-btn14 hover-btn"
                                                                            type="submit">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pdpt-title">
                                        <h4>My Shipping Address</h4>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="" action="{{ route('front.addShippingAddress') }}" method="POST">
                                                    @csrf
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="address-fieldset">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Name*</label>
                                                                    <input id="s_full_name" name="s_full_name" type="text"
                                                                        placeholder="Name" class="form-control input-md"
                                                                        required="" value="{{ isset($shipping_address)
                                                                        ? $shipping_address->full_name : old('s_full_name') }}">
                                                                        @error('s_full_name')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Email Address*</label>
                                                                    <input id="s_email" name="s_email" type="text"
                                                                        placeholder="Email Address" value="{{ isset($shipping_address)
                                                                            ? $shipping_address->email : old('s_email') }} "
                                                                        class="form-control input-md" required="">
                                                                        @error('s_email')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Contact*</label>
                                                                    <input name="s_phone" type="text" id="s_phone"
                                                                        placeholder="Enter Contact No" value="{{ isset($shipping_address)
                                                                            ? $shipping_address->phone : old('s_phone') }} "
                                                                        class="form-control input-md" required="">
                                                                        @error('s_phone')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Address*</label>
                                                                    <input id="s_address1" name="s_address1" type="text"
                                                                        placeholder="Address"   value="{{ isset($shipping_address)
                                                                            ? $shipping_address->address1 : old('s_address1') }} "
                                                                        class="form-control input-md" required="">
                                                                        @error('address1')
                                                                            <span class="alert alert-danger">
                                                                            {{ $message }}</span>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Street Address*</label>
                                                                    <input id="s_address2" name="s_address2" type="text"
                                                                        placeholder="Street Address"  value="{{ isset($shipping_address)
                                                                            ? $shipping_address->address2 : old('s_address2') }} "
                                                                        class="form-control input-md">
                                                                        @error('s_address2')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>



                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <div class="address-btns">
                                                                        <button class="save-btn14 hover-btn"
                                                                            type="submit">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pdpt-title">
                                        <h4>My Billing Address</h4>
                                    </div>

                                    <div class="address-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form class="" action="{{ route('front.addBillingAddress') }}" method="POST">
                                                        @csrf
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="address-fieldset">
                                                            <div class="row">

                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Name*</label>
                                                                        <input id="b_full_name" name="b_full_name" type="text"
                                                                            placeholder="Name" class="form-control input-md"
                                                                            required=""  value="{{ isset($billing_address)
                                                                                ? $billing_address->full_name : old('b_full_name') }} ">
                                                                            @error('b_full_name')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Email Address*</label>
                                                                        <input id="b_email" name="b_email" type="text"
                                                                            placeholder="Email Address" value="{{ isset($billing_address)
                                                                                ? $billing_address->email : old('b_email') }} "
                                                                            class="form-control input-md" required="">
                                                                            @error('b_email')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Contact*</label>
                                                                        <input name="b_phone" type="text" id="b_phone"
                                                                            placeholder="Enter Contact No" value="{{ isset($billing_address)
                                                                                ? $billing_address->phone : old('b_phone') }} "
                                                                            class="form-control input-md" required="">
                                                                            @error('b_phone')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Address*</label>
                                                                        <input id="b_address1" name="b_address1" type="text"
                                                                            placeholder="Address" value="{{ isset($billing_address)
                                                                                ? $billing_address->address1 : old('b_address1') }} "
                                                                            class="form-control input-md" required="">
                                                                            @error('address1')
                                                                                <span class="alert alert-danger">
                                                                                {{ $message }}</span>
                                                                            @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Street Address*</label>
                                                                        <input id="b_address2" name="b_address2" type="text"
                                                                            placeholder="Street Address" value="{{ isset($billing_address)
                                                                                ? $billing_address->address2 : old('b_address2') }} "
                                                                            class="form-control input-md">
                                                                            @error('b_address2')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="address-btns">
                                                                            <button class="save-btn14 hover-btn"
                                                                                type="submit">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



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
