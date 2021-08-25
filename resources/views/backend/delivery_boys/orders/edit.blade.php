@extends('backend..delivery_boys.layouts.master')
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
            <div>Edit Order
                <div class="page-title-subheading">Edit Order here
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
                    Edit Order
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">

                        <div class="col-md-12">
                            {!! Form::open(['route' => ['admin.delivery_orders.update',$order->id],'method' =>
                            'PUT','enctype'=>'multipart/form-data' ]) !!}
                            <input type="hidden" name="product_id" value="{{ $order->product_id}}">
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
                                {{Form::label('Status')}}
                                {!! Form::select('status',['delivered' => 'Delivered',
                                'pending' => 'Pending','cancelled' => 'Cancelled'], $order->status,
                                ['class'=>'form-control']);
                                !!}
                            </div>

                            <div class="form-group">
                                {{Form::label('Full Names')}}
                                {{Form::text('full_names',$order->full_names,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group">
                                <label for="products">Select Product</label>
                                @php $pr_array=[]; @endphp

                                @if(isset($order))
                                @foreach($order->products as $cc)
                                @php $product = \App\Model\Product::find($cc->id); @endphp
                                @php $pr_array[] = $cc->id @endphp
                                @endforeach
                                @endif
                                <select name="products[]" id="products" multiple class="form-control select2">
                                    @foreach(\App\Model\Product::get() as $prs)
                                    <option value="{{ $prs->id }}"
                                        {{ in_array($prs->id,$pr_array) ? 'selected="selected"' : '' }}>
                                        {{$prs->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('products'))
                                <span class="help-block">
                                    {{ $errors->first('products') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {{Form::label('Sub Totals')}}
                                {{Form::text('sub_totals',$order->sub_totals,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('Shipping Price')}}
                                {{Form::text('shipping_price',$order->shipping_price,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('Discounts Total')}}
                                {{Form::text('total_discounts',$order->total_discounts,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('Grand Total')}}
                                {{Form::text('grand_totals',$order->grand_totals,['class'=>'form-control'])}}
                            </div>
                            {{-- <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {!! Form::label('status','Sell With us Status *') !!}

                            {!! Form::select('status',['1' => 'Active',
                            '0' => 'In-Active'], $order->status, ['class'=>'form-control','placeholder' => 'Select
                            Status']);
                            !!}

                            @if ($errors->has('status'))
                            <span class="help-block">
                                {{ $errors->first('status') }}
                            </span>
                            @endif
                        </div> --}}
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
<script src="{{ asset('backend/plugins/dropify/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">
    $('.dropify').dropify();
    CKEDITOR.replace('ckeditor');
</script>

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
