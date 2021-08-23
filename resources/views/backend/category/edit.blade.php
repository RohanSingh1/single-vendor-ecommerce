@extends('backend.layouts.master')
@section('site_title','Category Edit')
@section('styles')
    <link href="{{ asset('backend/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                {{-- <a href="{{ url->previous() }}"><button class="btn btn-warning" >Back</button></a> --}}
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Edit category
                    <div class="page-title-subheading">Edit category here
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            {!! Form::open(['route' => ['admin.category.update',$category->id],'method' => 'PUT','files'=>true ]) !!}
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Edit Category
                    </div>
                    <div class="btn-actions-pane-right">
                        {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @include('inc.messages')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('Category Name')}}
                                    {{Form::text('name',$category->name,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Category Url')}}
                                    {{Form::text('u',route('category.show',$category->slug),['class'=>'form-control','disabled'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Published')}}
                                    {{Form::checkbox('published',$category->published,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    <label for="is_featured" class="form-check-label">Featured</label><br>
                                    <input type="checkbox"
                                           name="is_featured" {{$category->is_featured ==1?'checked':'' }}>
                                </div>
                                <div class="form-group @if ($errors->has('image')) has-error @endif">
                                    <label for="image" class="control-label">Image:</label>
                                    <input type="file" id="input-file-now-custom-3" name="image" class="dropify"
                                           data-height="200"
                                           data-default-file="@if(!empty($category->image)){{ asset($category->imagePath) }}@endif"/>
                                </div>
                                <div class="form-group">
                                    {{Form::label('Description')}}
                                    {{Form::textarea('description',$category->description,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    <label for="Colors">Colors</label>
                                    <div class="row">
                                        @foreach($colors as $color)
                                            <div class="col-md-2">
                                                <div class="position-relative form-check">
                                                    <label for="" class="form-check-label">
                                                        <input type="checkbox" value="{{$color->id}}" name="colors[]"
                                                               @if(old('colors'))
                                                               @foreach(old('colors') as $item)
                                                               @if(number_format($item) == $color->id)
                                                               checked
                                                               @endif
                                                               @endforeach
                                                               @else
                                                               @foreach($category->colors as $item)
                                                               @if($item->id == $color->id)
                                                               checked
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        >
                                                        {{$color->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush
