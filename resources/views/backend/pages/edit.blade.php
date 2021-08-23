@extends('backend.layouts.master')
@section ('title', 'Page Edit')
@section('styles')
    <link href="{{ asset('backend/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content">
        <form action="{{route('admin.pages.update',$page->id)}}" method="post"
              enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Post Info
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <a href="{{route('admin.pages.show',$page->id)}}" target="_blank"
                           class="btn btn-primary ">Preview</a>
                        <button class="btn btn-success ml-2" type="submit">Update</button>
                    </div>
                </div>
                <div class="card-body">
                    @include('inc.messages')
                    <div class="tab-content">
                        <div class="row">
                            @livewire('backend.pages.edit',['page'=>$page])
                            <div class="col-sm-2 form-group ">
                                <label for="formidSeven">Published</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                           name="published" {{old('published') ? 'checked ' :($page->published=='1'?'checked':'')}}>
                                    <label for="customCheckbox1" class="custom-control-label"></label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="featured_image" class="control-label">Featured Image:</label>
                                <input type="file" id="input-file-now-custom-3" name="featured_image"
                                       class="dropify"
                                       data-height="200"
                                       data-default-file="{{$page->featured_image?asset($page->imagePath):''}}"/>
                            </div>
                            <div class="col-mPd-6 form-group">
                                <label for="">Published at</label>
                                <input type="text" class="form-control timeDatePicker" name="created_at"
                                       value="{{old('created_at')??$page->created_at}}">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="formidTwo">Short description </label>
                                {!! Form::textarea('summary',$page->summary,['class'=>'form-control','id'=>'ckeditor'])!!}
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="formidThree">Content </label>
                                {!! Form::textarea('top_content',$page->top_content,['class'=>'form-control','id'=>'ckeditor2'])!!}
                            </div>
                            {{--                        <div class="col-sm-12 form-group">--}}
                            {{--                            <label for="formidFour">Bottom Content</label>--}}
                            {{--                            {{Form::textarea('bottom_content','',['class'=>'form-control','id'=>'ckeditor3'])}}--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>

            @include('backend.partials.create-seo',['meta'=>$page->meta])

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
