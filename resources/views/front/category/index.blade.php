@extends('front.layouts.layout')

@section('content')

<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Main Categories</li>
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
                        <h2>Main Categories</h2>
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
                @forelse ($categories as $category)
                <div class="col-lg-3 col-md-6">
                    <div class="product-item mb-30">
                        <a href="{{ route('category.show',$category->slug) }}" class="product-img">
                            <img src="{{ asset('storage/uploads/Category/'.$category->image)  }}" alt="">
                        <div class="product-text-dt">
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>
                    </div>
                </div>
                @empty
                Sorry No Categories Found
                @endforelse

                <div class="col-md-12">
                    <div class="more-product-btn">
                        <button class="show-more-btn hover-btn" onclick="window.location.href = '#';">Show More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
