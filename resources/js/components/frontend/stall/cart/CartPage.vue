<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center" v-if="Object.keys(carts).length > 0">
                <div class="col-md-12">
                    <h3>Shopping Cart</h3>
                </div>
                    <div class="col-md-8">
                        <!--loop starts-->
                        <div class="row mt-3 mb-3 single-cart_item" v-for="(cart, index) in carts" :key="index">
                            <div class="col-md-3 pt-3 pb-3">
                                <img v-for="(image, index) in cart.product.image" :key="index" :src="cartImageUrl+image.image" alt="image.image" v-if="index==0" class="img-fluid cart_image">
                            </div>
                            <div class="col-md-9  pt-3 pb-3">
                                <!--                                  <rotuer-link to="">-->
                                <i @click="removeCartItem(cart.id)" class="fas fa-times delete_icon"></i>
                                <!--                                  </rotuer-link>-->
                                <h5 class="product_name mt-2 mb-4">{{cart.product.product_name}}</h5>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="offer_price" v-if="cart.product.offer_price!=null">৳ {{cart.product.offer_price}}</p>
                                        <p class="offer_price" v-if="cart.product.offer_price==null">৳ {{cart.product.selling_price}}</p>
                                        <p class="selling_price" v-if="cart.product.offer_price!=null">৳ {{ cart.product.selling_price }}</p>
                                    </div>
                                    <div class="col-4">
                                        <div class="cart-update-area">
                                            <button class="btn btn-sm btn-danger" @click="cart.quantity-- ; summaryUpdate(); updateCartQuantity(cart.quantity, cart.id)" :disabled="cart.quantity <= 1">-</button>
                                            <input type="number" min="1" :value="cart.quantity" class="cart-update-input form-control-sm">
                                            <button class="btn btn-sm btn-info text-light" @click="cart.quantity++; summaryUpdate(); updateCartQuantity(cart.quantity, cart.id)"  >+</button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <p class="total_price" v-if="cart.product.offer_price!=null">৳ {{cart.product.offer_price * cart.quantity}}</p>
                                        <p class="total_price" v-if="cart.product.offer_price==null">৳ {{cart.product.selling_price * cart.quantity}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--loop ends-->
                    </div>
                    <div class="col-md-4">
                        <div class="summary-area mt-3 mb-5">
                            <h3 class="text-center">Price</h3>
                            <div class="cart_list">
                                <ul>
                                    <li>
                                        <span class="span_left">Item</span>
                                        <span class="li_span_right"> {{summary.quantity}} </span>
                                    </li>

                                    <li>
                                        <span class="span_left">Sub Total</span>
                                        <span class="li_span_right"> {{summary.total}} </span>
                                    </li>

                                    <hr style="margin: 0 30px;">
                                    <li>
                                        <span class="span_left"><strong>Grand Total</strong></span>
                                        <span class="li_span_right"> <strong>৳ {{summary.total}} </strong> </span>
                                    </li>

                                    <li>
                                        <!-- <button class="btn btn-success btn-block">Order Confirm</button> -->
                                        <router-link to ="/checkout-page" class="btn btn-block btn-primary btn-lg text-light">Checkout</router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row justify-content-center mt-5" v-else>
                <h1 class="text-center text-danger">Cart is empty</h1>
            </div>
        </div>
    </div>

</template>

<script>
import frmixin from '../../../../src/mixin-frontend'
export default {
mixins:[frmixin],
    data(){
        return {
           
            apiUrl : window.location.origin,
            carts:[],
            summary:[],
           
        }
    },
    created(){
        this.url = this.url+'/frontend/assets/home-images/'
        this.getCartItems()
        this.summaryUpdate()
    },
    methods:{
        getCartItems() {
            axios.get(this.apiUrl+'/api/get_cart_items').then(res=>{
                this.carts = res.data.data
                this.summaryUpdate()
            })
        },
        summaryUpdate(){
            this.summary.total= 0;
            this.summary.quantity= 0;
            this.carts.forEach((cart , i)=>{
                if (cart.product.offer_price!=null){
                    this.summary.total += parseFloat(cart.product.offer_price)*parseFloat(cart.quantity)
                }else{
                    this.summary.total += parseFloat(cart.product.selling_price)*parseFloat(cart.quantity)
                }
                this.summary.quantity += parseFloat(cart.quantity);
            })
        },
        updateCartQuantity(quantity, cart_id){
            axios.put(this.apiUrl+'/api/cart/'+cart_id, {quantity:quantity}).then(res=>{
                console.log(res)
            })
        },
        removeCartItem(cart_id){
            if(confirm('Are you sure?')){
                axios.delete(this.apiUrl+'/api/cart/'+cart_id).then(res=>{
                    console.log(res)
                })
                this.getCartItems()
            }
        }
    },

}
</script>

<style scoped>
.title {
    border-bottom: 2px solid #F1F1F1;
    margin: 0 30px;
    padding-bottom: 10px;
}
.cart_list ul {
    list-style: none;
}
.cart_list ul li {
    padding: 10px 30px;
}

.cart_list .li_span_right {
    float: right;
}

.left_side {
    border: 2px solid #F1F1F1;
}
.right_side {
    border-left: 2px solid #F1F1F1;
    border-right: 2px solid #F1F1F1;
}
.cart_image {
    background-color: #F1F1F1;
    text-align: center;
    padding: 10px 5px;
    border: 1px solid silver;
    border-radius: 5px;
    vertical-align: middle;
}

.right_bar ul {
    list-style: none;
}
.right_bar ul li:first-child{
    margin-left: 0 !important;
}
.right_bar ul li {
    float: left;
    margin-left: 22%;
}

.product_name{
    font-size: 18px;
    font-weight: 500;
    line-height: 26px;
}

.offer_price {
    font-size: 22px;
    font-weight: 600;
}

.selling_price {
    text-decoration: line-through;
    color: red;
    font-size: 16px;
}
.total_price {
    font-size: 22px;
    font-weight: 600;
    text-align: right;
    padding-right: 5%;
    color: #6ABD48;
}

.delete_icon {
    cursor: pointer;
    padding: 5px 7px;
    background-color: #0073C5;
    border-radius: 33%;
    color: #fff;
    position: absolute;
    right: -1px;
    top: -1px;
}

/*.btn_color {*/
/*    font-size: 18px;*/
/*    font-weight: 500;*/
/*}*/
.single-cart_item{
    border: 1px solid silver;
    border-radius: 10px;
}
.cart-update-area{
    display: inline-flex;
}
input.cart-update-input {
    width: 50%;
    outline:none!important;
    border: 1px solid silver;
}
input.cart-update-input:focus {
    outline:none!important;
}
.summary-area{
    border: 1px solid silver;
    border-radius: 10px;
    padding-top: 10px;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
