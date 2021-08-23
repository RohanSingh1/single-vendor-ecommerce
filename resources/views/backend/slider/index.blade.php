@extends('backend.layouts.master')
@section('styles')
    <link href="{{ asset('backend/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('site_title')
    List slider image
@endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Sliders
                    <div class="page-title-subheading">Here are all the sliders you have
                    </div>
                </div>
            </div>
            @can('slider-create')
                <div class="page-title-actions">
                    <a href="#add" data-toggle="modal">
                        <button class="btn btn-success">Add New</button>
                    </a>
                    {{-- <button class="btn btn-success" data-toggle="modal" data-target="#addProduct">Add New</button> --}}
                </div>
            @endcan
        </div>
    </div>
    @include('inc.messages')
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Sliders
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <table class="table table-striped table-bordered" id="product-table">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row el-element-overlay m-b-40">
                            {{-- {{ dd($sliders) }} --}}
                            @if($sliders->count()>0)
                            @else
                                <p>No items found <a href="#add" class="btn btn-link btn-sm" data-toggle="modal">Add
                                        image</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('modal')
    @include('backend.slider.create_modal')
@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.api.slider') }}',
                columns: [
                    {data: 'order', title: 'Order'},
                    {data: 'title', title: 'Title'},
                    {data: 'image', title: 'Image'},
                    {data: 'active', title: 'Active'},
                    {data: 'active_toggle', title: 'Active Toggle'},
                    {data: 'action', name: 'action', title: 'Action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
    <script src="{{ asset('backend/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush
