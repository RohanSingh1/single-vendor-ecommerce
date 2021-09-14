@extends('front.layouts.layout')
@push('css')
<style>
    .session_messages{
        color:red
    }
</style>
@endpush
@section('content')
@php
    $category = end($product->categories);
@endphp
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="shop_grid.html">{{ $category[0]->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
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
                    <div class="product-dt-view">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">

                            <div id="sync1" class="owl-carousel owl-theme">
                                @foreach($product->getMedia('products') as $media)
                                    <div class="item">
                                        <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                                </div>
                                <div id="sync2" class="owl-carousel owl-theme">
                                    @foreach($product->getMedia('products') as $media)
                                        <div class="item">
                                            <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="product-dt-right">
                                    <h2>{{ $product->name }}</h2>
                                    <div class="no-stock">
                                        <p class="pd-no">Product No.<span>{{ $product->model_no }}</span></p>

                                        @if($product->quantity >0)
                                        <p class="stock-qty">Available<span>(Instock)</span></p>
                                        @else
                                        <p class="stock-qty">Unavailable<span>(Out Of Stock)</span></p>
                                        @endif

                                    </div>
                                    {{-- <div class="product-radio">
                                        <ul class="product-now">
                                            <li>
                                                <input type="radio" id="p1" name="product1">
                                                <label for="p1">500g</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="p2" name="product1">
                                                <label for="p2">1kg</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="p3" name="product1">
                                                <label for="p3">2kg</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="p4" name="product1">
                                                <label for="p4">3kg</label>
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <p class="pp-descp">{!! $product->short_desc !!}.</p>
                                    <div class="product-group-dt">
                                        <ul>
                                            <li>
                                                <div class="main-price color-discount">Discount Price<span>{{ product_price($product,'new_price',true) }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="main-price mrp-price">MRP Price<span>{{ product_price($product,'old_price',true) }}</span></div>
                                            </li>
                                        </ul>
                                        <ul class="gty-wish-share">
                                            <li>
                                                <div class="qty-product">
                                                    <div class="quantity buttons_added">

                                                        <input type="button" value="-" class="minus minus-btn" >
                                                        <input type="number" step="1" name="quantity" class="input-text now_quantity qty text" min="1"
                                                         value="{{ \Cart::get($product->id) != null ? \Cart::get($product->id)->quantity : 1}}">
                                                        <input type="button" value="+" class="plus plus-btn">
                                                    </div>
                                                </div>
                                            </li>
                                            <li><span class="like-icon save-icon add-to-wishlists"  attr-id="{{ $product->id }}"
                                                 attr-slug="{{ $product->slug }}" title="wishlist"></span></li>
                                        </ul>
                                        <span class="session_messages"></span>
                                        <ul class="ordr-crt-share">
                                            <li><button class="add-cart-btn hover-btn add-to-cart-btn" attr-slug="{{ $product->slug }}">
                                                <i class="uil uil-shopping-cart-alt"></i>Add to Cart</button></li>
                                            <li><button class="order-btn hover-btn add-to-cart-btn" attr-slug="{{ $product->slug }}" attr-from="buy_now">Order Now</button></li>
                                        </ul>
                                    </div>
                                    <div class="pdp-details">
                                        <ul>
                                            <li>
                                                <div class="pdp-group-dt">
                                                    <div class="pdp-icon"><i class="uil uil-usd-circle"></i></div>
                                                    <div class="pdp-text-dt">
                                                        <span>Lowest Price Guaranteed</span>
                                                        <p>{{ $front_info1 }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="pdp-group-dt">
                                                    <div class="pdp-icon"><i class="uil uil-cloud-redo"></i></div>
                                                    <div class="pdp-text-dt">
                                                        <span>Easy Returns & Refunds</span>
                                                        <p>{{ $front_info2 }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="pdpt-bg">
                        <div class="pdpt-title">
                            <h4>More Like This</h4>
                        </div>
                        <div class="pdpt-body scrollstyle_4">
                            @foreach ($related_products as $related_product)
                            <div class="cart-item border_radius">
                                <a href="single_product_view.html" class="cart-product-img">
                                    <img src="images/product/img-6.jpg" alt="">
                                    <div class="offer-badge">4% OFF</div>
                                </a>
                                <div class="cart-text">
                                    <h4>{{ $related_product->name }}</h4>
                                    {{-- <div class="cart-radio">
                                        <ul class="kggrm-now">
                                            <li>
                                                <input type="radio" id="k1" name="cart1">
                                                <label for="k1">0.50</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="k2" name="cart1">
                                                <label for="k2">1kg</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="k3" name="cart1">
                                                <label for="k3">2kg</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="k4" name="cart1">
                                                <label for="k4">3kg</label>
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <div class="qty-group">
                                        <div class="quantity buttons_added">
                                            <input type="button" value="-" class="minus minus-btn" >
                                                        <input type="number" step="1" name="quantity" class="input-text now_quantity qty text" min="1"
                                                         value="{{ \Cart::get($product->id) != null ? \Cart::get($product->id)->quantity : 1}}">
                                                        <input type="button" value="+" class="plus plus-btn">
                                        </div>
                                        <div class="cart-item-price">{{ product_price($product,'new_price',true) }} <span>{{ product_price($product,'old_price',true) }}</span></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="pdpt-bg">
                        <div class="pdpt-title">
                            <h4>Product Details</h4>
                        </div>
                        <div class="pdpt-body scrollstyle_4">
                            <div class="pdct-dts-1">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section145">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title-tt">
                        <div class="main-title-left">
                            <span>For You</span>
                            <h2>Top Featured Products</h2>
                        </div>
                        <a href="#" class="see-more-btn">See All</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel featured-slider owl-theme">
                        @if($featured_products->count()>0)
                        @foreach ($featured_products as $featured_product)
                        <div class="item">
                            <div class="product-item">
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
                                    <div class="product-price">
                                        {{ product_price($product,'new_price',true) }}<span>
                                        {{ product_price($product,'old_price',true) }}</span>
                                    </div>
                                    <div class="qty_section qty-cart">
                                        <div class="quantity buttons_added">
                                            <input type="button" value="-" class="minus minus-btn" >
                                            <input type="number" step="1" name="quantity" class="input-text now_quantity qty text" min="1"
                                             value="{{ \Cart::get($product->id) != null ? \Cart::get($product->id)->quantity : 1}}"
                                             >
                                            <input type="button" value="+" class="plus plus-btn">
                                        </div>
                                        <span class="cart-icon add-to-cart-btn" attr-slug="{{ $product->slug }}">
                                            <i class="uil uil-shopping-cart-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
<script src="{{ asset('front/js/product.thumbnail.slider.js') }}"></script>
<script src="{{ asset('front/js/offset_overlay.js') }}"></script>
@endpush
