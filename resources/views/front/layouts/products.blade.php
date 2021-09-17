<div class="item">
    <div class="product-item">
        <a href="{{ route('product.show',$product->slug) }}" class="product-img">
            <img src="{{ product_image($product) }}" alt="">
            <div class="product-absolute-options">
                <span class="offer-badge-1">{{ product_price($product,'discount_percentage') }}% off</span>
                <span class="like-icon" title="wishlist"></span>
            </div>
        </a>
        <div class="product-text-dt">
            @if($product->quantity)
            <p>Available<span>(In Stock)</span></p>
            @else
            <p>Unavailable<span>(Out Of Stock)</span></p>
            @endif
            <h4>{{ $product->name }}</h4>
            <div class="product-price">
                {{ product_price($product,'new_price',true) }}<span>
                {{ product_price($product,'old_price',true) }}</span>
            </div>
            <div class="qty_section qty-cart">
                <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus minus-btn">
                    <input type="number" step="1" name="quantity" class="input-text now_quantity qty text" min="1"
                     value="{{ \Cart::get($product->id) != null ? \Cart::get($product->id)->quantity : 1}}">
                    <input type="button" value="+" class="plus plus-btn">
                </div>

                <button class="btn btn-info btn-xs new_btn add-to-cart-btn" attr-slug="{{ $product->slug }}" title="Add To Cart" >
                    Add To Cart</button>
            </div>
        </div>
    </div>
</div>
