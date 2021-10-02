@extends('backend.layouts.master')
@section('styles')
    <style>
        .timeline-item{
            box-shadow: 0 1px 1px
            rgba(0,0,0,0.1);
            border-radius: 3px;
            margin-top: 0;
            background:
                #fff;
            color:
                #444;
            margin-left: 60px;
            margin-right: 15px;
            padding: 0px 0px 10px 15px;
            position: relative;
        }
        .time{
            color:
                #999;
            float: right;
            padding: 10px;
            font-size: 12px;
        }
        .timeline-header{
            margin: 0;
            color:
                #555;
            border-bottom: 1px solid
            #f4f4f4;
            padding: 10px;
            font-size: 16px;
            line-height: 1.1;
        }
        .timeline-body{
            padding: 10px;
        }
        .timeline-footer{
            padding: 10px;
        }
    </style>
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Notifications List
                <div class="page-title-subheading">Welcome to {{get_general_settings_text('site_title')->text??app_name()}}
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
@include('inc.messages')
<div id="all_notis">
    @if(auth('admin')->user()->notifications->count() > 0)
        @foreach (auth('admin')->user()->notifications as $key=>$ns)
                <div class="col-sm-12" style="margin-bottom: 10px">
                    <div class="timeline-item">
                        <form action="{{ route('admin.delete_notifications') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $ns->id }}">
                            <button class="btn btn-danger btn-xs pull-right close_notis_all" type="submit" onclick="return confirm('Are you sure you want to delete?')"
                            attr_close_notis_all_id="{{ $ns->id }}"><i class="fa fa-fw fa-close" ></i></button>
                        </form>

                        <span class="time"><i class="fa fa-clock-o"></i> {{ $ns->created_at }}</span>

                        <h3 class="timeline-header">{{ $ns->data['data']['title'] }}</h3>

                        <div class="timeline-body">
                            {{ $ns->data['data']['body'] }}
                        </div>
                        <div class="timeline-footer">

                        </div>
                    </div>
                </div>
                <hr>
        @endforeach
        @else
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p style="text-align: center;color:red">
                        Sorry No Notification Found
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>


@endsection
