<div class="main-card mb-3 card">
    <div class="card-header">
        Picture Count ({{$product->getMedia('products')->count()}})
        <div class="btn-actions-pane-right action-icon-btn">
            Delete all
            {!! deleteAction($product->id,'admin.products.image-upload.destroy-all') !!}
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <figure>
                                <figcaption>Featured image</figcaption>
                                <img
                                    src="{{$product->featuredImage?$product->featuredImage->getUrl():asset('no-image.jpg')}}"
                                    width="100px" alt="Not Found">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <figure>
                                <figcaption>Thumbnail image</figcaption>
                                <img
                                    src="{{$product->thumbnailImage?$product->thumbnailImage->getUrl():asset('no-image.jpg')}}"
                                    width="100px" alt="Not Found">

                            </figure>
                        </div>
                    </div>
                    <button id="saveMenuOrder" type="button" class="btn btn-info btn-outline btn-sm ">Save
                        Order
                    </button>
                    <div class="dd myadmin-dd-empty" id="nestable2">
                        <ol class="dd-list">
                            @if($product->getMedia('products')->count()>0)
                                @foreach($product->getMedia('products') as $media)
                                    <li class="dd-item dd3-item" data-id="{{ $media->id }}">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="{!! $media->getUrl() !!}" height="60px" alt="">
                                                    {!! $media->getCustomProperty('color')!!}
                                                </div>
                                                <div class="col-md-3">
                                                    @if($media->id==$product->featured_image)
                                                        Featured
                                                    @else
                                                        {!! makePrimary('admin.products.image-upload.make-primary', ['product' => $media->model_id, 'pImage' => $media->id],'Make Featured')!!}
                                                    @endif
                                                </div>
                                                <div class="col-md-3">

                                                    @if($media->id==$product->thumbnail_image)
                                                        Thumbnail
                                                    @else
                                                        {!! makePrimary('admin.products.image-upload.make-thumbnail', ['product' => $media->model_id, 'pImage' => $media->id],'Make Thumbnail')!!}
                                                    @endif

                                                </div>
                                                <div class="col-md-2">
                                                    {!!  deleteAction($media->id, 'admin.products.image-upload') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <p>No items found.</p>
                            @endif
                        </ol>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <form action="{{route('admin.products.image-upload.store',$product->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <h6>Add a new picture</h6>
                        <div class="ksMainInnerWrapItemContent">
                            <div class="form-row">
                                <div class="col-md-12 form-group">
                                    <span class="btn btn-primary btn-file btn-sm">
                                    <i class="fa fa-folder-open"></i>Upload Featured Image
                                    {{Form::file('image[]',['accept'=>"image/*",'id'=>'featureImage','class'=>'form-control', 'onchange'=>'loadFile(event)','multiple'])}}
                                </span>
                                    <img id="preview" width="230px" class="show-img-bg">
                                    <img id="oldFeatureImage" width="230px" src="{{asset($product->image)}}"
                                         class="show-img-bg">
                                </div>
                                
                                <input type="hidden" name="uploadType" value="image">
                                <div class="col-sm-3 form-group">
                                    <label for="formid4" class="d-block">Publish</label>
                                    <button class="btn btn-success ksButtonImageUploadPublish" type="submit">
                                        <span>Publish Product Picture</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')

@endpush
