@extends('front.layouts.layout')

@section('content')
<div class="gambo-Breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Frequently Asked Questions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="all-product-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="default-title mt-4">
                    <h2>Frequently Asked Questions</h2>
                    <img src="images/line.svg" alt="">
                </div>
                <div class="panel-group accordion pt-1" id="accordion0">
                    @foreach ($faqs as $faq)
                    <div class="panel panel-default">
                        <div class="panel-heading" id="headingOne">
                            <div class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-target="#collapseOne" href="#"
                                    aria-expanded="false" aria-controls="collapseOne">
                                    {{ $faq->title }}
                                </a>
                            </div>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="headingOne" data-parent="#accordion0" style="">
                            <div class="panel-body">
                                <p>{!! $faq->description !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
