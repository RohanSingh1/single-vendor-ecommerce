@extends('backend.layouts.master')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            {{-- <a href="{{ url->previous() }}"><button class="btn btn-warning">Back</button></a> --}}
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit customer
                <div class="page-title-subheading">Edit customer here
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
                    Edit customer
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">

                        <div class="col-md-12">
                            {!! Form::open(['route' => ['admin.customers.update',$customer->id],'method' => 'PUT','enctype'=>'multipart/form-data' ]) !!}
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="modal-body">
                                {!! Form::open(['action' => ['CustomersController@store'],'method' => 'POST','enctype'=>'multipart/form-data' ]) !!}
                                <div class="form-group">
                                    {{Form::label('Full Name')}}
                                    {{Form::text('name',$customer->name,['class'=>'form-control'])}}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::label('email','E-Mail *') !!}
                                    {!! Form::text('email',$customer->email,['class'=>'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                    {!! Form::label('phone_no','Phone *') !!}
                                    {!! Form::text('phone_no',$customer->phone_no,['class'=>'form-control']) !!}
                                    @if ($errors->has('phone_no'))
                                        <span class="help-block">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('address_1') ? ' has-error' : '' }}">
                                    {!! Form::label('address_1','Address 1 *') !!}
                                    {!! Form::text('address_1',$customer->address_1,['class'=>'form-control']) !!}
                                    @if ($errors->has('address_1'))
                                        <span class="help-block">
                                            {{ $errors->first('address_1') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('address_2') ? ' has-error' : '' }}">
                                    {!! Form::label('address_2','Address 2 *') !!}
                                    {!! Form::text('address_2',$customer->address_2,['class'=>'form-control']) !!}
                                    @if ($errors->has('address_2'))
                                        <span class="help-block">
                                            {{ $errors->first('address_2') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    {!! Form::label('image','Image *') !!}
                                    {!! Form::file('image', ['class'=> 'form-control']) !!}
                                    <br>
                                    <p>Current Image</p>
                                    <span>
                                        <a href="{{ asset('storage/uploads/User/'.$customer->image) }}">
                                            <img src="{{ asset('storage/uploads/User/'.$customer->image)  }}" style="width:300px" alt="Deal Image">
                                        </a>
                                    </span>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            {{ $errors->first('image') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    {!! Form::label('status','Status *') !!}

                                    {!! Form::select('status',['1' => 'Active','0' => 'In-Active'], $customer->status,
                                    ['class'=>'form-control']); !!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            {{ $errors->first('status') }}
                                        </span>
                                    @endif
                                </div>

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

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

$('.select2').select2({placeholder: 'Select Options',width: 'resolve'});
        $('.product-list').select2({
            placeholder: 'Select Product',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('admin.search.product') }}",
                dataType: 'json',
                type: 'GET',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    return {
                        results: data
                    };
                },
                cache: true
            }

        });
    </script>

@endpush
