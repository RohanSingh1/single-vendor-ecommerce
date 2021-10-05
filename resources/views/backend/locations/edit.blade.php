@extends('backend.layouts.master')
@section('styles')
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
            <div>Edit Location
                <div class="page-title-subheading">Edit Location here
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
                    Edit Location
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">

                        <div class="col-md-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form action="{{ route('admin.locations.update',$location->id) }}" method="post">
                                @method('PUT')
                                @csrf

                            <div class="form-group">
                                {{Form::label('Province No')}}
                                <select name="province_id" class="form-control">
                                    @foreach (\App\Model\Province::where('status',1)->get() as $province)
                                    <option value="{{ $province->id }}"
                                        {{ $province->id == $location->province->id ? 'selected':'' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {{Form::label('Districts')}}
                                <select name="district_id" class="form-control">
                                    @foreach (\App\Model\District::where('status',1)->get() as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $district->id == $location->district->id ? 'selected':'' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {{Form::label('Name')}}
                                {{Form::text('name',$location->name,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('Price')}}
                                {{Form::text('price',$location->price,['class'=>'form-control'])}}
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                {!! Form::label('status','Location *') !!}
                                {!! Form::select('status',['1' => 'Active','0' => 'In-Active'],
                                $location->status, ['class'=>'form-control']); !!}
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    {{ $errors->first('status') }}
                                </span>
                                @endif
                            </div>

                            {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
