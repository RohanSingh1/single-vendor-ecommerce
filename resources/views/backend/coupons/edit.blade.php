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
            <div>Edit Coupon
                <div class="page-title-subheading">Edit Coupon here
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
                    Edit Coupon
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">

                        <div class="col-md-12">
                            {!! Form::open(['route' => ['admin.coupons.update',$coupon->id],'method' => 'PUT' ]) !!}
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
                                {{Form::label('Coupon Name')}}
                                {{Form::text('coupon_name',$coupon->coupon_name,['class'=>'form-control'])}}
                            </div>



                            <div class="form-group">
                                {{Form::label('Coupon Code')}}
                                {{Form::text('coupon_code',$coupon->coupon_code,['class'=>'form-control','readonly'=>true])}}
                            </div>


                            <div class="form-group">
                                <label for="products">Select Product</label>
                                @php $cat_array=[];  @endphp
                        @if(isset($coupon))
                            @foreach($coupon->products as $cc)
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

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                {!! Form::label('type','Coupon Type *') !!}

                                {!! Form::select('type',['flat_discounts' => 'Flat Discounts (Price)',
                                 'percentage_discounts' => 'Percentage Discounts'], $coupon->type, ['class'=>'form-control','placeholder' => 'Select Coupon Type Now ....']); !!}

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        {{ $errors->first('type') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                {!! Form::label('value','Value *') !!}
                                {!! Form::number('value',$coupon->value, ['class'=> 'form-control']) !!}
                                @if ($errors->has('value'))
                                <span class="help-block">
                                    {{ $errors->first('value') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                                {!! Form::label('expiry_date','Expiry Date *') !!}
                                {!! Form::date('expiry_date',$coupon->expiry_date, ['class'=> 'form-control']) !!}

                                @if ($errors->has('expiry_date'))
                                <span class="help-block">
                                    {{ $errors->first('expiry_date') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                {!! Form::label('status','Coupon Status *') !!}

                                {!! Form::select('status',['1' => 'Active',
                                '0' => 'In-Active'], $coupon->status, ['class'=>'form-control','placeholder' => 'Select Status']);
                                !!}

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
