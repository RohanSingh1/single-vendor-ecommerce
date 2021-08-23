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
            <div>Edit brand
                <div class="page-title-subheading">Edit brand here
                </div>
            </div>
        </div>
        <div class="page-title-actions">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                       Edit Brand
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['route' => ['admin.brand.update',$brand->id],'method' => 'PUT' ]) !!}
                            <div class="form-group">
                                {{Form::label('Brand Name')}}
                                {{Form::text('brand_name',$brand->brand_name,['class'=>'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('Status')}}
                                <input type="radio" name="status" value="1" {{ $brand->status == 1 ? 'checked':'' }}>Active
                                <input type="radio" name="status" value="0" {{ $brand->status == 0 ? 'checked':'' }}>In-Active
                            </div>
                            {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                            {!! Form::close() !!}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
