@extends('frontend.layouts.master')
@section('site_title','404')
@section('meta')
    <meta name="title" content="404">
@endsection
@section('content')
    <div id="page-inner-title">
        <div class="container top-title">
            <div class="row">
                <div class="col">
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{url('/')}}"> <i class="fa fa-home"
                                                                           aria-hidden="true"></i></a>
                        <span class="breadcrumb-item active">404</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="main" class="column-inner">
        <div class="container">
            <h2>404 error</h2>
            <div class="row main-content-wrap justify-content-center">
                <div class="col-12">

                    <div class="error text-center">
                        <img src="{{asset('front/img/error.png')}}" alt="404">
                        <h2>404</h2>
                        <h4>Page not found</h4>
                        <p>The page you are looking for doesn't exist</p>
                        <p>
                            Go back or head over to <a href="{{env('APP_URL')}}">{{env('APP_URL')}}</a> to choose different path
                        </p>


                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
