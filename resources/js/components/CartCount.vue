<template>
    <div>
        <a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart">
            <i class="uil uil-shopping-cart-alt"></i>
            <span>Cart</span><ins>{{ cartCount }}</ins><i class="uil uil-angle-down"></i>
        </a>
    </div>
</template>

<script>
export default {
    props:['cartCount'],
}
</script>
