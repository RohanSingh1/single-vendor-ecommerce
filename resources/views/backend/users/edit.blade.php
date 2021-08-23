@extends ('backend.layouts.master')
@section('page_title')
    Users
@endsection
 @section('styles')
     <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/tablelist.css') }}">
@endsection

@section('content-head-title')
  Users
  @endsection
@section('content-head-body')
  
@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit user 
                <div class="page-title-subheading">Edit user here
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
                      Edit Category
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['action' => ['UsersController@update',$data->id],'method' => 'POST' ]) !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                              @include('inc.messages')
                              <div class="form-group">
                                  {{Form::label('name', 'First name')}}
                                {{Form::text('name',$data->name,['class' => 'form-control','placeholder' => 'Name'])}}
                              </div>
                              <div class="form-group">
                                {{Form::label('email', 'Email')}}
                                {{Form::text('email',$data->email,['class' => 'form-control','placeholder' => 'Email','readonly'])}}
                              </div>
                            </div>
                            <div class="card-footer">
                              {{Form::submit('Update',['class'=>'btn btn-success'])}}
                            {!! Form::close() !!}
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div> 
</div>
        <!-- /.content -->
@endsection

