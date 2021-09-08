@extends('backend.layouts.master')
@section('css')
    <link href="{{ asset('backend/plugins/bower_components/ion.rangeslider/css/ion.rangeSlider.css') }}"
          rel="stylesheet">
    <link href="{{ asset('backend/plugins/bower_components/ion.rangeslider/css/ion.rangeSlider.skinModern.css') }}"
          rel="stylesheet">
@endsection
@section('site_title')
    Setting
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('right_button')
@stop

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{route('admin.content-management.settings.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-footer">
                                <button type="submit" class="btn badge-success btn-outline-secondary">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label">Site Title<em class="asterisk">*</em></label>
                                            <input type="text" name="site_title"
                                                   value="{{old('site_title') ?? $site_title->text ?? ''}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Tagline</label>
                                            <input type="text" name="tagline"
                                                   value="{{old('tagline') ?? $tagline->text ??''}}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" name="address"
                                                   value="{{old('address') ?? $address->text ??''}}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Phone No</label>
                                            <input type="text" name="phone_no"
                                                   value="{{old('phone_no') ?? $phone_no->text ??''}}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Currency Symbol<em class="asterisk">*</em></label>
                                            <input type="text" name="currency_type"
                                                   value="{{old('currency_type') ?? $currency_type->text ?? ''}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">General Email<em
                                                    class="asterisk">*</em></label>
                                            <input type="email" name="ac_email"
                                                   value="{{old('ac_email')?? $ac_email->text ?? ''}}"
                                                   class="form-control">
                                        </div>

                                         <div class="form-group">
                                            <label class="control-label">Shipping Price<em
                                                    class="asterisk">*</em></label>
                                            <input type="number" name="shipping_price" min="1"
                                                   value="{{old('shipping_price')?? $shipping_price->text ?? ''}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Product Detail Info 1<em
                                                    class="asterisk">*</em></label>
                                            <input type="text" name="front_info1"
                                                   value="{{old('front_info1')?? $front_info1->text ?? ''}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Product Detail Info 2<em
                                                    class="asterisk">*</em></label>
                                            <input type="text" name="front_info2"
                                                   value="{{old('front_info2')?? $front_info2->text ?? ''}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Front Info 3<em
                                                    class="asterisk">*</em></label>
                                            <input type="text" name="front_info3"
                                                   value="{{old('front_info3')?? $front_info3->text ?? ''}}"
                                                   class="form-control">
                                        </div>



                                        <div class="form-group">
                                            <label class="control-label">Meta Title<em class="asterisk">*</em></label>
                                            <input type="text" name="meta_title"
                                                   value="{{old('meta_title') ?? $meta_title->text ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Enter Meta Title">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Meta Keyword<em class="asterisk">*</em></label>
                                            <input type="text" name="meta_keyword"
                                                   value="{{old('meta_keyword') ?? $meta_keyword->text ?? ''}}"
                                                   class="form-control" placeholder="Enter Meta Keyword">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Meta Description<em
                                                    class="asterisk">*</em></label>
                                            <textarea name="meta_desc" cols="30" rows="4" class="form-control"
                                                      placeholder="Enter meta description">{{old('meta_desc') ?? $meta_desc->text  ?? ''}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Footer Text<em
                                                    class="asterisk">*</em></label>
                                            <textarea name="footer_text" cols="30" rows="4" class="form-control"
                                                      placeholder="Enter meta description">{{old('footer_text') ?? $footer_text->text  ?? ''}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Miscellaneous Css</label>
                                            <textarea name="misc_css" cols="30" rows="4" class="form-control autosize-input"
                                                      placeholder="Enter Miscellaneous Css">{{old('misc_css' )?? $misc_css->text ?? ' '}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Miscellaneous JavaScript</label>
                                            <textarea name="misc_javascript" cols="30" rows="4" class="form-control autosize-input"
                                                      placeholder="Enter Miscellaneous JavaScript">{{old('misc_javascript' )?? $misc_javascript->text ?? ' '}}</textarea>
                                        </div>

                                        <h2>Coupon</h2>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label">Coupon Code<em
                                                        class="asterisk">*</em></label>
                                                <input type="text" name="coupon_code"
                                                       value="{{old('coupon_code')?? $coupon_code->text ?? ''}}"
                                                       class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Coupon Details<em
                                                        class="asterisk">*</em></label>
                                                <input type="text" name="coupon_details"
                                                       value="{{old('coupon_details')?? $coupon_details->text ?? ''}}"
                                                       class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="coupon_products">Select Product</label>
                                                <div >
                                                    @php $cat_array=[];  @endphp
                                                    @if(isset($coupon_products->text))
                                                        @foreach(unserialize($coupon_products->text) as $cc)
                                                            @php $cp = \App\Model\Product::find($cc); @endphp
                                                            @php $cat_array[] = $cp->id @endphp
                                                        @endforeach
                                                    @endif
                                                    <select name="coupon_products[]" id="coupon_products" multiple class="form-control select2">
                                                        @foreach(\App\Model\Product::get() as $cats)
                                                            <option {{ in_array($cats->id,$cat_array) ? 'selected="selected"' : '' }}
                                                                value="{{ $cats->id }}">{{$cats->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                @if ($errors->has('coupon_products'))
                                                <span class="help-block">
                                                    {{ $errors->first('coupon_products') }}
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Coupon Expiry Date<em
                                                        class="asterisk">*</em></label>
                                                <input type="date" name="coupon_ep"
                                                       value="{{old('coupon_ep')?? $coupon_ep->text ?? ''}}"
                                                       class="form-control">
                                            </div>

                                            <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            <h3>Logo </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {{--                                        <div id="image-holder" style="margin-bottom:15px;max-width:200px;">--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="input-group">--}}
                                        {{--                                            <span class="input-group-btn">--}}
                                        {{--                                                <a id="lfm" data-input="thumbnail" data-preview="image-holder"--}}
                                        {{--                                                   class="btn btn-primary">--}}
                                        {{--                                                    <i class="fa fa-picture-o"></i>--}}
                                        {{--                                                    Choose Image--}}
                                        {{--                                                </a>--}}
                                        {{--                                            </span>--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group">
                                            <input id="thumbnail" class="form-control" type="file"
                                                   name="site_logo_1"
                                                   value="">
                                        </div>
                                        @if(!empty($site_logo_1))
                                            <div id="img-preview">
                                                <img class="img-center" width="194" height="77"
                                                     src="{{asset($site_logo_1->file)}}"
                                                     alt="image preview" title="image preview">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            <h3>Footer Logo</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="image-holder-2" style="margin-bottom:15px;max-width:200px;">
                                        </div>
                                        <div class="input-group">
{{--                                            <span class="input-group-btn">--}}
{{--                                                <a id="lfm2" data-input="thumbnail2" data-preview="image-holder-2"--}}
{{--                                                   class="btn btn-primary">--}}
{{--                                                    <i class="fa fa-picture-o"></i>--}}
{{--                                                    Choose Image--}}
{{--                                                </a>--}}
{{--                                            </span>--}}
                                            <input id="thumbnail2" class="form-control" type="file"
                                                   name="site_logo_2"
                                                   value="">
                                        </div>
                                        @if(!empty($site_logo_2))
                                            <div class="" id="img-preview2">
                                                <img class=" img-center" width="194" height="77"
                                                     src="{{asset($site_logo_2->file)}}" alt="image preview"
                                                     title="image preview">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            <h3>Favicon</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="image-holder-3" style="margin-bottom:15px;max-width:200px;">
                                        </div>
                                        <div class="input-group">
{{--                                            <span class="input-group-btn">--}}
{{--                                                <a id="lfm3" data-input="thumbnail3" data-preview="image-holder-3"--}}
{{--                                                   class="btn btn-primary">--}}
{{--                                                    <i class="fa fa-picture-o"></i>--}}
{{--                                                    Choose Image--}}
{{--                                                </a>--}}
{{--                                            </span>--}}
                                            <input id="thumbnail3" class="form-control" type="file"
                                                   name="favicon"
                                                   value="">
                                        </div>
                                        @if(!empty($favicon))
                                            <div id="img-preview2">
                                                <img width="32" height="32" src="{{asset($favicon->file ?? '')}}"
                                                     alt="image preview" title="image preview">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            <h3>Ads Managesment</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="image-holder-3" style="margin-bottom:15px;max-width:200px;">
                                        </div>
                                        <div class="input-group">
{{--                                            <span class="input-group-btn">--}}
{{--                                                <a id="lfm3" data-input="thumbnail3" data-preview="image-holder-3"--}}
{{--                                                   class="btn btn-primary">--}}
{{--                                                    <i class="fa fa-picture-o"></i>--}}
{{--                                                    Choose Image--}}
{{--                                                </a>--}}
{{--                                            </span>--}}
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">बिज्ञापन 1</label>
                                            <input id="top_a1" class="form-control" type="file" name="top_a1">
                                            <input id="top_a1_link"  placeholder="बिज्ञापन 1 Link" class="form-control" type="text" name="top_a1_link">
                                        </div>
                                        @if(!empty($top_a1))
                                            <div id="img-preview">
                                                <a href="{{ asset($top_a1->file) }}" target="_blank"><img class="img-center" width="194" height="77"
                                                    src="{{asset($top_a1->file)}}"
                                                    alt="image preview" title="image preview"></a>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="control-label">बिज्ञापन 2</label>
                                            <input id="top_a2" class="form-control" type="file" name="top_a2">
                                            <input id="top_a2_link" placeholder="बिज्ञापन 2 Link" class="form-control" type="text" name="top_a2_link">
                                        </div>
                                        @if(!empty($top_a2))
                                            <div id="img-preview">
                                                <a href="{{ asset($top_a2->file) }}" target="_blank"><img class="img-center" width="194" height="77"
                                                    src="{{asset($top_a2->file)}}"
                                                    alt="image preview" title="image preview"></a>
                                            </div>
                                        @endif


                                    </div>

                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label">Facebook</label>
                                            <input type="url" name="facebook"
                                                   value="{{old('facebook') ?? $facebook->text ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Enter Facebook link">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Twitter</label>
                                            <input type="url" name="twitter"
                                                   value="{{old('twitter') ?? $twitter->text ?? ''}}"
                                                   class="form-control" placeholder="Enter Twitter link">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Youtube</label>
                                            <input type="url" name="youtube"
                                                   value="{{old('youtube')?? $youtube->text ?? ''}}"
                                                   class="form-control" placeholder="Enter Youtube link">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Google Plus</label>
                                            <input type="url" name="google_plus"
                                                   value="{{old('google_plus')?? $google_plus->text ?? ''}}"
                                                   class="form-control" placeholder="Enter Google Plus link">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Pinterest</label>
                                            <input type="url" name="pinterest"
                                                   value="{{old('pinterest')?? $pinterest->text ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Enter Pinterest link">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Instagram</label>
                                            <input type="url" name="instagram"
                                                   value="{{old('instagram')?? $instagram->text ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Enter Instagram link">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Linkedin</label>
                                            <input type="url" name="linkedin"
                                                   value="{{old('linkedin')?? $linkedin->text ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Enter Linkedin link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script
        src="{{ asset('plugins/bower_components/ion.rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
{{--    <script>--}}
{{--        // IMAGE SIZE--}}
{{--        $("#range_01").ionRangeSlider({--}}
{{--            min: 2,--}}
{{--            max: 100,--}}
{{--            from: {{ $image_post_max_size }}--}}
{{--        });--}}
{{--        $('#range_01').on('change', function () {--}}
{{--            var value = $(this).val();--}}
{{--            $('#image_size').val(value);--}}
{{--        });--}}

{{--        // FILE SIZE--}}
{{--        $("#file_size").ionRangeSlider({--}}
{{--            min: 2,--}}
{{--            max: 100,--}}
{{--            from: {{ $file_post_max_size }}--}}
{{--        });--}}
{{--        $('#file_size').on('change', function () {--}}
{{--            var value = $(this).val();--}}
{{--            $('#image_size').val(value);--}}
{{--        });--}}
{{--    </script>--}}
    {{-- <script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script> --}}

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('.select2').select2({placeholder: 'Select Options',width: 'resolve'});
            $('.product-list').select2({
                placeholder: 'Select Product',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('admin.search.product') }}",
                    dataType: 'json',
                    type: 'GET',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        return {
                            results: data
                        };
                    },
                    cache: true
                }

            });
        </script>

@endpush
