@extends('backend.layouts.master')
@section('styles')
    <link href="{{ asset('backend/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('site_title')
    Edit slider
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
                <div>Edit Slider
                    <div class="page-title-subheading">Edit slider here
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>
    @include('inc.messages')

    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-body">
                    <form action="{{ route('admin.sliders.update',$slider->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group @if ($errors->has('image')) has-error @endif">
                            <label for="image" class="control-label">Slider Image:</label>
                            <input type="file" id="input-file-now-custom-3" name="image" class="dropify"
                                   data-height="200"
                                   data-default-file="@if(!empty($slider->image)){{ asset($slider->imagePath) }}@endif"/>
                            @if ($errors->has('image'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('image') }}
							</span>
                            @endif
                        </div>
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            <label for="title" class="control-label">Title:</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title here"
                                   value="{{ $slider->title ?? '' }}">
                            @if ($errors->has('title'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('title') }}
							</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="link" >Active:
                            <input type="checkbox" class="" name="active"
                                  {{ $slider->active==1?'checked':'' }}>
                            </label>
                        </div>
                        <div class="form-group @if ($errors->has('link')) has-error @endif">
                            <label for="link" class="control-label">Order:</label>
                            <input type="number" class="form-control" name="order"
                                   value="{{ $slider->order ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Description:</label>
                            <textarea class="form-control" id="message-text1" name="description"
                                      placeholder="Enter description here" rows="8"
                                      cols="10">{{ $slider->description ?? '' }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('description') }}
							</span>
                            @endif
                        </div>
                        <div class="form-group @if ($errors->has('button_text')) has-error @endif">
                            <label for="button_text" class="control-label">Button Text</label>
                            <input type="text" class="form-control" name="btn_text"
                                   value="{{ $slider->btn_text ?? '' }}">
                            @if ($errors->has('btn_text'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('btn_text') }}
							</span>
                            @endif
                        </div>
                        <div class="form-group @if ($errors->has('offer_text')) has-error @endif">
                            <label for="offer_text" class="control-label">Offer Text</label>
                            <input type="text" class="form-control" name="btn_text"
                                   value="{{ $slider->offer_text ?? '' }}">
                            @if ($errors->has('btn_text'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('btn_text') }}
							</span>
                            @endif
                        </div>
                        <div class="form-group @if ($errors->has('link')) has-error @endif">
                            <label for="link" class="control-label">Link:</label>
                            <input type="text" class="form-control" name="target_url"
                                   value="{{ $slider->target_url ?? '' }}">
                            @if ($errors->has('target_url'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('target_url') }}
							</span>
                            @endif
                        </div>
                        <div class="form-group @if ($errors->has('target')) has-error @endif">
                            <label for="target" class="control-label">Target</label>
                            <select name="target" id="" class="form-control">
                                <option value="0" @if($slider->target=='_self') selected @endif>Current Tab</option>
                                <option value="1" @if($slider->target=='_blank') selected @endif>New Tab</option>
                            </select>
                            @if ($errors->has('target'))
                                <span class="text-danger" role="alert">
								{{ $errors->first('target') }}
							</span>
                            @endif
                        </div>

                        <button class="btn btn-success btn-outline btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush
