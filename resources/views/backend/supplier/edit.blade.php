@extends('backend.layouts.master')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                {{-- <a href="{{ url->previous() }}"><button class="btn btn-warning" >Back</button></a> --}}
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Edit Supplier
                    <div class="page-title-subheading">Edit supplier here
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>
    @include('inc.messages')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Edit Suppliers
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {!! Form::open(['route' => ['admin.supplier.update',$supplier->id],'method' => 'PUT' ]) !!}
                        <div class="form-group">
                            {{Form::label('Supplier Name')}}
                            {{Form::text('supplier_name',$supplier->supplier_name,['class'=>'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('Contact Number')}}
                            {{Form::text('contact_no',$supplier->contact_no,['class'=>'form-control'])}}
                        </div>

                        {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
