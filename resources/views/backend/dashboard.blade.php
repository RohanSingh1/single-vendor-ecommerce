@extends('backend.layouts.master')
@section('styles')
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Dashboard
                <div class="page-title-subheading">Welcome to {{get_general_settings_text('site_title')->text??app_name()}}
                </div>
                <div class="form-group">
                    <a class="btn btn-info" href="{{ route('create_menu') }}">create_menu</a>
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" data-toggle="tooltip" title="Hey" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button>
        </div>
    </div>
</div>
{{--<div class="row">--}}
{{--    <div class="col-md-6 col-xl-4">--}}
{{--        <div class="card mb-3 widget-content bg-midnight-bloom">--}}
{{--            <div class="widget-content-wrapper text-white">--}}
{{--                <div class="widget-content-left">--}}
{{--                    <div class="widget-heading">Total Orders</div>--}}
{{--                    <div class="widget-subheading">Last year expenses</div>--}}
{{--                </div>--}}
{{--                <div class="widget-content-right">--}}
{{--                    <div class="widget-numbers text-white"><span>1896</span></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-6 col-xl-4">--}}
{{--        <div class="card mb-3 widget-content bg-arielle-smile">--}}
{{--            <div class="widget-content-wrapper text-white">--}}
{{--                <div class="widget-content-left">--}}
{{--                    <div class="widget-heading">Clients</div>--}}
{{--                    <div class="widget-subheading">Total Clients Profit</div>--}}
{{--                </div>--}}
{{--                <div class="widget-content-right">--}}
{{--                    <div class="widget-numbers text-white"><span>$ 568</span></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-6 col-xl-4">--}}
{{--        <div class="card mb-3 widget-content bg-grow-early">--}}
{{--            <div class="widget-content-wrapper text-white">--}}
{{--                <div class="widget-content-left">--}}
{{--                    <div class="widget-heading">Followers</div>--}}
{{--                    <div class="widget-subheading">People Interested</div>--}}
{{--                </div>--}}
{{--                <div class="widget-content-right">--}}
{{--                    <div class="widget-numbers text-white"><span>46%</span></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}
{{--    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">--}}
{{--        <div class="card mb-3 widget-content bg-premium-dark">--}}
{{--            <div class="widget-content-wrapper text-white">--}}
{{--                <div class="widget-content-left">--}}
{{--                    <div class="widget-heading">Products Sold</div>--}}
{{--                    <div class="widget-subheading">Revenue streams</div>--}}
{{--                </div>--}}
{{--                <div class="widget-content-right">--}}
{{--                    <div class="widget-numbers text-warning"><span>$14M</span></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
