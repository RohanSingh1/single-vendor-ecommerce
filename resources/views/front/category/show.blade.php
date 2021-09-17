@extends('front.layouts.layout')
@push('css')
   <style>
    .custom_head{
        margin-bottom: 33px;
    }
    .no_products{
        font-size: 20px;
        font-weight: bold;
        margin: auto;
        text-align: center;
        color:rgb(207, 16, 16)
    }
</style>
@endpush
@section('content')
<div class="bs-canvas bs-canvas-right position-fixed bg-cart h-100">
    <div class="bs-canvas-header side-cart-header p-3 ">
        <div class="d-inline-block  main-cart-title">Filters</div>
        <button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
    </div>
    <div class="bs-canvas-body filter-body">
        <div class="filter-items">
            <div class="filtr-cate-title">
                <h4>Categories</h4>
            </div>
            <div class="price-pack-item-body scrollstyle_4">
                <div class="brand-list">
                    @foreach ($categories as $cats)
                    <div class="custom-control custom-checkbox pb2">
                        <input type="checkbox" class="custom-control-input category" class="category"
                        @if (isset($data['filter_data']['checked_categories']))
                            {!! in_array($cats->slug, $data['filter_data']['checked_categories'])?"checked":""  !!}
                        @endif
                         name="category[]" id="category{{ $loop->iteration }}" value="{{ $cats->slug }}">
                        <label class="custom-control-label" for="category{{ $loop->iteration }}">{{ $cats->name }}<span
                                class="webproduct"></span></label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="filter-items">
            <div class="filtr-cate-title">
                <h4>Price</h4>
            </div>
            <div class="price-pack-item-body scrollstyle_4">
                <div class="brand-list">
                    <div class="custom-control custom-checkbox pb2">
                        <input type="radio" class="custom-control-input price" name="price" value="1-20"
                        {{  $data['price_range'] !='' && $data['price_range']['max'] =="20" ? 'checked'  : ''}} id="price_1">
                        <label class="custom-control-label" for="price_1">Less than {{ currency_type() }} 20 <span
                                class="webproduct"></span></label>
                    </div>
                    <div class="custom-control custom-checkbox pb2">
                        <input type="radio" class="custom-control-input price" name="price"
                        {{  $data['price_range'] !='' && $data['price_range']['max'] =="100" ? 'checked'  : ''}}
                         value="20-100" id="price_2">
                        <label class="custom-control-label" for="price_2">{{ currency_type() }} 20 to {{ currency_type() }} 100 <span
                                class="webproduct"></span></label>
                    </div>
                    <div class="custom-control custom-checkbox pb2">
                        <input type="radio" class="custom-control-input price"
                        {{  $data['price_range'] !='' && $data['price_range']['max'] =="250" ? 'checked'  : ''}} name="price"
                         value="100-250" id="price_3">
                        <label class="custom-control-label" for="price_3">{{ currency_type() }} 100 to {{ currency_type() }} 250 <span
                                class="webproduct"></span></label>
                    </div>
                    <div class="custom-control custom-checkbox pb2">
                        <input type="radio" class="custom-control-input price"
                        {{  $data['price_range'] !='' && $data['price_range']['max'] =="500" ? 'checked'  : ''}} name="price"
                         value="250-500" id="price_4">
                        <label class="custom-control-label" for="price_4">{{ currency_type() }} 250 to {{ currency_type() }} 500 <span
                                class="webproduct"></span></label>
                    </div>
                    <div class="custom-control custom-checkbox pb2">
                        <input type="radio" class="custom-control-input price"
                        {{  $data['price_range'] !='' && $data['price_range']['max'] =="999" ?  'checked' : '' }} name="price"
                        value="500-999" id="price_5">
                        <label class="custom-control-label" for="price_5">{{ currency_type() }} 500 to {{ currency_type() }} 999 <span
                                class="webproduct"></span></label>
                    </div>
                    <div class="custom-control custom-checkbox pb2">
                        <input type="radio" class="custom-control-input price"
                        {{ $data['price_range'] !='' && $data['price_range']['max'] == "1000" ? 'checked':'' }} name="price" value="1000" id="price_6">
                        <label class="custom-control-label" for="price_6">More than {{ currency_type() }} 1000<span
                                class="webproduct"></span></label>
                    </div>
                    <div class="form-group d-flex">
                        <h4 class="custom_head">custom</h4>
                        <div class="col-sm-4">
                            <input type="text" class="price form-control" name="price" value="{{ $data['price_range'] != '' ? $data['price_range']['min'] : ''}}" id="custom-min-price">
                            <label class="" for="">Min<span
                                    class=""></span></label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="price form-control" name="price[]" value="{{ $data['price_range'] != '' ? $data['price_range']['max'] : ''}}" id="custom-max-price">
                            <label class="" for="price_6">Max<span
                                    class=""></span></label>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-info" id="product-filter-btn" type="button">Filter</button>
        </div>
    </div>
</div>

<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Filter Result</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="all-product-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-top-dt">
                    <div class="product-left-title">
                        <h2></h2>
                    </div>
                    <a href="#" class="filter-btn pull-bs-canvas-right">Filters</a>
                    <div class="product-sort">
                        <div class="ui selection dropdown vchrt-dropdown">
                            <input name="sort-option" type="hidden" value="default" id="sort-option">
                            <i class="dropdown icon d-icon"></i>
                            <div class="text">Popularity</div>
                            <div class="menu filter">

                                <div class="item product-sort-btn" data-value="latest"
                                {{ request()->get('sort-by') == 'price'?'selected="selected"':"" }}>Latest</div>
                                <div class="item product-sort-btn" data-value="price-low"
                                {{ request()->get('sort-by') == 'price-low'?'selected="selected"':"" }}>Price - Low to High</div>
                                <div class="item product-sort-btn" data-value="price-high"
                                {{ request()->get('sort-by') == 'price-high'?'selected="selected"':"" }}>Price - High to Low</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-list-view">
            <div class="row">
                @forelse ($data['products'] as $product)
                @include('front.category.products',['product'=>$product])
                @empty
                <div class="col-sm-12">
                <p class="no_products">Sorry No Product Found</p>
                </div>
                @endforelse

                {{-- <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="more-product-btn">
                                {{ $data['products']->links() }}
            </div>
        </div>
    </div>
</div> --}}


</div>
</div>
</div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            $('.product-sort-btn').click(function () {

            var url = '{{ route('product-filter').'?' }}';
            var sort_data = '{!! $data['sorting_params'] !!}';
            var data = $.parseJSON(sort_data);
            $.each(data, function(key,valueObj){

                url += key+ '=' + valueObj + '&';

            });

            var sort_by =  $(this).attr('data-value');
            location.href = url + 'sort-by=' + sort_by;
            });

            $('#product-filter-btn').click(function () {
            var slug = window.location.pathname.split("/").pop();
            var url = "{{ route('product-filter') }}";
            var checked_categories = "";
            $('.category').each(function () {
                var categories = (this.checked ? this.value : '');

                if (checked_categories == "") {
                    checked_categories += categories;
                } else {
                    if (categories !== '')
                        checked_categories += "," + categories;
                }
            });

            if($('#custom-max-price').val() != ''){
                checked_price =$('#custom-min-price').val() +'-'+$('#custom-max-price').val();
            }

            var flag = false;

            if (checked_categories !== '') {
                url += '?categories=' + checked_categories.trim(',');
                flag = true;
            }
            var checked_price = $('.price:radio:checked').val();

            if (checked_price !== '') {

                if (flag) {
                    url += '&price-range=' + checked_price;
                } else {
                    url += '?price-range='  + checked_price;
                }

                }
                location.href = url;
            });

        });
    </script>
@endpush
