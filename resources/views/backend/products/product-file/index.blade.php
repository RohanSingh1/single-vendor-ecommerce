@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/bower_components/datatables/datatables.min.css') }}"/>
@endsection
<div class="main-card mb-3 card">
    <div class="card-header">
        File Count ({{$product->getMedia('products-file')->count()}})
        <div class="btn-actions-pane-right action-icon-btn">
            Delete all
            {!! deleteAction($product->id,'admin.products.image-upload.destroy-all') !!}
        </div>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <table id="product-image-table" class="table table-hover" style="background-color: #fff;">
                        <tr>
                            <th>Sn</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach($product->getMedia('products-file') as $media)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{!! $media->getUrl() !!}" target="_blank"
                                       download="download">{{$media->name}}</a>
                                </td>
                                <td>{!!  deleteAction($media->id, 'admin.products.image-upload') !!}</td>
                            </tr>
                        @endforeach


                    </table>
                </div>
                <div class="col-md-12">
                    <form action="{{route('admin.products.image-upload.store',$product->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <h6>Add a new File</h6>
                        <div class="ksMainInnerWrapItemContent">
                            <div class="form-row">
                                <div class="col-md-12 form-group">
                                    <span class="btn btn-primary btn-file btn-sm">
                                    <i class="fa fa-folder-open"></i>Upload file
                                    {{Form::file('image[]',['id'=>'featureImage','class'=>'form-control', 'onchange'=>'loadFile(event)'])}}
                                </span>
                                </div>
                                <input type="hidden" name="uploadType" value="file">
                                <div class="col-sm-3 form-group ">
                                    <label for="formid4" class="d-block">Publish</label>
                                    <button class="btn btn-success ksButtonImageUploadPublish" type="submit">
                                        <span>Publish Product File</span>
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
@push('scripts')
@endpush
