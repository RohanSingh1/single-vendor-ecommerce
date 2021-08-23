@extends('backend.layouts.master')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            {{-- <a href="{{ url->previous() }}"><button class="btn btn-warning" >Back</button></a> --}}
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Show Product
                <div class="page-title-subheading">Show Product here
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
                       Product Details
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <h2>Product Name: {{$product->name}} </h2>
                        <ul>
                          <li>Featured: {!! active_column_check($product->is_featured)!!} </li>
                          <li>Price: {{$product->price}} </li>
                          <li>Quantity: {{$product->quantity}} </li>
                          <li>Type: {{$product->type}} </li>
                          <li> Model Name: {{$product->model_no}} </li>
                          <li> Brand Name: {{$product->brand->brand_name}} </li>
                          <li>Category:
                              @foreach($product->categories as $category)
                                  {{$category->name}}{{!$loop->last?',':''}}
                              @endforeach
                          </li>
                        </ul>
                        <hr>
                        {!!$product->description!!}
                       <hr>
                          <p >Purchased Price: {{$product->purchased_price}}<br>
                          Profit : {{$product->price-$product->purchased_price}}</p>
                          <hr>
                          <a href="{{ route('admin.products.show',$product->id) }}"><button class="btn btn-warning">Back</button></a>

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
                      Feature Image
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <img src="{{ $product->featuredImage->getUrl('featured') }}" class="show-product" alt=""  >
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
