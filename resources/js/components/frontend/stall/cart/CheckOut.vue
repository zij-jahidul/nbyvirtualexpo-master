<template>
    <div>
        <div class="container mt-5" v-if="isCartShow">
            <div class="row justify-content-center" v-show="isCart">
                <div class="col-md-12">
                    <h3><router-link :to="{name:'StallDetails', params:{company_id: navigation.company_id, stall_id: navigation.stall_id, stall_name:navigation.stall_name}}"> <i class="fas fa-arrow-left text-customize"></i> </router-link> Check Out</h3>
                </div>
                <div class="col-md-8">
                    <!--loop starts-->
                    <div class="row mt-3 mb-3 single-cart_item" v-for="(cart, index) in carts" :key="index">
                        <div class="col-md-3 pt-3 pb-3 text-center">
                            <i @click="removeCartItem(cart.id)" class="fas fa-times  delete_icon-mobile d-block d-md-none"></i>
                            <img v-for="(image, index) in cart.product.image" :key="index" :src="productImageUrl+image.image" alt="image.image" v-if="index==0" class="img-fluid cart_image">
                        </div>
                        <div class="col-md-9 pt-3 pb-3">
                            <!--                                  <rotuer-link to="">-->
                            <i @click="removeCartItem(cart.id)" class="fas fa-times delete_icon d-none d-md-block"></i>
                            <!--                                  </rotuer-link>-->
                            <h5 class="product_name mt-2 mb-4 text-center text-md-left">{{cart.product.product_name}}</h5>
                            <div class="row">
                                <div class="col-md-4 text-center text-md-left">
                                    <p class="offer_price" v-if="cart.product.offer_price!=null">৳ {{cart.product.offer_price}}</p>
                                    <p class="offer_price" v-if="cart.product.offer_price==null">৳ {{cart.product.selling_price}}</p>
                                    <p class="selling_price" v-if="cart.product.offer_price!=null">৳ {{ cart.product.selling_price }}</p>
                                </div>
                                <div class="col-md-4  text-center text-md-left">
                                    <div class="cart-update-area">
                                        <button class="btn btn-sm btn-danger" @click="cart.quantity-- ; summaryUpdate(); updateCartQuantity(cart.quantity, cart.id)" :disabled="cart.quantity <= 1">-</button>
                                        <input type="number" min="1" :value="cart.quantity" class="cart-update-input form-control-sm">
                                        <button class="btn btn-sm btn-info-customize text-light" @click="cart.quantity++; summaryUpdate(); updateCartQuantity(cart.quantity, cart.id)"  >+</button>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2 mt-md-0">
                                    <p class="total_price" v-if="cart.product.offer_price!=null">৳ {{cart.product.offer_price * cart.quantity}}</p>
                                    <p class="total_price" v-if="cart.product.offer_price==null">৳ {{cart.product.selling_price * cart.quantity}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--loop ends-->
                </div>
                <div class="col-md-4">
                    <div class="summary-area card mt-3 mb-5">
                        <div class = "card-header text-white" style = "margin-top: -10px">
                            <h3 class="text-center">Order Summary</h3>
                        </div>
                        <div class="cart_list p-3">
                            <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <td>Item</td>
                                    <th>{{summary.quantity}}</th>
                                </tr>
                                <tr>
                                    <td>Sub Total</td>
                                    <th>{{summary.total}}</th>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <th>{{summary.total}}</th>
                                </tr>
                            </table>
                            <router-link to="/order-confirmation" class="btn btn-info-customize  text-light btn-block mt-3 mb-3">Proceed</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5" v-show="isCart == false">
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
            address:{},
            isCart: true,
            isCartShow:false,
            navigation:{},
            target_url: decodeURIComponent('#product_area'),
        }
    },
    created(){
        this.getCartItems()
        this.summaryUpdate()
    },
    methods:{
        getCartItems() {
            axios.get(this.apiUrl+'/api/get_cart_items').then(res=>{
                this.carts = res.data.data
                this.summaryUpdate()
                this.isCartShow=true
                if(this.carts.length == 0){
                    this.isCart = false
                }
               this.navigation.company_id = this.carts[0].company_id
               this.navigation.stall_id = this.carts[0].stall_id
               this.navigation.stall_name = this.carts[0].stall.stall_name.replace(/ /g, '-').toLowerCase()
                // console.log('this.navigation')
                // console.log(this.navigation)
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
        },
        // saveAddress(){
        //     axios.post(this.apiUrl+'/api/shipping-address', this.address).then(res=>{
        //         console.log(res.data)
        //     })
        //     //place order
        //     if(confirm('Are you sure?')){
        //         axios.post(this.apiUrl+'/api/order').then(res=>{
        //             //redirect
        //             $('#cartCount').text(0)
        //             this.$router.push({ name: 'OrderConfirm' })

        //         })
        //     }

        // }
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
    color: #0073C5;
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

.btn_color {
    background-color: #0073C5;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
.single-cart_item{
    border: 2px solid #0073C5;
    border-radius: 10px;
    margin-left: 0;
    width: 98% !important;
}
.cart-update-area{
    display: inline-flex;
    justify-content: center;
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
.address-area {
    width: 90%;
    margin: 25px auto 0;
}
.address-area input{
    margin: 5px 0;
}
.card-header{
    background: #0073C5;
}
.card{
    border: 2px solid #0073C5;
}
.btn-info-customize{
    background: #0073C5;
}
.text-customize{
    color: #0073C5;
}

@media (max-width: 767px){
    .cart_image{
        width: 250px;
    }
    .total_price{
        text-align: center !important;
        padding-right: 0;
    }
}
.delete_icon-mobile {
    cursor: pointer;
    padding: 5px 7px;
    background-color: #0073C5;
    border-radius: 33%;
    color: #fff;
    position: absolute;
    right: 0;
    top: 0;
}
body{
    overflow-x: hidden!important;
}
</style>
