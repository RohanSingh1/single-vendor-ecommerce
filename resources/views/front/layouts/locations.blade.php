    <div class="form-group has-info col-sm-2">
        <label for="province_id"
            class="control-label">Province *</label>
        <select class="form-control input-md "
            name="province_id" id="province_id">
            @if(!isset($data['province_id_now']))
            <option selected disabled> ----- Select Province ----- </option>
            @endif
            @foreach ($data['province_id'] as $value)
            <option value="{{ $value->id }}"
                @if(isset($data['province_id_now']))
                {{ $value->id == $data['province_id_now'] ? 'selected="selected"' : '' }}
                @elseif (isset($shipping_address) && $shipping_address->province_id == $value->id)
                {{ 'selected="selected"' }}
                @endif
                >
                {{ $value->name }}</option>
            @endforeach
        </select>
        <div
            class="help-block col-xs-12 col-sm-reset inline">
        </div>
        @error('province_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    @if(isset($data['province_id_now']) || isset($shipping_address))
    <div class="form-group has-info col-sm-2" >
        <label for="district_id"
            class="control-label">District *</label>
        <select class="form-control input-md "
            name="district_id" id="district_id">
            @if(!isset($data['district_id_now']))
            <option selected disabled> ----- Select District ----- </option>
            @endif
            @foreach ($data['district_id'] as $value)
            <option value="{{ $value->id }}"
                @if(isset($data['district_id_now']))
                {{ $value->id == $data['district_id_now'] ? 'selected="selected"' : '' }}
                @elseif (isset($shipping_address) && $shipping_address->district_id == $value->id)
                {{ 'selected="selected"' }}
                @endif
                >
                {{ $value->name }}</option>
            @endforeach
        </select>
        <div
            class="help-block col-xs-12 col-sm-reset inline">
        </div>
        @error('district_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endif


    @if(isset($data['district_id_now']) || isset($shipping_address))

    <div class="form-group has-info col-sm-4">
        <label for="locations"
            class="control-label">Locations *</label>
        <select class="form-control input-md "
            name="locations" id="locations">
            <option selected disabled> ----- Select Locations ----- </option>
            @foreach ($data['locations'] as $value)
            <option value="{{ $value->id }}" @if (isset($shipping_address) && $shipping_address->locations == $value->id)
                {{ 'selected="selected"' }}
                @endif>
                {{ $value->name }}</option>
            @endforeach
        </select>
        <div
            class="help-block col-xs-12 col-sm-reset inline">
        </div>
        @error('locations')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endif
<br>


