<template>
    <div>
        <div class="product-item">
            <a href="single_product_view.html" class="product-img">
                <img :src="p_image" alt="">
                <div class="product-absolute-options">
                    <span class="offer-badge-1">{{ discount_percentage }}% off</span>
                    <span class="like-icon" title="wishlist"></span>
                </div>
            </a>
            <div class="product-text-dt">
                <p v-if="product.quantity >0">Available<span>(In Stock)</span></p>
                <p v-else><span>(Out In Stock)</span></p>
                <h4>{{ product.name }}</h4>
                <div class="product-price">$ {{ old_price }} <span>{{ new_price }}</span></div>
                <div class="qty-cart">
                    <div class="quantity buttons_added">
                        <input type="button" value="-" class="minus minus-btn" @click="decreaseCounter">
                        <input type="number" step="1" name="quantity" v-model="now_quantity" class="input-text qty text">
                        <input type="button" value="+" class="plus plus-btn" @click="increaseCounter">
                    </div>
                    <span class="cart-icon"><i class="uil uil-shopping-cart-alt" @click="addToCart(product)"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                now_product:[],
                now_quantity:this.quantity,
            }
        },
        props:[
            'product','old_price','new_price','discount_percentage','discount_prices','p_image','quantity'
        ],
        mounted() {
            console.log('Component mounted.')
            console.log(this.quantity);
        },
        methods:{
            addToCart(now_product){
                bus.$emit('add-to-cart',this.product);
                console.log(this.now_quantity);
                axios.post('addToCart',{'now_products':now_product,'quantity':this.now_quantity})
                .then(res=>{console.log(res);})
                .catch(err=>{
                    console.dir(err)
            })
            },
            increaseCounter(){
            return this.now_quantity++;
        },
        decreaseCounter(){
                console.log();
                        return this.now_quantity--;
        }
        },

    }
</script>
