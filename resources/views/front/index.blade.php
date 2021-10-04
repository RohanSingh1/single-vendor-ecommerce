@extends('front.layouts.layout')
@push('css')
<style>
    .new_btn{
        margin-left: 14px;
        font-size: 12px;
    }
    .product-item img{
        height: 158px;
    }
    .cate-img img{
        height: 50px;
    }
</style> 
@endpush
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
                                        <img src="{{ asset('storage/uploads/slider-item/' . $slider->image) }}" alt="">
                                    </div>
                                    <div class="offer-text-dt">
                                        <div class="offer-top-text-banner">
                                            <p>{{ $slider->offer_text }}</p>
                                            <div class="top-text-1">{{ $slider->description }}</div>
                                            <span>{{ $slider->title }}</span>
                                        </div>
                                        <a href="{{ $slider->target_url }}" {{ $slider->target == 1 ? '_blank' : '' }}
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
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel cate-slider owl-theme">
                        @forelse ($categories as $category)
                            <div class="item">
                                <a href="{{ route('category.show',$category->slug) }}" class="category-item">
                                    <div class="cate-img">
                                        <img src="{{ asset('storage/uploads/category/' . $category->image) }}" alt="">
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
                            <span></span>
                            <h2>{{ isset($data['settings'][2]) ? $data['settings'][2]['text'] : 'Top Products' }}</h2>
                        </div>
                        <a href="{{ route('show_all','is_featured') }}" class="see-more-btn">See All</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel featured-slider owl-theme">
                        @if ($data['featured_products']->count() > 0)
                            @foreach ($data['featured_products'] as $product)
                                @include('front.layouts.products',['product'=>$product])
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
               @foreach ($data['deals'] as $deal)
               <div class="col-lg-4 col-md-6">
                    <a href="{{ route('deal_products',$deal->slug) }}" class="best-offer-item offr-none">
                        <img src="{{ asset('storage/uploads/Deal/'.$deal->image) }}" alt="{{ $deal->name }}">
                        <div class="cmtk_dt">
                            <div class="product_countdown-timer offer-counter-text"
                             data-countdown="{{ date('Y/m/d',strtotime($deal->expiry_date)) }}"></div>
                        </div>
                    </a>
                </div>
                @endforeach

                <div class="col-md-12">
                    @foreach ($data['coupons'] as $coupon)
                    <a href="{{ route('coupon_products',$coupon->slug) }}" class="code-offer-item">
                        <img src="{{ asset('storage/uploads/Coupon/'.$coupon->image) }}" alt="{{ $coupon->coupon_name }}">
                    </a>
                    @endforeach
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
                            <span></span>
                            <h2>{{ isset($data['settings'][1]) ? $data['settings'][1]['text'] : 'Featured Products' }}</h2>
                        </div>
                        <a href="{{ route('show_all','is_fresh') }}" class="see-more-btn">See All</a>
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="owl-carousel featured-slider owl-theme">
                        @if ($data['fresh_products']->count() > 0)
                            @foreach ($data['fresh_products'] as $product)
                            @include('front.layouts.products',['product'=>$product])
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
                            <span></span>
                            <h2>{{ isset($data['settings'][0]) ? $data['settings'][0]['text'] : 'New Products' }}</h2>
                        </div>
                        <a href="{{ route('show_all','new_products') }}" class="see-more-btn">See All</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel featured-slider owl-theme">
                        @if ($data['new_products']->count() > 0)
                            @foreach ($data['featured_products'] as $product)
                            @include('front.layouts.products',['product'=>$product])
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

