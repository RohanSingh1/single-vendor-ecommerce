@extends('front.layouts.layout')
@section('site_title')
{{$page->meta?($page->meta->meta_title?$page->meta->meta_title:$page->post_title):$page->post_title}}
@endsection
@if($page->meta)
@section('meta')
<meta name="title" content="{{ $page->meta->meta_title?$page->meta->meta_title:$page->post_title}}">
<meta name="keyword" content="{{ $page->meta?$page->meta->meta_keyword:'' }}">
<meta name="description" content="{{ $page->meta?$page->meta->meta_desc:'' }}">
@endsection
@endif
@section('page_name')
<span
    class="breadcrumb-item active">{{$page->meta?($page->meta->meta_title?$page->meta->meta_title:$page->post_title):$page->post_title}}</span>
@endsection
@section('content')
    <div class="default-dt">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="title129">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="life-gambo">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="default-title left-text">
                        <h2 class="home-heading">
                            {{$page->meta?($page->meta->meta_title?$page->meta->meta_title:$page->post_title):$page->post_title}}
                        </h2>
                        @if($page->featured_image)
                        <img src="{{asset($page->imagePath)}}" alt="">
                        @endif
                    </div>
                    <div class="about-content">
                        <p>
                        {!! $page->top_content !!}.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="images/about.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="life-gambo">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="default-title">
                        <h2>Our Team</h2>
                        <p>Teamwork Makes the Dream Work</p>
                        <img src="images/line.svg" alt="">
                    </div>
                    <div class="dd-content">
                        <div class="owl-carousel team-slider owl-theme">
                            @foreach (\App\Model\Admin\Admin::where('is_admin',0)->get() as $team)
                            <div class="item">
                                <div class="team-item">
                                    <div class="team-img">
                                        <img src="images/team/img-1.jpg" alt="">
                                    </div>
                                    <h4>{{ $team->name }}</h4>
                                    <span>Delivery Boy</span>
                                    <ul class="team-social">
                                        <li><a href="#" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li><a href="#" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
