<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = {csrfToken: '{{ csrf_token()}}'}</script>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
        @include('backend.delivery_boys.layouts.header')
        {{-- @livewire('theme-settings',
        [
        'sidebarPosition'=>$sidebarPosition,
        'headerPosition'=>$headerPosition,
        'footerPosition'=>$footerPosition,
        'headerColor'=>$headerColor,
        'sidebarColor'=>$sidebarColor,
        ] ) --}} 
        <div class="app-main">
            @include('backend.delivery_boys.layouts.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('backend.delivery_boys.layouts.footer')
            </div>
        </div>
    </div>
</div>

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
@yield('modal')
@livewireScripts(['asset_url'=>env('APP_URL')])
@include('backend.delivery_boys.layouts.scripts')
@stack('script')

</body>
</html>
