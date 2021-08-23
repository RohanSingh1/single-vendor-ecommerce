<div wire:init="loadPosts">
    {{-- <div class="pop-model">
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog"  aria-labelledby ="addProduct" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Product Name</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body"> --}}
                        {{-- {!! Form::open(['action' => ['ProductController@store'],'method' => 'POST' ]) !!} --}}
                        <div class="row">
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Product Name')}}
                                    {{Form::text('product_name','',['class'=>'form-control','wire:model'=>'product_name'])}}
                                     @error('product_name') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Purchased Price')}}
                                    {{Form::number('purchased_price','',['class'=>'form-control','wire:model'=>'purchased_price'])}}
                                     @error('purchased_price') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Selling Price')}}
                                    {{Form::number('selling_price','',['class'=>'form-control','wire:model'=>'selling_price'])}}
                                     @error('selling_price') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Quantity')}}
                                    {{Form::number('quantity','',['class'=>'form-control','wire:model'=>'quantity'])}}
                                     @error('quantity') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Model Name')}}
                                    {{Form::text('model_no','',['class'=>'form-control','wire:model'=>'model_no'])}}
                                     @error('model_no') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>  
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Supplier Name')}}
                                    <select class="form-control" name="supplier_id" wire:model="supplier_id">
                                            @foreach($suppliers as $key)                                                
                                                <option value="{{$key->id}}" {{$loop->first ? 'selected' : ''}}>{{$key->supplier_name}}</option>
                                            @endforeach
                                    </select>
                                     @error('supplier_id') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Brand Name')}}
                                    <select class="form-control" name="brand_id" wire:model="brand_id">
                                            @foreach($brand as $key)                                                
                                                <option value="{{$key->id}}" {{$loop->first ? 'selected' : ''}} >{{$key->brand_name}}</option>
                                            @endforeach
                                    </select>
                                     @error('brand_id') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Category Name')}}
                                    <select class="form-control" name="category_id" wire:model="category_id">
                                            @foreach($category as $key)                                                
                                                <option value="{{$key->id}}" {{$loop->first ? 'selected' : ''}}> {{$key->category}}</option>
                                            @endforeach
                                    </select>
                                     @error('category_id') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    {{Form::label('Sub Category Name')}}
                                    <select class="form-control" name="sub_category_id" wire:model="sub_category_id">
                                        @foreach($subCategory as $key)                                                
                                            <option value="{{$key->id}}">{{$key->sub_category}} </option>
                                        @endforeach
                                    </select>
                                     @error('sub_category_id') <span class="error text-danger" wire:transition.fade.1s><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    {{Form::label('Description')}}
                                    {{Form::textarea('description','',['class'=>'form-control','id'=>'ckeditor','wire:model'=>'description'])}}
                                     @error('description') <span class="error text-danger"><small>{{ $message  }}</small></span> @enderror
                                </div>
                            </div>
                        </div>
                        {{Form::submit('Create',['class'=>'btn btn-primary','wire:click'=>'storeProduct','id'=>'store'])}}
                    </div>
                    @push('script')
                        <script>
                            $('#store').on('click',function(){
                                $('#ckeditor').attr('id','ckeditor');
                            });
                        </script>
                    @endpush
                        {{-- {!! Form::close() !!} --}}
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>   
        </div>                               
    </div> --}}
</div>
