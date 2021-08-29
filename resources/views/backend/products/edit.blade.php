@extends('backend.layouts.master')
@section('site_title','Edit Product')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-nestable/nestable.css') }}">
    <style>
        .dd3-content, .dd-handle {
            min-height: 70px;
        }
    </style>
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
                <div>Edit Product
                    <div class="page-title-subheading">Edit product here
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            {!! Form::open(['route' => ['admin.products.update',$product->id],'method' => 'PUT' ,'files' => 'true' ]) !!}

            @include('inc.messages')
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Edit Product
                    </div>
                    <div class="btn-actions-pane-right">
                        {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            {{Form::label('Product Name')}}
                                            {{Form::text('name',$product->name,['class'=>'form-control'])}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{Form::label('Product Status')}}
                                            {!! Form::select('published',['1' => 'Published','0' => 'Un-Published'],$product->published,['class'=>'form-control']) !!}

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('Selling Price')}}
                                            {{Form::number('price',$product->price,['class'=>'form-control'])}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('Old Price')}}
                                            {{Form::number('old_price',$product->old_price,['class'=>'form-control'])}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('Quantity')}}
                                            {{Form::text('quantity',$product->quantity,['class'=>'form-control'])}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('Category Name')}}
                                            <select class="form-control" name="category_id">
                                                @foreach($categories as $category)
                                                    @if(count($category->parents))
                                                        <option value="{{$category->id}}"
                                                            {{ (collect(old('category_id'))->contains($category->id)) ? 'selected':'' }}
                                                            {{ (collect($product->categories->pluck('id')))->contains($category->id) ? 'selected' : ''}}
                                                        >
                                                            {{$category->name}}@foreach($category->parents as $parent)
                                                                <strong>>>>>>></strong> {{$parent->name}} @endforeach
                                                        </option>
                                                    @else
                                                        <option value="{{$category->id}}"
                                                            {{ (collect(old('category_id'))->contains($category->id)) ? 'selected':'' }}
                                                            {{ (collect($product->categories->pluck('id')))->contains($category->id) ? 'selected' : ''}}
                                                        > {{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="position-relative form-check">
                                            <label for="is_featured" class="form-check-label">Is Featured</label><br>
                                            <input type="checkbox" name="is_featured" value="1" {{$product->is_featured ==1?'checked':'' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-check">
                                            <label for="is_fresh" class="form-check-label">Is Fresh</label><br>
                                            <input type="checkbox" name="is_fresh" value="1"  {{$product->is_fresh ==1?'checked':'' }}>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{Form::label('Short Description')}}
                                            {{Form::textarea('short_desc',$product->short_desc,['class'=>'form-control'])}}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{Form::label('Description')}}
                                            {!!Form::textarea('description',$product->description,['class'=>'form-control autosize-input','id'=>'ckeditor'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('backend.partials.create-seo',['meta'=>$product->meta])
            {!! Form::close() !!}
            @include('backend.products.product-image.index')
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('backend/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
    <script src="{{asset('backend/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nestable2').nestable(
                {
                    maxDepth: 1
                });
            $('#nestableFiles').nestable(
                {
                    maxDepth: 1
                });
            $('#saveMenuOrder').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.product-image.saveOrder')}}",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {data: $('.dd').nestable('serialize')},
                    success: function (msg) {
                        console.log(msg);
                        // $("#confirmDelete").modal("hide");
                        window.location.reload();
                    }
                });
            });
        });

    </script>
@endpush
