{{--ADD FORM--}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 card">
                        <div class="card-header">
                            <ul class="nav" role="tablist">
                                <li role="presentation" class="nav-item">
                                    <a href="#image" aria-controls="home" role="tab" class="nav-link active"
                                       data-toggle="tab"
                                       aria-expanded="true">
                                        <span class="visible-xs"><i class="ti-home"></i></span>
                                        <span class="hidden-xs"> Image</span>
                                    </a>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <a href="#content" aria-controls="home" role="tab" class="nav-link"
                                       data-toggle="tab"
                                       aria-expanded="true">
                                        <span class="visible-xs"><i class="ti-home"></i></span>
                                        <span class="hidden-xs"> Content</span>
                                    </a>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <a href="#link" aria-controls="profile" role="tab" class="nav-link"
                                       data-toggle="tab"
                                       aria-expanded="false">
                                        <span class="visible-xs"><i class="ti-user"></i></span>
                                        <span class="hidden-xs">Link</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="image">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('image')) has-error @endif">
                                            <label for="image" class="control-label">Slider Image:</label>
                                            <input type="file" id="input-file-now" name="image" class="dropify"
                                                   accept="image/x-png,image/gif,image/jpeg"/>
                                            @if ($errors->has('image'))
                                                <span class="text-danger" role="alert">
										<p>{{ $errors->first('image') }}</p>
									</span>
                                            @endif
                                            <p style="font-style: italic;color: darkorange;">Appropriate file type: .jpg
                                                .jpeg
                                                .png</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="content">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                                            <label for="title" class="control-label">Title:</label>
                                            <input type="text" class="form-control" name="title"
                                                   placeholder="Enter title here"
                                                   value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <span class="text-danger" role="alert">
										<p>{{ $errors->first('title') }}</p>
									</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Description:</label>
                                            <textarea class="form-control" id="message-text1" name="description"
                                                      placeholder="Enter description here" rows="8"
                                                      cols="10">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger" role="alert">
										<p>{{ $errors->first('description') }}</p>
									</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="link">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('button_text')) has-error @endif">
                                            <label for="btn_text" class="control-label">Button Text</label>
                                            <input type="text" class="form-control" placeholder="Enter button text here"
                                                   name="btn_text" value="{{ old('btn_text') ?? '' }}">
                                            @if ($errors->has('btn_text'))
                                                 <span class="text-danger" role="alert">
										    {{ $errors->first('btn_text') }}
									    </span>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('target_url')) has-error @endif">
                                            <label for="target_url" class="control-label">Link:</label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="target_url"
                                                           value="{{ old('target_url') }}" placeholder="Enter Link here">
                                                    @if ($errors->has('target_url'))
                                                        <span class="text-danger" role="alert">
												    {{ $errors->first('target_url') }}
											    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group @if ($errors->has('offer_text')) has-error @endif">
                                            <label for="offer_text" class="control-label">Offer Text</label>
                                            <input type="text" class="form-control" name="btn_text"
                                                   value="{{ $slider->offer_text ?? '' }}">
                                            @if ($errors->has('offer_text'))
                                                <span class="text-danger" role="alert">
                                                {{ $errors->first('offer_text') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('target')) has-error @endif">
                                            <label for="target" class="control-label">Target</label>
                                            <select name="target" id="" class="form-control">
                                                <option value="0">Current Tab</option>
                                                <option value="1">New Tab</option>
                                            </select>
                                            @if ($errors->has('target'))
                                                <span class="text-danger" role="alert">
										    {{ $errors->first('target') }}
									    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-success btn-outline btn-sm" id="confirm_yes">
                        Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
