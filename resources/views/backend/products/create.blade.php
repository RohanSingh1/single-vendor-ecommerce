@extends('backend.layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('backend/plugins/image-uploader/image-uploader.min.css')}}">
@endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Products
                    <div class="page-title-subheading">Here are all the products you have
                    </div>
                </div>
            </div>
            @can('product-create')
                <div class="page-title-actions">
                    <a href="{{ route('admin.products.index') }}">
                        <button class="btn btn-warning">Back</button>
                    </a>
                </div>
            @endcan
        </div>
    </div>
    @include('inc.messages')
    {!! Form::open(['action' => ['ProductController@store'],'method' => 'POST','files' => 'true' ]) !!}
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        All Products
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{-- @livewire('create-product') --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('Product Name')}}
                                    {{Form::text('name','',['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Selling Price')}}
                                    {{Form::number('price','',['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Old Price')}}
                                    {{Form::number('old_price','',['class'=>'form-control'])}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Quantity')}}
                                    {{Form::text('quantity','',['class'=>'form-control'])}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Model Name')}}
                                    {{Form::text('model_no','',['class'=>'form-control'])}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Supplier Name')}}
                                    <select class="form-control" name="supplier_id">
                                        <option selected disabled>Select Supplier Name</option>
                                        @foreach($suppliers as $key)
                                            <option value="{{$key->id}}">{{$key->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Brand Name')}}
                                    <select class="form-control" name="brand_id">
                                        <option selected disabled>Select Brand Name</option>
                                        @foreach($brand as $key)
                                            <option value="{{$key->id}}">{{$key->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('Category Name')}}
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            @if(count($category->parents))
                                                <option value="{{$category->id}}"
                                                    {{ (collect(old('category_id'))->contains($category->id)) ? 'selected':'' }}
                                                >
                                                    {{$category->name}}@foreach($category->parents as $parent) <strong>>>>>>></strong> {{$parent->name}} @endforeach
                                                </option>
                                            @else
                                                <option value="{{$category->id}}"
                                                    {{ (collect(old('category_id'))->contains($category->id)) ? 'selected':'' }}
                                                > {{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="position-relative form-check">
                                    <label for="is_featured" class="form-check-label">Is Featured</label><br>
                                    <input type="checkbox"
                                           name="is_featured" checked>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="position-relative form-check">
                                    <label for="is_featured" class="form-check-label">Published</label><br>
                                    <input type="checkbox"
                                           name="published" checked>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('Short Description')}}
                                    {{Form::textarea('short_desc','',['class'=>'form-control'])}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('Description')}}
                                    {{Form::textarea('description','',['class'=>'form-control','id'=>'ckeditor'])}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('backend.partials.create-seo')

    {{Form::submit('Create',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
@push('script')
    <script src="{{asset('backend/plugins/image-uploader/image-uploader.min.js')}}"></script>
    <script src="{{ asset('backend/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endpush