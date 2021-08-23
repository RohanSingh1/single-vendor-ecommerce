<div class="pop-model">
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog"  aria-labelledby ="addProduct" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Name</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['ProductController@store'],'method' => 'POST','files' => 'true' ]) !!}
                    <div class="row">
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Product Name')}}
                                {{Form::text('product_name','',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Purchased Price')}}
                                {{Form::number('purchased_price','',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Selling Price')}}
                                {{Form::number('selling_price','',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Quantity')}}
                                {{Form::number('quantity','',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Model Name')}}
                                {{Form::text('model_no','',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Supplier Name')}}
                                <select class="form-control" name="supplier_id">
                                        @foreach($suppliers as $key)
                                            <option value="{{$key->id}}">{{$key->supplier_name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Brand Name')}}
                                <select class="form-control" name="brand_id">
                                        @foreach($brand as $key)
                                            <option value="{{$key->id}}">{{$key->brand_name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                {{Form::label('Category Name')}}
                                <select class="form-control" name="category_id">
                                        @foreach($category as $key)
                                            <option value="{{$key->id}}">{{$key->category}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            {!! Form::label('image','Featured Image') !!}
                            <span class="btn btn-primary btn-file btn-sm">
                                <i class="fa fa-folder-open"></i>Upload Featured Image
                                {{Form::file('feature_image',['accept'=>"image/*",'id'=>'featureImage','class'=>'form-control', 'onchange'=>'loadFile(event)'])}}
                            </span>
                            <img id="preview" width="230px" class="show-img-bg">
                        </div>
                        <div class="col-md-12" >
                            <div class="form-group">
                                {{Form::label('Description')}}
                                {{Form::textarea('description','',['class'=>'form-control','id'=>'ckeditor'])}}
                            </div>
                        </div>
                    </div>
                    {{Form::submit('Create',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
