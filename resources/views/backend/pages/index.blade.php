@extends('backend.layouts.master')
@section ('site_title', 'Page')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Pages
                    <div class="page-title-subheading">Here are all the pages you have
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="btn-shadow dropdown-toggle btn btn-info">Change View
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.pages.index',['withTrash'=>true])}}" class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>View Deleted</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.pages.index',['withTrash'=>false])}}" class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>Not Deleted</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @can('page-create')
                    <a href="{{route('admin.pages.create')}}">
                        <button class="btn btn-success">Add New</button>
                    </a>
                    {{-- <button class="btn btn-success" data-toggle="modal" data-target="#addProduct">Add New</button> --}}
                @endcan
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Pages Info
        </div>
        <div class="card-body">
            <div class="ksTableWrapOneContent">
                <div class="ksTableWrapOneCard table-responsive">
                    <table id="datatable" class="table table-bordered table-hover table-sm">
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        var withTrash={{$withTrash??''}}
        $(function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.datatable.pages',['withTrash'=>$withTrash??'0']) }}',
                order: [[0, "desc"]],
                columns: [
                    {data: 'id', title: 'ID'},
                    {data: 'post_title', title: 'Name'},
                    {data: 'published', title: 'Published'},
                    {data: 'created_at', title: 'Published At'},
                    {data: 'front_view', title: 'Site view'},
                    {data: 'action', title: 'Action'},
                ],
            });
        });
    </script>
@endpush
