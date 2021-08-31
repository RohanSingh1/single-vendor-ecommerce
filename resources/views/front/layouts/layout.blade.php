<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.layouts.head')

    @stack('css')
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
                            <a href="#" class="single-cat-item">
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
                        <form action="#">
                            <input type="search" placeholder="Search for products...">
                            <button type="submit"><i class="uil uil-search"></i></button>
                        </form>
                    </div>
                    <div class="search-by-cat">
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-1.svg') }}" alt="">
                            </div>
                            <div class="text">
                                Fruits and Vegetables
                            </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-2.svg') }}" alt="">
                            </div>
                            <div class="text"> Grocery & Staples </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-3.svg') }}" alt="">
                            </div>
                            <div class="text"> Dairy & Eggs </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-4.svg') }}" alt="">
                            </div>
                            <div class="text"> Beverages </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-5.svg') }}" alt="">
                            </div>
                            <div class="text"> Snacks </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-6.svg') }}" alt="">
                            </div>
                            <div class="text"> Home Care </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-7.svg') }}" alt="">
                            </div>
                            <div class="text"> Noodles & Sauces </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-8.svg') }}" alt="">
                            </div>
                            <div class="text"> Personal Care </div>
                        </a>
                        <a href="#" class="single-cat">
                            <div class="icon">
                                <img src="{{ asset('front/images/category/icon-9.svg') }}" alt="">
                            </div>
                            <div class="text"> Pet Care </div>
                        </a>
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
    @stack('scripts')
</body>

<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Jul 2021 16:03:37 GMT -->
</html>
