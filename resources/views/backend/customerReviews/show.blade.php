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
            <div>Show Customer Reviews
                <div class="page-title-subheading">Show Customer Reviews here
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
                       Customer Reviews Details
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <h2>Customer Name: {{$customerReviews->name}} </h2>
                        <ul>
                            <li> Product Name : <a href="{{route('product.show',$customerReviews->product->slug)}}"
                                target="_blank" style="text-decoration: none;color:rgb(42, 143, 85)">
                                ({{$customerReviews->product->name}}) </a></li>
                          <li>E-Mail: {{ $customerReviews->email }} </li>
                          <li>Contact No: {{$customerReviews->contact_no}} </li>
                          <li>Reviews: {!! $customerReviews->comments !!} </li>

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
                   <p>Customer Reviews For <span style="color:rgb(42, 143, 85)"> ({{$customerReviews->product->name}})</span> :</p>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <span>
                            <a href="{{ route('product.show',$customerReviews->product->slug) }}" target="_blank">
                                <img src="{{ asset($customerReviews->product->featuredImage->getUrl())  }}" style="width:300px;height:auto" alt="Customer reviews document">
                            </a>
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
