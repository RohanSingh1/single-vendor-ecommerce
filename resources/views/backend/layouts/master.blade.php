<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = {csrfToken: '{{ csrf_token()}}'}</script>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="user-id" content="{{ auth('admin')->check() ? auth('admin')->user()->id : '' }}">
    <title>
        @yield('site_title')  {{get_general_settings_text('site_title')?get_general_settings_text('site_title')->text:app_name()}}
    </title>
    <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('backend/assets/css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.js" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/dist/css/datatables.min.css') }}"/>
    <link href="{{asset('backend/assets/css/custom.css')}}" rel="stylesheet">
    @livewireStyles()
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <style>

.nav-pills .nav-link.active, .nav-pills .show > .nav-link{
background-color: #17A2B8;
}
.dropdown-menu{
top: 60px;
right: 0px;
left: unset;
width: 460px;
box-shadow: 0px 5px 7px -1px #c1c1c1;
padding-bottom: 0px;
padding: 0px;
}
.dropdown-menu:before{
content: "";
position: absolute;
top: -20px;
right: 12px;
border:10px solid #343A40;
border-color: transparent transparent #343A40 transparent;
}
.head{
padding:5px 15px;
border-radius: 3px 3px 0px 0px;
}
.footer{
padding:5px 15px;
border-radius: 0px 0px 3px 3px;
}
.notification-box{
padding: 10px 0px;
}
.bg-gray{
background-color: #eee;
}
@media (max-width: 640px) {
.dropdown-menu{
top: 50px;
left: -16px;
width: 290px;
}
.nav{
display: block;
}
.nav .nav-item,.nav .nav-item a{
padding-left: 0px;
}
.message{
font-size: 13px;
}
}
    </style>
</head>
<body class="hold-transition skin-yellow sidebar-mini ">
{{--@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])--}}
<div id="app">
    @php
        $sidebarPosition=settingPosition('sidebar-position');
        $headerPosition=settingPosition('header-position');
        $footerPosition=settingPosition('footer-position');
        $headerColor=settingColor('header-color');
        $sidebarColor=settingColor('sidebar-color');
    @endphp
    <div
        class="app-container app-theme-white body-tabs-shadow {{ $sidebarPosition != 0 ? 'fixed-sidebar' : '' }}
        {{ $headerPosition != 0 ? 'fixed-header' : '' }} {{ $footerPosition!= 0 ? 'fixed-footer' : '' }}">
        @include('backend.layouts.header')
        @livewire('theme-settings',
        [
        'sidebarPosition'=>$sidebarPosition,
        'headerPosition'=>$headerPosition,
        'footerPosition'=>$footerPosition,
        'headerColor'=>$headerColor,
        'sidebarColor'=>$sidebarColor,
        ] )
        <div class="app-main">
            @include('backend.layouts.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('backend.layouts.footer')
            </div>
        </div>
    </div>
</div>

@yield('modal')
<script src="{{ asset('js/app.js') }}"></script>
@livewireScripts(['asset_url'=>env('APP_URL')])
@include('backend.layouts.scripts')
@stack('script')
</body>
</html>
