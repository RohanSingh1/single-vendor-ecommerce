@extends('backend.layouts.master')

@section('page_title')
Users
@endsection
@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/bower_components/datatables/datatables.min.css') }}"/>
{{--
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/tablelist.css') }}"> --}}
  <style>
  .dataTables_filter input { width: 500px }
  .dataTables_info { margin-top: 12px }
  </style>
@endsection
  <!-- Main Sidebar Container -->
@section('content-head-title')
  Users
@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Users
                <div class="page-title-subheading">Here are all the users you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="btn btn-info btn-outline pull-right" data-toggle="modal" data-target="#addForm"><i class="fa fa-plus"></i> &nbsp ADD</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Users
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center" style="width:200px;">Images</th>
                            <th class="text-center">User Type</th>
                            <th class="text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $user)
                        <tr class="title item{{$user->id}}">
                            <td>{{ $loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td style="width:200px;">
                            <a href="{{ asset('storage/Uploads/Users/'.$user->image) }}">
                                <img  style="width:200px;" src="{{ asset('storage/Uploads/Users/'.$user->image) }}" alt="User Image">
                            </a>
                            </td>
                            <td>{{$user->is_admin == 1 ? 'admin': 'Delivery Boy'}}</td>
                            <td>
                                <div class="action">
                                  <a href="#" class="show-modal btn btn-primary  btn-sm" data-id = "{{$user->id}}" data-first_name ="{{$user->first_name}}" data-last_name="{{$user->last_name}} " data-email ="{{$user->email}}" data-contact ="{{$user->contact}}" data-address ="{{$user->address}}" ><i class="fa fa-eye"></i></a>
                                  <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                  <a class="delete-modal btn btn-danger btn-sm" data-id="{{ $user->id }}" data-title ="{{$user->first_name}}"  data-toggle="modal" data-rel="delete" ><i class="fa fa-trash"></i></a>
                                </div>
                              </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
   @include('backend.users.view-permission-modal')
    @include('backend.users.register-modal')
    @include('backend.users.show-modal')
    @include('inc.delete-modal')
@endsection

@push('script')
    <script src="{{ asset('backend/bower_components/datatables/datatables.min.js') }}"></script>

    {{-- <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/scripts/user_mgmt.js') }}"></script>
@endpush
