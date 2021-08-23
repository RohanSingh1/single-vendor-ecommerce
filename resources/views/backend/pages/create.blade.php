@extends('backend.layouts.master')
@section ('site_title', 'Page Create')
@section('styles')
    <link href="{{ asset('backend/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')

    <!-- /.content-header -->
    <!-- Main content -->

    <div class="content">
        @include('inc.messages')
        <form action="{{route('admin.pages.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 card">
                <div class="card-header ">
                    <h3 class="card-title"><span>Post Info</span></h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        @livewire('backend.pages.create')
                        <div class="col-md-2 form-group ">
                            <label for="formidSeven">Published </label><br>
                            <input type="checkbox" name="published" checked>
                        </div>
                        <div class="col-md-12 form-group @if ($errors->has('featured_image')) has-error @endif">
                            <label for="featured_image" class="control-label">Featured Image:</label>
                            <input type="file" id="input-file-now-custom-3" name="featured_image" class="dropify"
                                   data-height="200"
                                   data-default-file=""/>
                            @if ($errors->has('featured_image'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('featured_image') }}
							</span>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label for="formidTwo">Short description </label>
                            {{Form::textarea('summary','',['class'=>'form-control','id'=>'ckeditor'])}}
                        </div>
                        <div class="col-sm-12 form-group">
                            <label for="formidThree">Content </label>
                            {{Form::textarea('top_content','',['class'=>'form-control','id'=>'ckeditor2'])}}
                        </div>
                        <input type="hidden" value="{{$postCategory??0}}" name="postCategory">
                        {{--                        <div class="col-sm-12 form-group">--}}
                        {{--                            <label for="formidFour">Bottom Content</label>--}}
                        {{--                            {{Form::textarea('bottom_content','',['class'=>'form-control','id'=>'ckeditor3'])}}--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            @include('backend.partials.create-seo')
            <div class="mb-3 card">
                <div class="card-footer">
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $('.dropify').dropify();
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor2');
    </script>

@endpush
