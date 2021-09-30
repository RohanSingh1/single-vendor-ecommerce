<div class="bs-canvas bs-canvas-left position-fixed bg-cart h-100">
    <div class="bs-canvas-header side-cart-header p-3 ">
        <div class="d-inline-block main-cart-title">My Cart <span class="cart_total_qty">({{ \Cart::getContent()->count()  }} Items)</span></div>
        <button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
    </div>
    <div class="bs-canvas-body">
        <div class="cart-top-total">
            {{-- <div class="cart-total-dil">
                <h4>Gambo Super Market</h4>
                <span>$34</span>
            </div> --}}
             @if (Cart::getContent()->count() > 0 && isset($shipping_address) && $shipping_address->from_valley == 'outside')
            <div class="cart-total-dil pt-2">
                <h4>Delivery Charges</h4>
                <span>{{ currency_type().$delivery_price }}</span>
            </div>
            @endif
        </div>
        <div class="side-cart-items">
            @php $savings = 0; @endphp
            @if (Cart::getContent()->count() > 0)
            @foreach($cart as $key=>$cart_item)
            @php
                $savings += product_price($cart_item->product,'discount_prices')*$cart_item->quantity;
            @endphp
            <div class="cart-item">
                <div class="cart-product-img">
                    <img src="{{ product_image($cart_item->product) }}" alt="{{ $cart_item->product->name }}">
                    <div class="offer-badge">{{ product_price($cart_item->product,'discount_percentage',true) }}% OFF</div>
                </div>
                <div class="cart-text">
                    <h4>{{ $cart_item->name }}</h4>
                    {{-- <div class="cart-radio">
                        <ul class="kggrm-now">
                            <li>
                                <input type="radio" id="a1" name="cart1">
                                <label for="a1">0.50</label>
                            </li>
                            <li>
                                <input type="radio" id="a2" name="cart1">
                                <label for="a2">1kg</label>
                            </li>
                            <li>
                                <input type="radio" id="a3" name="cart1">
                                <label for="a3">2kg</label>
                            </li>
                            <li>
                                <input type="radio" id="a4" name="cart1">
                                <label for="a4">3kg</label>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="qty-group">
                        <div class="quantity buttons_added qty_section">
                            <input type="button" value="-" class="minus minus-btn" attr-slug="{{ $cart_item->product->slug }}">
                            <input type="number" step="1" name="quantity" class="input-text now_quantity qty text "
                            name="quantity" min="1" value="{{ $cart_item->quantity }}">
                            <input type="button" value="+" class="plus plus-btn" attr-slug="{{ $cart_item->product->slug }}">
                            <button class="btn-xs btn-success add-to-cart-btn add-to-cart-btn cart-btn" title="Add To Cart" attr-slug="{{$cart_item->product->slug }}"
                                attr-wishlist_id="{{ $cart_item->id }}" attr-id="{{ $cart_item->product->id }}"
                                attr-slug="{{ $cart_item->product->slug }}" name="add-to-cart" title="Add to Carts">
                                <i class="uil uil-shopping-cart-alt"></i>
                            </button>
                        </div>
                        <div class="cart-item-price">{{ product_price($cart_item->product,'new_price',true) }}<span>
                            {{ product_price($cart_item->product,'old_price',true) }}</span></div>
                    </div>
                    <button type="button" class="cart-close-btn remove_items" attr_id="{{ $cart_item->id }}"><i class="uil uil-multiply"></i></button>
                </div>
            </div>
            @endforeach
                @else
                <div class="text-center">No items on cart.</div>
                @endif
        </div>
    </div>
             @if (Cart::getContent()->count() > 0)
    <div class="bs-canvas-footer">
        {{-- <div class="cart-total-dil saving-total ">
            <h4>Total Saving</h4>
            <span> {{ currency_type().' '.$savings }}</span>
        </div> --}}
        <div class="main-total-cart">
            <h2>Total</h2>
            <span>{{currency_type().' '.$cart_total }}</span>
        </div>
        <div class="checkout-cart">

            <a href="{{ route('front.checkout') }}" class="cart-checkout-btn hover-btn">Proceed to Checkout</a>

        </div>
    </div>
    @endif
</div>
