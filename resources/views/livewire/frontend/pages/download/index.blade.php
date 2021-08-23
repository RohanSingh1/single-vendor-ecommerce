<div>
    <!-- DOWNLOAD FORM -->
    @include('inc.messages')
    <form class="needs-validation" wire:submit.prevent="submit">
        <div class="">
            <div class="row">
                <div class="col-md-4">
                    @if(!$confirm)
                        <div class="form-group">
                            <label>Quantity</label>
                            <div class="form-group--number">
                                <input class="form-control" type="number" placeholder="1" wire:model="quantity">
                                <button wire:click="increment" type="button" class="btn"><i class="fa fa-plus"></i>
                                </button>
                                <button wire:click="decrement" type="button" class="btn"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <!--<label for="">Payment type</label>-->
                        <!--<select name="paymentType" id="paymentType" class="form-control"-->
                        <!--        wire:change="paymentType($event.target.value)">-->
                        <!--    <option>Select One</option>-->
                        <!--    @foreach($paymentTypes as $item)-->
                        <!--        <option value="{{$item->id}}">{{$item->name}}</option>-->
                        <!--    @endforeach-->
                        <!--</select>-->
                    </div>
                </div>
                {{--            <div class="form-group">--}}
                {{--                <select name="countryId" id="" class="form-control" wire:model="countryId" required>--}}
                {{--                    <option value=" ">Select Country</option>--}}
                {{--                    @foreach($countries as $country)--}}
                {{--                        <option--}}
                {{--                            value="{{$country->id}}">{{$country->name}}</option>--}}
                {{--                    @endforeach--}}
                {{--                </select>--}}
                {{--            </div>--}}
                {{--            <div class="form-row">--}}
                {{--                <div class="col-md-12">--}}
                {{--                    <label class="pr-4 mb-0 shipping-text" for="shipping-text">Will--}}
                {{--                        you be needed shipping: </label>--}}
                {{--                    <div class="form-check form-check-inline">--}}
                {{--                        <input class="form-check-input" type="radio" checked--}}
                {{--                               id="inlineCheckbox1" name="shipping" value="1" wire:click="setShipping('1')">--}}
                {{--                        <label class="form-check-label"--}}
                {{--                               for="Shipping-Yes">Yes</label>--}}
                {{--                    </div>--}}
                {{--                    <div class="form-check form-check-inline">--}}
                {{--                        <input class="form-check-input" name="shipping" type="radio"--}}
                {{--                               id="inlineCheckbox2" value="0" wire:click="setShipping('0')">--}}
                {{--                        <label class="form-check-label" for="Shipping-No">No</label>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--            <div class="form-row mt-3 mb-3">--}}
                {{--                <div class="col-md-12">--}}
                {{--                    <textarea name="message" id="" class="form-control text-areas" cols="20" rows="3"--}}
                {{--                              placeholder="Message" wire:model="message"></textarea>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                <div class="col-md-12">
                    @if($confirm == true)
                        <h2>Are you sure you want to order this product? </h2>
                        <h3>Quantity: {{$quantity}}</h3>
                        <!--<h3>Payment Type:{{ $paymentType==1?'Cash on Delivery':'Bank' }}</h3>-->
                        <button type="button" class="btn-success " wire:click="confirm()"
                        >Confirm
                        </button>
                        <button type="submit" class="btn-danger "
                        >Cancel
                        </button>
                    @else
                        <button type="submit" class="g-recaptcha btn mb-0 "
                        >Order Now
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
