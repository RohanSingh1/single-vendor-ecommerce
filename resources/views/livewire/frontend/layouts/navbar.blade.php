<div wire:ignore>
    <div id="top-header">
        <div class="container">
            <div class="flex-div">
                <div class="socials">
                    <label>Connect us -</label>

                    @if($facebook)
                        <a class="facebook" target="_blank" href="{{$facebook->text ?? '#'}}"><i
                                    class="fa fa-facebook"></i></a>@endif
                    @if($twitter)
                        <a class="twitter" target="_blank" href="{{$twitter->text ?? '#'}}"><i
                                    class="fa fa-twitter"></i></a>@endif
                    @if($google_plus)
                        <a class="google-plus" target="_blank" href="{{$google_plus->text ?? '#'}}"><i
                                    class="fa fa-google-plus"></i></a>
                    @endif
                    @if($instagram)
                        <a class="instagram" target="_blank" href="{{$instagram->text ?? '#'}}"><i
                                    class="fa fa-instagram"></i></a>@endif
                    @if($youtube)
                        <a class="youtube" target="_blank" href="{{$youtube->text ?? '#'}}"><i
                                    class="fa fa-youtube"></i></a>
                    @endif
                    @if($linkedin)
                        <a class="linkedin" target="_blank" href="{{$linkedin->text ?? '#'}}"><i
                                    class="fa fa-linkedin"></i></a>
                    @endif
                </div>
                <div class="right-top">
                    <div>
                        <a href="{{ route('sellonrst.create') }}">Sell With RST</a>
                        <a href="{{ route('frontend.wishlists') }}">
                            <i class="fa fa-heart wishlist" aria-hidden="true">
                                <span class="count-wishlist">0</span>
                            </i>
                            My Wishlist</a>
                        @auth
                        <a href="{{url('/login')}}">
                            <i class="fa fa-user    "></i>
                            {{ auth()->user()->name }}</a>


                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                        @else
                        <a href="{{url('/login')}}">
                            <i class="fa fa-user    "></i>
                            Login</a>
                        <a href="{{url('/register')}}">Sign Up</a>

                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="middle-header">
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-12">
                        <div class="logo">
                            <a href="{{url('/')}}">
                                <img src="{{get_general_settings_file('site_logo_1')?asset(get_general_settings_file('site_logo_1')->file):asset('front/img/logo.png')}}" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="for-search col-lg-8">
                        <div class="rst-text">
                            <!-- <h5 class="">Supreme Products @ Reasonable Price</h5> -->
                            <img src="{{asset('front_rst/images/text.png')}}" alt="">
                        </div>
                        <form action="{{route('search-results')}}" method="get">
                        <div class="advanced-search">
                            <div class=" category-btn">
                                <select name="categoryId">
                                    <option value="0">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value ="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="text" placeholder="Search..." name="q" />
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>

                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-6 ml-auto for-search justify-content-end">
                        <div class="d-flex for-cart">

                            <a href="{{ route('frontend.cart.index') }}">
                                <i class="fa fa-shopping-cart cart-list" aria-hidden="true">
                                    <span class="count-cart-list" id="cart_total_qty">{{ \Cart::getContent()->count()  }}</span>
                                </i>
                                Cart - <strong id="cart_total">{{ Cart::getSubTotal() }}</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('message'))
    <div class="alert alert-success alert-block center" id="session_message">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
    @if(\Illuminate\Support\Facades\Request::url()==env('APP_URL'))
        <section class="section-main bg padding-y">
            <div class="row no-gutters">
                <aside class="col-lg-3">
                    @include('frontend.layouts.sideNavbar')
                </aside>
    @else
                    <div id="page-inner-title">
                        <div class="container top-title">
                            <div class="row">
                                <div class="col">
                                    <nav class="breadcrumb">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a class="nodecoration panel-title btn-class" data-toggle="collapse" data-parent="#panel" href="#panel-element"><i class="fa fa-bars pr-1" aria-hidden="true"></i>
                                                    Categories
                                                    <i class="fa fa-angle-down pl-2"></i>
                                                </a>
                                            </div>
                                            <div id="panel-element" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    @include('frontend.layouts.sideNavbar')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bread">
                                            <a class="breadcrumb-item" href="{{url('/')}}">Home</a>
                                            @yield('page_name','Default Page')
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif






