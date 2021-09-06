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
                                    <h4><i class="uil uil-box"></i>My Orders</h4>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
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
                                            <h4>Track Order</h4>
                                            <div class="bs-wizard" style="border-bottom:0;">
                                                <div class="bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum">Pending</div>
                                                    <div class="progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                                <div class="bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum">Packed</div>
                                                    <div class="progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                                <div class="bs-wizard-step active">
                                                    <div class="text-center bs-wizard-stepnum">On the way</div>
                                                    <div class="progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                                <div class="bs-wizard-step disabled">
                                                    <div class="text-center bs-wizard-stepnum">Delivered</div>
                                                    <div class="progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert-offer">
                                            <img src="images/ribbon.svg" alt="">
                                            Cashback of $2 will be credit to Gambo Super Market wallet 6-12 hours of
                                            delivery.
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
