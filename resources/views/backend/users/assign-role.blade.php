@extends('backend.layouts.master')
@section('page_title')
Users
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
            <div>Edit User 
                <div class="page-title-subheading">Here are all the Edit User you have
                </div>
            </div>
        </div>
        <div class="page-title-actions">
          <a href="{{ route('admin.users') }}"><div class="btn btn-warning btn-outline" >Back</div></a>
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
                       Edit Role For User
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                     <div class="row">
                        <div class="col-md-12">
                          <form action="{{ route('admin.users.assign_role_store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id }}">
                            
                            <div class="form-group">
                              <select multiple="multiple" class="form-control" id="assign" name="selected_permission[]" >
                                <option disabled="" >Remaining Permissions</option>
                                <option disabled="" selected >Assigned Permissions</option>
                                @foreach($roles as $key)  
                                  <option value="{{ $key->id}}" @if(in_array($key->id,$active_role_permission)) selected @endif>{{ $key->name }}</option>
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
        $('#assign').multiSelect();
  </script>
@endpush