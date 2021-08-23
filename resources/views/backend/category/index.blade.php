@extends('backend.layouts.master')
@section('site_title','Category')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-nestable/nestable.css') }}">
    <style>
        .dd3-content, .dd-handle{
            min-height: 45px;
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
                <div>Category
                    <div class="page-title-subheading">Here are all the category you have
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('admin.category.create')}}" class="">
                    <button class="btn btn-success">Create</button>
                </a>
            </div>
        </div>
    </div>
    @include('inc.messages')
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Category
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <button id="saveMenuOrder" type="button" class="btn btn-info btn-outline btn-sm pull-right">Save
                            Order
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="dd myadmin-dd-empty" id="nestable2">
                            <ol class="dd-list">
                                @if($category->count()>0)
                                    @foreach($category as $value)
                                        <li class="dd-item dd3-item" data-id="{{ $value->id }}">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        {{ substr($value->name,0,60) }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        {!! editDeleteAction($value->id,'admin.category') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($value->children->count()>0)
                                                <ol class="dd-list">
                                                    @include('backend.category.category-child',['value'=>$value])
                                                </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                @else
                                    <p>No items found. App pages</p>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('backend.category.add-modal')
@endsection
@push('script')
    <script src="{{asset('backend/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nestable2').nestable(
                {
                    maxDepth: 3
                });
            $('#saveMenuOrder').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.category.saveOrder')}}",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {data: $('.dd').nestable('serialize')},
                    success: function (msg) {
                        console.log(msg);
                        // $("#confirmDelete").modal("hide");
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endpush
