<!DOCTYPE html>
<html lang="en">
<head>
    @if(Request::url() != env('APP_URL'))
    <title>@yield('site_title','Home') - {{get_general_settings_text('site_title')->text ?? app_name()}}</title>
    @yield('meta')
    @else
    <title>{{get_general_settings_text('site_title')->text ??'Home'}}
        - {{get_general_settings_text('tagline')->text??app_name()}}</title>
    <meta name="title" content="{{ get_general_settings_text('meta_title')->text ?? app_name()}}">
    <meta name="keyword" content="{{ get_general_settings_text('meta_keyword')->text ?? app_name() }}">
    <meta name="description" content="{{ get_general_settings_text('meta_desc')->text ?? app_name() }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('front.layouts.head')

    <link rel="stylesheet" href="{{ asset('front/css/sweetalert.min.css') }}">
    @stack('css')
    <style>
        .cart-btn{
            margin-top:4px;
        }
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
</head>
<body>
    <div id="app">
    <div id="category_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog category-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content">
                    <div class="cate-header">
                        <h4>Select Category</h4>
                    </div>
                    <ul class="category-by-cat">
                        @forelse ($categories as $category)
                        <li>
                            <a href="{{ route('category.show',$category->slug) }}" class="single-cat-item">
                                <div class="icon">
                                    <img src="{{ asset('storage/uploads/category/'.$category->image) }}" alt="">
                                </div>
                                <div class="text">{{ $category->name }}</div>
                            </a>
                        </li>
                        @empty
                        No Categories Found
                        @endforelse
                    </ul>
                    <a href="#" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a>
                </div>
            </div>
        </div>
    </div>

    <div id="search_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog search-ground-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content">
                    <div class="search-header">
                        <form action="{{ route('search') }}">
                            @csrf
                            <input type="search" placeholder="Search for products..." class="search_now" >
                            <button type="submit"  class="search-button"><i class="uil uil-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cart-item-wrapper">
        @include('front.layouts.cart')
    </div>


    @include('front.layouts.header')


    <div class="wrapper">
        @include('front.layouts.session_messages')
        @yield('content')
    </div>
 

    @include('front.layouts.footer')
</div>
    @include('front.layouts.scripts')

<script src="{{ asset('front/js/sweetalert.min.js') }}" type="text/javascript"></script>
<script>
    @if(url()->previous() == route('front.checkout.store') && Session::has('success'))
    swal("Completed", "{!! session('success') !!}", "success");
    @endif
    $('#app').on('click', '.add-to-cart-btn', function () {
        var $this = $(this);
        var slug = $this.attr('attr-slug');
        $this.prop('disabled', true);
            var quantity = $this.closest('.qty_section').find('.now_quantity').val();
        $.ajax({
            method: 'POST',
            url: '{{ route('front.cart.add') }}',
            data: {
                _token: '{{ csrf_token() }}',
                slug: slug,
                quantity: quantity,
            },
            beforeSend:function(){
            },
            success: function (response) {
                var data = $.parseJSON(response);
                if (data.error) {
                    $.notify(data.message,'error');
                    $('.session_message').html(data.message + "<br>");
                } else {
                    $('#cart-item-wrapper').html(data.html);
                    $('.cart_total').html(data.data.cart_total);
                    $('.cart_total_qty').html(data.data.cart_total_qty);
                    $.notify(data.message,'success');
                    $this.prop('disabled', false);
                    console.log($this.attr('attr-from'));
                    if($this.attr('attr-from') == 'buy_now'){
                        location.href = "{{ route('front.checkout') }}";
                    }
                }
            },
        });
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

    $(document).ready(function () {

        $('#app').click(function(){
            $('.lists_here').remove();
        });
        $('#search').click(function(){
        var query = $('#search_now').val();
            if (query != '') {
                var url = '{{ route("search") }}';
                    url = url+'?query='+query;
                    window.location.href=url;
        } else {
            $.notify('Type The Product Initials To Search','info');
        }
        });
        $('#search_now').on('keyup', function () {
        var query = $(this).val();
        if (query != '') {
            $.ajax({
            url: '{{ route('search_now') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                query: query,
            },
            success: function (response) {
                var data = $.parseJSON(response);
                if (data.error) {
                console.log('errors');
                delete data;
                } else {
                $('.search_list').fadeIn();
                $('.search_list').html(data.html);
                delete data;
                }
            }
            });
        } else {
            $('.lists_here').remove();
        }
        });

        $('.add-to-wishlists').click(function () {
        var product_id = $(this).attr('attr-id');
        var slug = $(this).attr('attr-slug');
            $.ajax({
                method: 'POST',
                url: '{{ route('front.wishlist.store') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    console.log(data);
                    if (data.error) {
                        $.notify(data.message,'info');
                    } else {
                        $.notify(data.message,'success');
                    }
                },
                error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                $.notify("Login To Add Items On Wishlists",'info');
                var url = "{{ route('login') }}";
                url = url+'?redirect-to='+slug;
                location.href = url;
                }
            });
    });

    });

</script>
    @stack('scripts')
</body>
</html>
