@extends('front.layouts.layout')

@section('content')

<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Offers</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="all-product-grid mb-14">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="default-title mt-4">
                    <h2>Offers</h2>
                    <img src="images/line.svg" alt="">
                </div>
            </div>

            @foreach ($offers as $offer)
            <div class="col-lg-4">
                <a href="#" class="offers-item">
                    <div class="offer-img">
                        <img src="{{ asset('storage/uploads/Deal/'.$offer->image) }}" alt="">
                    </div>
                    <div class="offers-text">
                        <h4>📢 {{ $offer->name }}!</h4>
                        <p>{!! $offer->details !!}</p>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
