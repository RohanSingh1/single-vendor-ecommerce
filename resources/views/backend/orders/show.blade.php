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
                        <h2>Customer Name: {{$order->user->f_name.' '.$order->user_l_name}} </h2>
                        <ul>
                          <li>E-Mail: {{ $order->user->email }} </li>
                          <li>Delivery Boy Name: {{$order->delivery_boy->name}}
                            | E-Mail :- {{ $order->delivery_boy->email }}</li>
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
