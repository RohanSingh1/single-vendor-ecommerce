@extends('front.layouts.layout')

@section('content')

<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
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
                            <input name="gender" type="hidden" value="default">
                            <i class="dropdown icon d-icon"></i>
                            <div class="text">Popularity</div>
                            <div class="menu">
                                <div class="item" data-value="0">Popularity</div>
                                <div class="item" data-value="1">Price - Low to High</div>
                                <div class="item" data-value="2">Price - High to Low</div>
                                <div class="item" data-value="3">Alphabetical</div>
                                <div class="item" data-value="4">Saving - High to Low</div>
                                <div class="item" data-value="5">Saving - Low to High</div>
                                <div class="item" data-value="6">% Off - High to Low</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-list-view">
            <div class="row">
                @forelse ($data as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="product-item mb-30">
                        <a href="{{ route('product.show',$product->slug) }}" class="product-img">
                            <img src="{{ product_image($product) }}" alt="">
                            <div class="product-absolute-options">
                                <span class="offer-badge-1">{{ product_price($product,'discount_percentage') }}% off</span>
                                <span class="like-icon" title="wishlist"></span>
                            </div>
                        </a>
                        <div class="product-text-dt">
                            @if($product->quantity)
                            <p>Available<span>(In Stock)</span></p>
                            @else
                            <p>Unavailable<span>(Out Of Stock)</span></p>
                            @endif
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price"> {{ product_price($product,'new_price',true) }}
                                 <span> {{ product_price($product,'old_price',true) }}</span></div>
                            <div class="qty-cart qty_section">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn">
                                    <input type="number" step="1" name="quantity" class="input-text now_quantity qty text" min="1"
                                        value="{{ \Cart::get($product->id) != null ? \Cart::get($product->id)->quantity : 1}}">
                                    <input type="button" value="+" class="plus plus-btn">
                                </div>
                                <span class="cart-icon add-to-cart-btn" attr-slug="{{ $product->slug }}">
                                    <i class="uil uil-shopping-cart-alt"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="more-product-btn">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
