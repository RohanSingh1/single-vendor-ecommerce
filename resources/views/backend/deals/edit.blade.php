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
            <div>Edit deal
                <div class="page-title-subheading">Edit deal here
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
                    Edit deal
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">

                        <div class="col-md-12">
                            {!! Form::open(['route' => ['admin.deals.update',$deal->id],'method' => 'PUT','enctype'=>'multipart/form-data' ]) !!}
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="form-group">
                                {{Form::label('Deal Title')}}
                                {{Form::text('name',$deal->name,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group">
                                <label for="products">Select Product</label>
                                @php $cat_array=[];  @endphp
                        @if(isset($deal))
                            @foreach($deal->products as $cc)
                                @php $cp = \App\Model\Product::find($cc->id); @endphp
                                @php $cat_array[] = $cc->id @endphp
                            @endforeach
                        @endif
                                <select name="products[]" id="products" multiple class="form-control select2">
                                    @foreach(\App\Model\Product::get() as $cats)
                                    <option value="{{ $cats->id }}"
                                        {{ in_array($cats->id,$cat_array) ? 'selected="selected"' : '' }}>
                                    {{$cats->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('products'))
                                <span class="help-block">
                                    {{ $errors->first('products') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                                {!! Form::label('expiry_date','Expiry Date *') !!}
                                {!! Form::date('expiry_date',$deal->expiry_date, ['class'=> 'form-control']) !!}

                                @if ($errors->has('expiry_date'))
                                <span class="help-block">
                                    {{ $errors->first('expiry_date') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                {!! Form::label('image','Image *') !!}
                                {!! Form::file('image', ['class'=> 'form-control']) !!}
                                <br>
                                <p>Current Image</p>
                                <span>
                                    <a href="{{ asset('storage/Uploads/Deal/'.$deal->image) }}">
                                        <img src="{{ asset('storage/Uploads/Deal/'.$deal->image)  }}" style="width:300px" alt="Deal Image">
                                    </a>
                                </span>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        {{ $errors->first('image') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                {!! Form::label('details','deal details *') !!}
                                {!! Form::text('details',$deal->details,['class'=>'form-control']) !!}
                                @if ($errors->has('details'))
                                    <span class="help-block">
                                        {{ $errors->first('details') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                {!! Form::label('status','deal Status *') !!}
                                {!! Form::select('status',['1' => 'Active','0' => 'In-Active'],
                                $deal->status, ['class'=>'form-control']); !!}

                                @if ($errors->has('status'))
                                <span class="help-block">
                                    {{ $errors->first('status') }}
                                </span>
                                @endif
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
