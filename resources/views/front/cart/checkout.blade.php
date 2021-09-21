@extends('front.layouts.layout')

@push('css')
<link href="{{ asset('front/css/step-wizard.css') }}" rel="stylesheet">
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
                            <span class="checkout-step-number">1</span>
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

                                                <a class="collapsed chck-btn hover-btn" role="button"
                                                    data-toggle="collapse" data-parent="#checkout_wizard"
                                                    href="#collapseTwo">Next</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-step">
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
                    </div>
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
                                                            <p>Cash on Delivery will not be available if your order
                                                                value exceeds $10.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('front.checkout.store') }}" method="post">
                                                @csrf
                                                <textarea name="order_note" id="order_note" cols="75" rows="10" required
                                                placeholder="Your Order Note Here"></textarea>
                                                <br>
                                                <br>
                                                <div class="rpt100">
                                                    <ul class="radio--group-inline-container_1">
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_condition" value="poleko" required id="poleko">

                                                                <label for="poleko" class="radio-label_1">Poleko</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_condition" value="na_poleko" required id="na_poleko">
                                                                <label for="na_poleko" class="radio-label_1">Na Poleko</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="rpt100">
                                                    <ul class="radio--group-inline-container_1">
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_state" value="with_skin" required id="with_skin">

                                                                <label for="with_skin" class="radio-label_1">With Skin</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="radio-item_1">
                                                                <input type="radio" name="meat_state" value="without_skin" required id="without_skin">

                                                                <label for="without_skin" class="radio-label_1">Without Skin</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                    <br>


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
                            @php
                            $savings += product_price($cart_item->product,'discount_prices')*$cart_item->quantity;
                            @endphp
                            <div class="cart-item border_radius">
                                <div class="cart-product-img">
                                    <img src="{{ product_image($cart_item->product) }}" alt="{{ $cart_item->product->name }}"
                                     alt="{{ $cart_item->product->name }}">
                                    <div class="offer-badge">4% OFF</div>
                                </div>
                                <div class="cart-text">
                                    <h4>{{$cart_item->product->name  }}</h4>
                                    <div class="cart-item-price">{{ product_price($cart_item->product,'new_price',true) }}
                                         <span>{{ product_price($cart_item->product,'old_price',true) }}</span></div>
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
                        <div class="cart-total-dil pt-3">
                            <h4>Delivery Charges</h4>
                            <span>+ {{ currency_type().$delivery_price }}</span>
                        </div>
                    </div>
                    @if(isset($_COOKIE['coupon_code']))
                    <div class="cart-total-dil saving-total ">
                        <h4>Total Coupon Discount</h4>
                        <span>- {{ currency_type().$final['coupon_discount_total'] }}</span>
                    </div>
                                @endif

                    <div class="main-total-cart">
                        <h2>Total</h2>
                        <span>{{currency_type().' '.$final['total'] }}</span>
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
</script>
@endpush
