@extends('backend.layouts.master')
@section('styles')
<style>
    .f_price{
        color:seagreen;
        font-size: 15px;
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            {{-- <a href="{{ url->previous() }}"><button class="btn btn-warning" >Back</button></a> --}}
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Show Order
                <div class="page-title-subheading">Show Order here
                </div>
            </div>
        </div>
        <div class="page-title-actions">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-7 col-xl-8">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Order Details
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <h2>Customer Name: {{isset($order->user) ? $order->user->f_name.' '.$order->user_l_name
                        : 'Guest With Shipping Name:-'.unserialize($order->shipping_address)['full_name']}} </h2>
                        <ul>
                          <li>E-Mail: {{ isset($order->user) ? $order->user->email
                          : 'Guest With Shipping E-Mail:-'.unserialize($order->shipping_address)['full_name'] }}</li>
                          <li>Delivery Boy Name:- @if(isset($data->delivery_boy)) {{  $data->delivery_boy->name }}
                            | E-Mail :- {{ $data->delivery_boy->email }} @else Not Assigned  @endif</li>
                          <li>Status: {{$order->status}} </li>
                          <li>Date: {!! $order->created_at !!} </li>
                          <li>Sub Total: <span class="f_price"> {!! $order->sub_totals !!} </span> </li>
                          <li>Shipping Price: <span class="f_price"> {!! $order->shipping_price !!} </span> </li>
                          <li>Coupon Discount Total: <span class="f_price"> {!! $order->total_discounts !!} </span> </li>
                          <li>Grand Totals: <span class="f_price"> {!! $order->grand_totals !!} </span> </li>
                        </ul>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-5 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                   <p>Total Ordered Products <span style="color:rgb(42, 143, 85)">({{ $order->products->count() }})</span> :</p>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <span>
                            @foreach ($order->products as $product)
                            <a href="{{route('product.show',$product->slug)}}" target="_blank"
                              style="text-decoration: none;color:rgb(42, 143, 85)">
                              ({{$product->name}}) </a>
                            @endforeach
                        </span>
                        </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                   <p>Delivery Boy</p>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <span style="font-weight:bold;">

                            @if(isset($data->delivery_boy)) {{  $data->delivery_boy->name }}
                            | E-Mail :- {{ $data->delivery_boy->email }} @else Not Assigned  @endif

                        </span>
                        </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                   <p>Delivery Notes</p>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <span style="font-weight:bold;">Meat Condition :- {!! $order->meat_condition.' '.$order->meat_state !!}</span> <br>
                        <span style="font-weight:bold;">Order Note :- {!! $order->order_note !!}</span> <br>
                        </div>
                  </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-sm-12 col-md-7 col-xl-8">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Shipping Address Details
                </div>
            </div>
            @if($order->shipping_address != null)
            @php $shipping_address = unserialize($order->shipping_address); @endphp
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <h2>Customer Name: {{ $shipping_address['full_name'] }} </h2>
                        <ul>
                          <li>E-Mail: {{ $shipping_address['email'] }} </li>
                          <li>Phone: {!! $shipping_address['phone'] !!} </li>
                          <li>From Valley: {!! isset($shipping_address['from_valley']) ?
                            $shipping_address['from_valley'] : '' !!} </li>
                          <li>Address: <span class="f_price"> {!! $shipping_address['address1'] !!} </span> </li>
                          <li>Address 2: <span class="f_price"> {!! $shipping_address['address2'] !!} </span> </li>
                        </ul>
                      </div>
                  </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-7 col-xl-8">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Billing Address Details
                </div>
            </div>
            @if($order->billing_address != null)
            @php $billing_address = unserialize($order->billing_address); @endphp
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <h2>Customer Name: {{ $billing_address['name'] }} </h2>
                        <ul>
                            <li>E-Mail: {{ $billing_address['email'] }} </li>
                            <li>Phone: {!! $billing_address['phone'] !!} </li>
                            <li>Address: <span class="f_price"> {!! $billing_address['address1'] !!} </span> </li>
                            <li>Address 2: <span class="f_price"> {!! $billing_address['address2'] !!} </span> </li>
                          </ul>
                      </div>
                  </div>
                </div>
            </div>
            @else
                <span class="text-center alert alert-info">Not Found</span>
            @endif
        </div>
    </div>
</div>

@endsection
@push('script')
  <script>
    $(document).ready(function(){
      $(".price").hide();
      $("button").click(function(){
        $(".price").toggle();
      });
    });
</script>
@endpush
