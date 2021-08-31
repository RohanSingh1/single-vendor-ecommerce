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
                                        <img src="{{ asset('storage/uploads/slider-item/' . $slider->image) }}" alt="">
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
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel cate-slider owl-theme">
                        @forelse ($categories as $category)
                            <div class="item">
                                <a href="#" class="category-item">
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
                            <span>For You</span>
                            <h2>Top Featured Products</h2>
                        </div>
                        <a href="#" class="see-more-btn">See All</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel featured-slider owl-theme">
                        @if ($data['featured_products']->count() > 0)
                            @foreach ($data['featured_products'] as $product)
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
                                            {{ currency_type() .' '.product_price($product,'new_price') }}<span>
                                            {{ currency_type() .' '.product_price($product,'old_price') }}</span>
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
                        @if ($data['fresh_products']->count() > 0)
                            @foreach ($data['fresh_products'] as $product)
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
                                            {{ currency_type() .' '.product_price($product,'new_price') }}<span>
                                            {{ currency_type() .' '.product_price($product,'old_price') }}</span>
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
                        @if ($data['new_products']->count() > 0)
                            @foreach ($data['featured_products'] as $product)
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
                                                    {{ currency_type() .' '.product_price($product,'new_price') }}<span>
                                                    {{ currency_type() .' '.product_price($product,'old_price') }}</span>
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

<script>
    $('#app').on('click', '.add-to-cart-btn', function () {
        var $this = $(this);
        var slug = $this.attr('attr-slug');
        $this.prop('disabled', true);
        setTimeout(() => {
            var quantity = $this.closest('.qty_section').find('.now_quantity').val();
            console.log(quantity);
        $.ajax({
            method: 'POST',
            url: '{{ route('front.cart.add') }}',
            data: {
                _token: '{{ csrf_token() }}',
                slug: slug,
                quantity: quantity,
            },
            beforeSend:function(){
                $('.qty_section').LoadingOverlay("show");
                },
            success: function (response) {
                var data = $.parseJSON(response);
                if (data.error) {
                    $.notify(data.message,'error');
                    $('.session_message').html(data.message + "<br>");
                } else {
                    console.log('success');
                    $('#cart-item-wrapper').html(data.html);
                    $('.session_message').html(data.message + "<br>");
                        $('.cart_total').html(data.data.cart_total);
                        $('.cart_total_qty').html(data.data.cart_total_qty);
                    $.notify(data.message,'success');

                }
            },
            complete:function(){
                $('.qty_section').LoadingOverlay("hide");
        $this.prop('disabled', false);
                }
        });
        }, 1000);


    });

    $('#app').on('click', '.remove_items', function () {
        var product_id = $(this).attr('attr_id');
        var $this = $(this);
        $.ajax({
            method:'POST',
            url:'{{ route('front.cart.destroy') }}',
            data:{
                _token:'{{ csrf_token() }}',
                product_id:product_id,
            },
            success:function(response){
                var data = $.parseJSON(response);
                if(data.error){
                    $.notify(data.message,'success');
                }else{
                    $('.cart_total').html(data.data.cart_total);
                    $('.cart_total_qty').html(data.data.cart_total_qty);
                    $this.closest('.cart-item').remove();
                }
            },
            complete:function(){
            }
        });
    });

</script>
@endpush
