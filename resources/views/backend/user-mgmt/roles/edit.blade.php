@extends('backend.layouts.master')

@section('page_title')
Roles
@endsection
@section('styles')
  <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-multiselect/css/multi-select.css') }}">
  <style>
    .ms-container{
      min-width: 1000px !important;
    }
    .ms-container .ms-list {
      height: 400px;
    }
  </style>

@endsection
  <!-- Main Sidebar Container -->
@section('content-head-title')
  Roles
  @endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Roles
                <div class="page-title-subheading">Edit Roles here
                </div>
            </div>
        </div>
        <div class="page-title-actions">
          <a href="{{ route('admin.roles.index') }}"><div class="btn btn-warning btn-outline" >Back</div></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                      Assign Permission to Roles
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.roles.assign_permission_store') }}" method="post">
                            @csrf
                              <input type="hidden" name="role_id" value="{{$role->id }}">
                              <div class="form-group col-4">
                                <label for="role_name" >Role Name:</label>
                                <input type="text" name="role_name" id="inputRole_name" class="form-control" value="{{ $role->name }}"   title="Role Name" placeholder="Role Name">
                              </div>
                              <div class="form-group">
                                <select multiple="multiple" class="form-control" id="assigned" name="selected_permission[]" >
                                  <option disabled="" >Remaining Permissions</option>
                                  <option disabled="" selected >Assigned Permissions</option>
                                  @foreach($permissions as $prem)
                                    <option value="{{ $prem->id}}" @if(in_array($prem->id,$active_role_permission)) selected @endif>{{ $prem->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <input type="submit" class="btn btn-success btn-outline btn-sm" name="assign" value="Assign">
                              <input type="submit" class="btn btn-info btn-outline btn-sm" name="assign_close" value="Assign & close">
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

@push('script')
<script src="{{ asset('backend/plugins/jquery-multiselect/js/jquery.multi-select.js') }}"></script>
  <script>
    $(document).ready(function(){
        $('#assigned').multiSelect();
    });
  </script>
@endpush
