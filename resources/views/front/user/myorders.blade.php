@extends('front.layouts.layout')

@section('content')

   @include('front.user.bread')
    <div class="">
        <div class="container">
            <div class="row">
            @include('front.layouts.session_messages')
                @include('front.user.sidebar')
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-title-tab">
                                    <h4><i class="uil uil-box"></i>My Orders</h4>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 form-inline">
                                <form action="{{ route('track_order') }}" method="get">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2">Track Order</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="order_track_id" class="form-control" placeholder="Enter Track Order Id">
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-info" type="submit">Submit</button>
                                             </div>
                                        </div>
                                    </div>
                                </form>

                                @foreach ($data['my_orders'] as $order)
                                <div class="pdpt-bg">
                                    <div class="pdpt-title">
                                        <h6>Ordered Date 10 May, 3.00PM - 6.00PM</h6>
                                    </div>
                                    <div class="order-body10">

                                        <ul class="order-dtsll">
                                            @if($order->products->count()>0)
                                            @foreach ($order->products as $product)

                                            <li>
                                                <div class="order-dt-img">
                                                    <img src="{{ product_image($product) }}" alt="Ordered Products">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="order-dt47">
                                                    <h4>{{ $product->name }}</h4>
                                                    <p>{{ $order->status }}</p>
                                                    <div class="order-title">{{ $product->count() }} Items </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                        <div class="total-dt">
                                            <div class="total-checkout-group">
                                                <div class="cart-total-dil">
                                                    <h4>Sub Total</h4>
                                                    <span>{{ currency_type().' '.$order->sub_totals }}</span>
                                                </div>
                                                <div class="cart-total-dil pt-3">
                                                    <h4>Delivery Charges</h4>
                                                    <span>{{ $delivery_price != null || $delivery_price != 0
                                                    ? $delivery_price : 'Free' }}</span>
                                                </div>
                                            </div>
                                            <div class="main-total-cart">
                                                <h2>Total</h2>
                                                <span>{{ currency_type().' '.$order->grand_totals }}</span>
                                            </div>
                                        </div>
                                        <div class="track-order">
                                            <h4>Order Status</h4>
                                            <div class="bs-wizard" style="border-bottom:0;">
                                                @foreach (\App\Model\DeliveryName::where('step','!=',0)->where('status',1)->orderBy('step','asc')->get() as $key=>$dn)
                                                <div class="bs-wizard-step
                                                @if($dn->delivery_name == $order->status)
                                                active
                                                @php
                                                    $active =true;
                                                @endphp
                                                @elseif (isset($active))
                                                disabled
                                                @else
                                                 complete
                                                @endif
                                                ">
                                                    <div class="text-center bs-wizard-stepnum">{{ $dn->delivery_name }}</div>
                                                    <div class="progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="alert-offer">
                                            <img src="images/ribbon.svg" alt="">
                                            
                                        </div>
                                        <div class="call-bill">
                                            <div class="delivery-man">
                                                Delivery Boy - {{ $order->delivery_boy != null ?
                                                 $order->delivery_boy['name'] : '' }} <i class="uil uil-phone"></i>
                                                        {{ $order->delivery_boy != null ?
                                                         $order->delivery_boy['phone'] : '' }}
                                            </div>
                                            <div class="order-bill-slip">
                                                <a href="#" class="bill-btn5 hover-btn">View Bill</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
