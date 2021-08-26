@extends('front.layouts.layout')
@section('content')
<div class="main-banner-slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel offers-banner owl-theme">
                    @forelse ($data['sliders'] as $slider)
                    <div class="item">
                        <div class="offer-item">
                            <div class="offer-item-img">
                                <div class="gambo-overlay"></div>
                                <img src="{{ asset('storage/uploads/slider-item/'.$slider->image) }}" alt="">
                            </div>
                            <div class="offer-text-dt">
                                <div class="offer-top-text-banner">
                                    <p>{{ $slider->offer_text }}</p>
                                    <div class="top-text-1">{{ $slider->description }}</div>
                                    <span>{{ $slider->title }}</span>
                                </div>
                                <a href="{{ $slider->target_url }}}" {{ $slider->target == 1 ? '_blank' : '' }}
                                     class="Offer-shop-btn hover-btn">{{ $slider->btn_text }}</a>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse
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
                        <span>Shop By</span>
                        <h2>Categories</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel cate-slider owl-theme">
                    @forelse ($data['categories'] as $category)
                    <div class="item">
                        <a href="#" class="category-item">
                            <div class="cate-img">
                                <img src="{{ asset('storage/uploads/category/'.$category->image) }}" alt="">
                            </div>
                            <h4>{{ $category->name }}</h4>
                        </a>
                    </div>
                    @empty
                        No Category Found
                    @endforelse


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
                    @if($data['featured_products']->count()>0)
                    @foreach ($data['featured_products'] as $featured)
                    @php $new_price = $featured->price;
                         $old_price = $featured->old_price;
                         if($old_price != null || $old_price != 0){
                            $discount_prices = $old_price-$new_price;
                            $discount_percentage = $discount_prices*100/$featured->price;
                         }
                         if($featured->thumbnailImage()->get() != ''){
                             $p_image = $featured->thumbnailImage()->get()[0]->getURl();
                         }else{
                             $p_image = $featured->getMedia('products')->get(0)->getURl();
                         }
                    @endphp
                    <div class="item">
                        <div class="product-item">
                            <a href="single_product_view.html" class="product-img">
                                <img src="{{ $p_image }}" alt="">
                                <div class="product-absolute-options">
                                    <span class="offer-badge-1">{{ round($discount_percentage,2) }}% off</span>
                                    <span class="like-icon" title="wishlist"></span>
                                </div>
                            </a>
                            <div class="product-text-dt">
                               @if( $featured->quantity >0 )
                                <p>Available<span>(In Stock)</span></p>
                                @else
                                <p>(Out of Stock)</span></p>
                                @endif
                                <h4>{{ $featured->name }}</h4>
                                <div class="product-price">{{ currency_type() }} {{  $old_price }} <span>{{ currency_type() }}{{ $new_price }}</span></div>
                                <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus minus-btn">
                                        <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                        <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
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


<div class="section145">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title-tt">
                    <div class="main-title-left">
                        <span>Offers</span>
                        <h2>Best Values</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#" class="best-offer-item">
                    <img src="{{ asset('front/images/best-offers/offer-1') }}.jpg" alt="">
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#" class="best-offer-item">
                    <img src="{{ asset('front/images/best-offers/offer-2') }}.jpg" alt="">
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#" class="best-offer-item offr-none">
                    <img src="{{ asset('front/images/best-offers/offer-3') }}.jpg" alt="">
                    <div class="cmtk_dt">
                        <div class="product_countdown-timer offer-counter-text" data-countdown="2021/01/06"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-12">
                <a href="#" class="code-offer-item">
                    <img src="{{ asset('front/images/best-offers/offer-4') }}.jpg" alt="">
                </a>
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
                        <h2>Fresh Vegetables & Fruits</h2>
                    </div>
                    <a href="#" class="see-more-btn">See All</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel featured-slider owl-theme">
                    @if($data['fresh_products']->count() > 0)
                    @foreach ($data['fresh_products'] as $fresh)
                    @php
                    $new_price = $featured->price;
                    $old_price = $featured->old_price;
                    if($old_price != null || $old_price != 0){
                       $discount_prices = $old_price-$new_price;
                       $discount_percentage = $discount_prices*100/$featured->price;
                    }
                    if($featured->thumbnailImage()->get() != ''){
                        $p_image = $featured->thumbnailImage()->get()[0]->getURl();
                    }else{
                        $p_image = $featured->getMedia('products')->get(0)->getURl();
                    }
               @endphp
                    <div class="item">
                        <div class="product-item">
                            <a href="single_product_view.html" class="product-img">
                                <img src="{{ asset('front/images/product/img-11.jpg') }}" alt="">
                                <div class="product-absolute-options">
                                    <span class="offer-badge-1">{{ $discount_percentage }}% off</span>
                                    <span class="like-icon" title="wishlist"></span>
                                </div>
                            </a>
                            <div class="product-text-dt">
                                @if( $featured->quantity >0 )
                                <p>Available<span>(In Stock)</span></p>
                                @else
                                <p>(Out of Stock)</span></p>
                                @endif
                                <h4>{{ $fresh->name }}
                                <div class="product-price">{{ currency_type() }} {{ $new_price }} <span>
                                    {{ currency_type() }}{{ $old_price }}</span></div>
                                <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus minus-btn">
                                        <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                        <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
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


<div class="section145">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title-tt">
                    <div class="main-title-left">
                        <span>For You</span>
                        <h2>Added New Products</h2>
                    </div>
                    <a href="#" class="see-more-btn">See All</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel featured-slider owl-theme">

                    @if($data['new_products']->count()>0)
                    @foreach ($data['new_products'] as $featured)
                    @php $new_price = $featured->price;
                         $old_price = $featured->old_price;
                         if($old_price != null || $old_price != 0){
                            $discount_prices = $old_price-$new_price;
                            $discount_percentage = $discount_prices*100/$featured->price;
                         }
                         if($featured->thumbnailImage()->get() != ''){
                             $p_image = $featured->thumbnailImage()->get()[0]->getURl();
                         }else{
                             $p_image = $featured->getMedia('products')->get(0)->getURl();
                         }
                    @endphp
                    <div class="item">
                        <div class="product-item">
                            <a href="single_product_view.html" class="product-img">
                                <img src="{{ $p_image }}" alt="">
                                <div class="product-absolute-options">
                                    <span class="offer-badge-1">{{ round($discount_percentage,2) }}% off</span>
                                    <span class="like-icon" title="wishlist"></span>
                                </div>
                            </a>
                            <div class="product-text-dt">
                               @if( $featured->quantity >0 )
                                <p>Available<span>(In Stock)</span></p>
                                @else
                                <p>(Out of Stock)</span></p>
                                @endif
                                <h4>{{ $featured->name }}</h4>
                                <div class="product-price">{{ currency_type() }} {{  $old_price }} <span>{{ currency_type() }}{{ $new_price }}</span></div>
                                <div class="qty-cart">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus minus-btn">
                                        <input type="number" step="1" name="quantity" value="1" class="input-text qty text">
                                        <input type="button" value="+" class="plus plus-btn">
                                    </div>
                                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></span>
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
