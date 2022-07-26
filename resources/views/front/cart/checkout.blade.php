@extends('front.layouts.layout')

@push('css')
<link href="{{ asset('front/css/step-wizard.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<style>
    .delivery_note{
        font-size: 16px;
        font-weight: bold;
    }
    #valley{
        margin-top: 35px;
    }
</style>
@endpush
@section('content')
@php
$final = get_price_check_coupon();
@endphp
<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="all-product-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div id="checkout_wizard" class="checkout accordion left-chck145">
                    <div class="checkout-step">
                        <div class="checkout-card" id="headingOne">
                            {{--  <span class="checkout-step-number">1</span>  --}}
                            <h4 class="checkout-step-title">
                                <button class="wizard-btn" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Shipping Address</button>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse in show" data-parent="#checkout_wizard">
                            <div class="checkout-step-body">
                                <div class="otp-verifaction">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-0">

                                                <form action="{{ route('front.checkout.store') }}" method="post">
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
                                                                       class="form-control input-md"
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
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group" id="valley">
                                                                    <label class="control-label">From Valley*</label>
                                                                    <label class="control-label" for="inside">&nbsp;&nbsp;<input type="radio"  id="inside" name="from_valley" value="inside" required
                                                                        {{ isset($shipping_address) && $shipping_address->from_valley == 'inside' ? 'checked': ''  }}> Inside RingRoad</label>
                                                                    <label for="outside" class="control-label">
                                                                        &nbsp;&nbsp;  <input type="radio" name="from_valley" value="outside" required id="outside"
                                                                        {{ isset($shipping_address) && $shipping_address->from_valley == 'outside' ? 'checked': ''  }}> Outside RingRoad </label>
                                                                        @error('from_valley')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>

                                                            <div id="locations_li" class='col-sm-12 form-inline'>
                                                                @include('front.layouts.locations')
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Address*</label>
                                                                    <input id="s_address1" name="s_address1" type="text"
                                                                        placeholder="Address" value="{{ isset($shipping_address)
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
                                                                    <label class="control-label">LandMark*</label>
                                                                    <input id="s_address2" name="s_address2" type="text"
                                                                        placeholder="LandMark"  value="{{ isset($shipping_address)
                                                                            ? $shipping_address->address2 : old('s_address2') }} "
                                                                        class="form-control input-md">
                                                                        @error('s_address2')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
                                                            </div>


                                                            {{-- <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <div class="address-btns">
                                                                        <button class="save-btn14 hover-btn"
                                                                            type="submit">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>


                                                {{--  <a class="collapsed chck-btn hover-btn" role="button"
                                                    data-toggle="collapse" data-parent="#checkout_wizard"
                                                    href="#collapseTwo">Next</a>  --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  <div class="checkout-step">
                        <div class="checkout-card" id="headingTwo">
                            <span class="checkout-step-number">2</span>
                            <h4 class="checkout-step-title">
                                <button class="wizard-btn collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="{{ (Session::has('error')) ? 'true' : 'false' }}" aria-controls="collapseTwo">
                                    Billing Address</button>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#checkout_wizard">
                            <div class="checkout-step-body">
                                <div class="checout-address-step">
                                    <div class="row">
                                        <div class="col-lg-12">
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
                                                        <div class="form-group">
                                                            <input type="checkbox" class="same-as-shipping" id="sb">
                                                            <label class="control-label" for="sb"> Billing Address Same As Shipping Address </label>
                                                        </div>
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
                    </div>  --}}
                    <div class="checkout-step">
                            <div class="checkout-step-body">
                                <div class="payment_method-checkout">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="rpt100">
                                                <ul class="radio--group-inline-container_1">
                                                    <li>
                                                        <div class="radio-item_1">
                                                            <input id="cashondelivery1" value="cashondelivery"
                                                                name="paymentmethod" type="radio" data-minimum="50.0">
                                                            <label for="cashondelivery1" class="radio-label_1">Cash on
                                                                Delivery</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-item_1">
                                                            <input id="card1" value="card" name="paymentmethod"
                                                                type="radio" data-minimum="50.0">
                                                            <label for="card1" class="radio-label_1">Credit / Debit
                                                                Card</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="form-group return-departure-dts" data-method="cashondelivery">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="pymnt_title">
                                                            <h4>Cash on Delivery</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                                <textarea name="order_note" id="order_note" cols="75" rows="10" placeholder="Your Order Note Here"
                                                @if(isset($shipping_address) && $shipping_address->from_valley == 'outside') required @endif
                                                ></textarea>
                                                <br>
                                                <br>
                                                <div class="col-sm-12">
                                                    <div class="form-group d-flex">
                                                        <label for="delivery_date" class="control-label col-sm-2">Delivery Date</label>
                                                       <div class="col-sm-4">
                                                           <input type="date" name="delivery_date" required id='delivery_date' class="form-control">
                                                       </div>
                                                       <label for="delivery_time" class="control-label col-sm-2">Delivery Time</label>
                                                       <div class="col-sm-2">
                                                       <input type="time" name="delivery_time" required id="delivery_time" class=" width-100">
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="rpt100">
                                                    <ul class="radio--group-inline-container_1">


                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_condition" value="poleko" id="poleko">

                                                                <label for="poleko" class="radio-label_1">Poleko</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_condition" value="na_poleko" id="na_poleko">
                                                                <label for="na_poleko" class="radio-label_1">Na Poleko</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="rpt100">
                                                    <ul class="radio--group-inline-container_1">
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_state" value="with_skin" id="with_skin">

                                                                <label for="with_skin" class="radio-label_1">With Skin</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_state" value="without_skin" id="without_skin">

                                                                <label for="without_skin" class="radio-label_1">Without Skin</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @if(isset($shipping_address) && $shipping_address->from_valley == 'outside')
                                                    <span id="delivery_note">Note: Delivery Charges Cost per km {{ currency_type() }}.{{ get_general_settings_text('perkm_price') != ''
                                                        ?get_general_settings_text('perkm_price')->text:'' }}</span>
                                                @endif
                                                <br>
                                                <button class="next-btn16 hover-btn pull-right" type="submit">Place Order</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="pdpt-bg mt-0">
                    <div class="pdpt-title">
                        <h4>Order Summary</h4>
                    </div>
                    <div class="right-cart-dt-body">
                        @php $savings = 0; @endphp
                        @if (Cart::getContent()->count() > 0)
                            @foreach($cart as $key=>$cart_item)
                            <div class="cart-item border_radius">
                                <div class="cart-product-img">
                                    <img src="{{ product_image($cart_item->product) }}" alt="{{ $cart_item->product->name }}"
                                     alt="{{ $cart_item->product->name }}">
                                    {{-- <div class="offer-badge">{{ product_price($cart_item->product,'discount_percentage') }} %off</div> --}}
                                </div>
                                <div class="cart-text">
                                    <h4>{{$cart_item->product->name  }}</h4>
                                    <div class="cart-item-price">{{ product_price($cart_item->product,'new_price',true) }}
                                    @if($cart_item->product->old_price != '')
                                        <span>{{ product_price($cart_item->product,'old_price',true) }}</span>
                                    @endif
                                    </div>
                                    <button type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></button>
                                </div>
                            </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="total-checkout-group">
                        <div class="cart-total-dil pt-3">

                         @if(isset($_COOKIE['coupon_code']))
                         <form action="{{ route('front.removeCoupon') }}" method="POST">
                             @csrf
                             <input type="hidden" name="coupon_code" value="{{ $_COOKIE['coupon_code'] }}">
                           <span class="text-center" style="color:seagreen;font-weight: bolder">
                             Coupon Code ( {{ $_COOKIE['coupon_code'] }} ) Applied For Valid Products
                             <button class="btn btn-success btn-xs pull-right" type="submit" title="Remove Coupon" id="remove_coupon">
                             <i  class="uil uil-multiply"></i>
                             </button>
                           </span>
                         </form>
                         @else
                         <tr>
                             <form action="{{ route('front.apply_coupon') }}" method="POST">
                                @csrf
                                 <div class="form-inline">
                                     <input type="text" name="coupon_code" class="col-sm-9 form-control" placeholder="Enter Coupon code If Any">
                                     &nbsp
                                     <button type="submit" class="btn btn-success">Apply</button>
                                 </div>
                             </form>
                         </tr>

                         @endif

                        </div>
                    </div>
                    <div class="total-checkout-group">
                        <div class="cart-total-dil pt-3">
                            <h4>Subtotal</h4>
                            <span> {{ currency_type().\Cart::getSubTotal() }}</span>
                        </div>
                    </div>
                    <div class="total-checkout-group">
                        @if(isset($shipping_address) && $shipping_address->from_valley == 'outside')
                        <div class="cart-total-dil pt-3">
                            <h4>Delivery Charges</h4>
                            <span>+ {{ currency_type().$delivery_price }}</span>
                        </div>
                        @endif
                    </div>
                    @if(isset($_COOKIE['coupon_code']))
                    <div class="cart-total-dil saving-total ">
                        <h4>Total Coupon Discount</h4>
                        <span>- {{ currency_type().$final['coupon_discount_total'] }}</span>
                    </div>
                    @endif

                    <div class="main-total-cart">
                        <h2>Total</h2>
                        @if(isset($shipping_address) && $shipping_address->from_valley == 'outside')
                        <span>{{currency_type().' '.$final['total'] }}</span>
                        @else
                        <span> {{ currency_type() }} {{$final['total']-(int)$delivery_price }}</span>
                        @endif
                    </div>

                </div>
                <div class="checkout-safety-alerts">
                    <p><i class="uil uil-sync"></i>100% Replacement Guarantee</p>
                    <p><i class="uil uil-check-square"></i>100% Genuine Products</p>
                    <p><i class="uil uil-shield-check"></i>Secure Payments</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('front/js/offset_overlay.js') }}"></script>
<script>
    $('.same-as-shipping').click(function(){
     if ($('.same-as-shipping').is(":checked")) {
      $('#b_full_name').val($('#s_full_name').val());
      $('#b_email').val($('#s_email').val());
      $('#b_phone').val($('#s_phone').val());
      $('#b_address1').val($('#s_address1').val());
      $('#b_address2').val($('#s_address2').val());
     } else { //Clear on uncheck
      $('#b_full_name').val("");
      $('#b_email').val("");
      $('#b_phone').val("");
      $('#b_address1').val("");
      $('#b_address2').val("");
     };
    });

    $(document).ready(function () {
        $('#locations_li').on('change', '#province_id', function () {
            var selected_province_id = $('#province_id').val();
            $.ajax({
                method: 'POST',
                url: '{{ route('getDistrictNLocalLevel') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    selected_province_id: selected_province_id
                },
                beforeSend: function () {
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#locations_li').html(' ');
                        $('#locations_li').html(data.html);
                        $.LoadingOverlay("hide");
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            })
        });
        $('#locations_li').on('change', '#district_id', function () {
            var selected_district_id = $('#district_id').val();
            var selected_province_id = $('#province_id').val();
            $.ajax({
                method: 'POST',
                url: '{{ route('getDistrictNLocalLevel') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    selected_district_id: selected_district_id,
                    selected_province_id: selected_province_id
                },
                beforeSend: function () {
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#locations_li').html(' ');
                        $('#locations_li').html(data.html);
                        $.LoadingOverlay("hide");
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            })
        })
    });



</script>
@endpush
