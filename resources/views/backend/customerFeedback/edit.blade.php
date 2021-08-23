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
            <div>Edit Customer Feedback
                <div class="page-title-subheading">Edit Customer Feedback here
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
                    Edit Customer Feedback
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">

                        <div class="col-md-12">
                            {!! Form::open(['route' => ['admin.customerFeedback.update',$customerFeedback->id],'method' => 'PUT','enctype'=>'multipart/form-data' ]) !!}
                            <input type="hidden" name="product_id" value="{{ $customerFeedback->product_id}}">
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
                                {{Form::label('Name')}}
                                {{Form::text('name',$customerFeedback->name,['class'=>'form-control'])}}
                            </div>



                            <div class="form-group">
                                {{Form::label('E-Mail')}}
                                {{Form::text('email',$customerFeedback->email,['class'=>'form-control'])}}
                            </div>


                            <div class="form-group{{ $errors->has('contact_no') ? ' has-error' : '' }}">
                                {!! Form::label('contact_no','contact_no *') !!}
                                {!! Form::text('contact_no',$customerFeedback->contact_no, ['class'=> 'form-control']) !!}
                                @if ($errors->has('contact_no'))
                                <span class="help-block">
                                    {{ $errors->first('contact_no') }}
                                </span>
                                @endif
                            </div>



                            <div class="form-group{{ $errors->has('feedback') ? ' has-error' : '' }}">
                                {!! Form::label('feedback','Customer Feedbacks *') !!}
                                {!! Form::textarea('feedback',$customerFeedback->feedback,['class'=>'form-control','id'=>'ckeditor'])!!}
                                @if ($errors->has('feedback'))
                                <span class="help-block">
                                    {{ $errors->first('feedback') }}
                                </span>
                                @endif
                            </div>

                            {{-- <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                {!! Form::label('status','Sell With us Status *') !!}

                                {!! Form::select('status',['1' => 'Active',
                                '0' => 'In-Active'], $customerFeedback->status, ['class'=>'form-control','placeholder' => 'Select Status']);
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
@endpush
