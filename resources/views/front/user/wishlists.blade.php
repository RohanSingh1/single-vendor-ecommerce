@extends('front.layouts.layout')
@push('css')
        <style>
            .add-to-cart-btn{
                margin-left: 10px;
            }
        </style>
@endpush
@section('content')
@include('front.user.bread')
<div class="">
    <div class="container">
        <div class="row">
            @include('front.user.sidebar')
            <div class="col-lg-9 col-md-8">
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title-tab">
                                <h4><i class="uil uil-heart"></i>Shopping Wishlist</h4>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="pdpt-bg">
                                <div class="wishlist-body-dtt">
                                    @if ($wishlists->count()>0)
                                    @forelse ($wishlists as $wishlist)
                                    <div class="cart-item">
                                        <div class="cart-product-img">
                                            <img src="images/product/img-11.jpg" alt="">
                                            <div class="offer-badge">{{ product_price($wishlist->product,'discount_percentage') }}% OFF</div>
                                        </div>
                                        <div class="cart-text">
                                            <h4>{{ $wishlist->product->name }}</h4>
                                            <div class="cart-item-price">{{ product_price($wishlist->product,'new_price',true) }}
                                                 <span>{{ product_price($wishlist->product,'old_price',true) }}</span></div>
                                                <button type="button" attr_id='{{ $wishlist->id }}'
                                                    class="cart-close-btn close remove_items_w" >
                                                <i class="uil uil-trash-alt"></i></button>
                                                    <button class="btn btn-success add-to-cart-btn_w" title="Add To Cart" attr-slug="{{$wishlist->product->slug }}"
                                                        attr-wishlist_id="{{ $wishlist->id }}" attr-id="{{ $wishlist->product->id }}"
                                                        attr-slug="{{ $wishlist->product->slug }}" name="add-to-cart" title="Add to Carts">
                                                        <i class="uil uil-shopping-cart-alt"></i>
                                                    </button>
                                        </div>

                                    </div>
                                    @endforeach
                                    @else
                                    <h4 class="alert alert-info text-center">No Items On Wishlists</h4>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    <script>

        $('.add-to-cart-btn_w').click(function () {
        var $this = $(this);
        var id = $this.attr('attr-id');
        var slug = $this.attr('attr-slug');
        var wishlist_id = $this.attr('attr-wishlist_id');
        $.ajax({
            method: 'POST',
            url: '{{ route('front.cart.add') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                slug: slug,
                from:'wishlists',
                wishlist_id:wishlist_id
            },
            success: function (response) {
                var data = $.parseJSON(response);
                if (data.error) {
                    alert(data.message)
                } else {
                    $('#cart-item-wrapper').html(data.html);
                        $('.cart_total').html(data.data.cart_total);
                        $('.cart_total_qty').html(data.data.cart_total_qty);
                    $.notify(data.message,'success');
                    $this.closest('.cart-item').remove();
                }
            },
        });
    });

    $('.remove_items_w').click(function () {
        var wishlist_id = $(this).attr('attr_id');
        var $this = $(this);
        $.ajax({
            method:'POST',
            url:'{{ route('front.wishlist.destroy') }}',
            data:{
                _token:'{{ csrf_token() }}',
                wishlist_id:wishlist_id,
            },

            success:function(response){
                var data = $.parseJSON(response);
                if(data.error){
                    alert(data.message);
                }else{
                    var count = "{{ auth()->user()->mywishlists()->count() }}";
                    if(count == 1){
                        $this.closest('.wishlist-body-dtt').html("<h4 class='alert alert-info text-center'>No Items On Wishlists</h4>");
                    }
                    $this.closest('.cart-item').remove();
                    $.notify(data.message,'success');
                }
            },

        });
    });
</script>

@endpush
