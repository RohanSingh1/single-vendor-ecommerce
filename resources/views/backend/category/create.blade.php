@extends('backend.layouts.master')
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
                <div>Create category
                    <div class="page-title-subheading">Create category here
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>
    <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('inc.messages')
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                            Create Category
                        </div>
                        <div class="btn-actions-pane-right">
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Published</label><br>
                                        <input type="checkbox" class="custom-checkbox" name="published" checked>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-check">
                                        <label for="is_featured" class="form-check-label">Featured</label><br>
                                        <input type="checkbox"
                                               name="is_featured">
                                    </div>
                                </div>
                                <div class="col-md-12 @if ($errors->has('image')) has-error @endif">
                                    <label for="image" class="control-label">Image:</label>
                                    <input type="file" id="input-file-now-custom-3" name="image" class="dropify"
                                           data-height="200"
                                           data-default-file=""/>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea type="text" class="form-control"
                                                  name="description">{!! old('description') !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('backend/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush
