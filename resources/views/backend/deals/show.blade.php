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
            <div>Deal Details
                <div class="page-title-subheading">Showing Deal Details here
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
                    Deal Details
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">
                        <h2>Deal Name: {{$deal->name}} </h2>
                        <ul>
                          <li>deal Code: {{ $deal->code }} </li>
                          <li>type: {{$deal->details}} </li>
                          <li>Valid Till: {{$deal->expiry_date}} </li>
                          <li> Status : {{$deal->status == 1 ? 'Active' : 'In-Actives'}} </li>

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
                    Product Name:
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                      <div class="col-md-12">

                                @foreach($deal->products as $product)
                                <a href="{{ route('product.show',$product->name) }}" style="color:#239856;">
                                    <span style="color:#239856;">
                                 {{$product->name}}{{!$loop->last?',':''}}</span></a>
                                @endforeach

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
