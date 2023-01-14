<template>
  <div>
    <!-- Header Part Start -->
    <section id="header_part">
        <div class="container-fluid">

            <nav class="navbar navbar-expand-lg">
                <router-link class="navbar-brand" to="/">
                    <img :src="imageUrl+'logo.png'" alt="" class="img-fluid brand_logo ml-5">
                </router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon fas fa-bars bg-dark text-light"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" v-if="user !== null">
                    <ul class="navbar-nav m-auto">

                        <li class="nav-item dropdown" v-if="user.user.role == 'Customer' || user.user.role == 'Admin'">
                            <a class="nav-link dropdown-toggle text-dark hover_button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Exhibition Hall
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <router-link v-for="(cat, catIndex) in eventCategories" :key="catIndex" class="dropdown-item text-dark" :to="'/stall-page/'+cat.id+'/'+cat.event_sub_category_name.replace(/ /g, '-').toLowerCase()">{{ cat.event_sub_category_name }}</router-link>


                              <!-- <router-link class="dropdown-item text-dark" to="/stall-page/2" @click.native="getStall(2)">Premium Pavilion</router-link>
                              <router-link class="dropdown-item text-dark" to="/stall-page/3" @click.native="getStall(3)">Premium Mini Pavilion</router-link>
                              <router-link class="dropdown-item text-dark" to="/stall-page/4" @click.native="getStall(4)">Stall</router-link>
                              <router-link class="dropdown-item text-dark" to="/stall-page/5" @click.native="getStall(5)">Government Zone</router-link> -->


                            </div>
                        </li>



                        <li class="nav-item px-3" v-if="user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff'">
                            <router-link :class="this.$route.name == 'StallDetails'?'active':'hover_button'" class="nav-link" :to="'/stall-details/'+user.stall_owner.company_id+'/'+user.stall_owner.stall_id+'/'+user.stall_name">My Stall</router-link>
                        </li>
                        <li class="nav-item px-3">
                            <router-link :class="this.$route.name == 'EventRoom'?'active':'hover_button'" class="nav-link" to="/event-room">Event Room</router-link>
                        </li>

                        <li class="nav-item px-3" v-if="user.user.role == 'Customer' || user.user.role == 'Admin' || user.user.role == 'Secretary' || user.user.role == 'QueryAssistant'">
                            <router-link :class="this.$route.name == 'Lobby'?'active':'hover_button'" class="nav-link" to="/lobby">Lobby </router-link>
                        </li>

                        <li class="nav-item px-3">
                            <router-link :class="this.$route.name == 'Webinar'?'active':'hover_button'" class="nav-link" to="/webinar">Webinar</router-link>
                        </li>

                        <li class="nav-item px-3">
                            <router-link :class="this.$route.name == 'Blog'?'active':'hover_button'" class="nav-link" to="/blog-page">Media Center</router-link>
                        </li>

                    </ul>


                    <ul class="navbar-nav mr-5">
                        <li class="icon_li mt-2 mr-2 cart-icon-container class_li" @click="miniCart=true;  getCartItems()">
                            <!-- <router-link to="/cart-page">
                                  <i class="fas fa-shopping-cart cart_icon"></i>
                                <span class="cart_number text-info" id="cartCount">{{cartCount}}</span>
                            </router-link> -->

                            <i class="fas fa-shopping-cart cart_icon"></i>
                            <span class="cart_number text-info" id="cartCount">{{cartCount}}</span>
                        </li>


                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle hover_button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ user.user.name }}  [<small class="text-primary" v-text="user.user.role == 'Company'?'Exhibitor':(user.user.role == 'Customer'?'Visitor':user.user.role)"></small>]
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <router-link class="dropdown-item" to="/customer-profile">Profile</router-link>
                              <router-link class="dropdown-item" to="/customer-order">Order View</router-link>
                              <a class="dropdown-item" href="#" @click="signOut">Sign Out</a>
                            </div>
                          </li>

                    </ul>

                </div>
            </nav>

                <!--loop starts-->
                <div class="row single-cart_item" v-if="miniCart">
                    <div class="col-lg-12">
                        <div class = "row" style="background: #0073C5">
                            <div class="col-6 text-left mt-2 mb-2 text-white my-cart">
                                <strong>My Cart</strong>
                            </div>
                            <div class="col-6 text-right">
                                <i class="fas fa-times delete_icontwo"  @click="miniCart=false" id="mini_cart_close"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-mini-cart">
                    <!-- V-for Start -->
                        <div class="col-lg-12 my-3 product-loop-area"  v-for="(cart, index) in carts" :key="index">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <i class="fas fa-trash-alt delete_icon_mobile d-block d-md-none" @click="removeCartItem(cart.id)"></i>
                                    <img v-for="(image, index) in cart.product.image" :key="index" :src="productImageUrl+image.image" :alt="cart.product.product_name" v-show="index==0" class="img-fluid cart_image">
                                </div>
                                <div class="col-md-8 text-center mt-md-0 mt-3">
                                    <i class="fas fa-trash-alt delete_icon d-none d-md-block" @click="removeCartItem(cart.id)"></i>
                                    <h5 class="product_name"> {{cart.product.product_name}}</h5>
                                    <p class="offer_price" v-if="cart.product.offer_price!=null">৳ {{cart.product.offer_price}} X {{cart.quantity}}</p>
                                    <p class="offer_price" v-if="cart.product.offer_price==null">৳ {{cart.product.selling_price}} X {{cart.quantity}}</p>
                                    <p class="selling_price" v-if="cart.product.offer_price!=null">৳ {{ cart.product.selling_price }}</p>
                                    <!-- <p class="total_price">৳ 165 X 5</p> -->
                                    <div class="cart-update-area">
                                        <button class="btn btn-sm btn-danger" @click="cart.quantity-- ; summaryUpdate(); updateCartQuantity(cart.quantity, cart.id)" :disabled="cart.quantity <= 1">-</button>
                                        <input type="number" min="1" :value="cart.quantity" class="cart-update-input form-control-sm">
                                        <button class="btn btn-sm btn-success" @click="cart.quantity++; summaryUpdate(); updateCartQuantity(cart.quantity, cart.id)"  >+</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- V-for End -->

                    </div>

                    <div class="col-lg-12 mt-2">
                        <div class="cart_list">
                            <ul>
                                <li>
                                    <span class="span_left">Items</span>
                                    <span class="li_span_right"> {{summary.quantity}} </span>
                                </li>

                                <li>
                                    <span class="span_left">Sub Total</span>
                                    <span class="li_span_right">৳ {{summary.total}}  </span>
                                </li>

                                <hr class="mt-0 mb-0">
                                <li>
                                    <span class="span_left"><strong>Grand Total</strong></span>
                                    <span class="li_span_right"> <strong>৳ {{summary.total}} </strong> </span>
                                </li>

                                <li>
                                    <router-link @click.native="checkOutClick; miniCart=false" to ="/checkout-page" class="btn btn-primary btn-block mt-2">Checkout</router-link>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!--loop ends-->
        </div>
    </section>
   <!-- Header Part Start -->

  </div>
</template>

<script>
import mixin from '../../../src/mixin-frontend'
import { mapGetters } from 'vuex'
export default {
 mixins:[mixin],
props:['signOut'],
    data(){
        return {
            cartCount: 0,
            apiUrl: window.location.origin,
            miniCart: false,
            carts:[],
            summary:[],
            eventCategories:[]
        }
    },

    methods:{
        getCartItem(){
            axios.get(this.apiUrl+'/api/cart').then(res=>{
                this.cartCount=res.data.count
                console.log(res.data.count)
            })
        },
        getCartItems() {
            axios.get(this.apiUrl+'/api/get_cart_items').then(res=>{
                this.carts = res.data.data
                this.summaryUpdate()
                this.getCartItem()
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
                this.getCartItem()
            })
        },
        removeCartItem(cart_id){
            if(confirm('Are you sure?')){
                axios.delete(this.apiUrl+'/api/cart/'+cart_id).then(res=>{
                    console.log(res)
                })
                this.getCartItems()
                this.getCartItem()
                this.summaryUpdate()
            }
        },
        checkOutClick(){
            $('#cartCount').click()
            $('#mini_cart_close').click()
        }
    },

    computed:{
        ...mapGetters({
            user:'user'
        })
    },
    created(){
        axios.get(this.apiurl+'/api/stall-page?category_id='+this.$route.params.id)
        .then(response => {
            this.stalls = response.data.data
            console.log(response.data.data)
        })

        this.getCartItem()
        this.getCartItems()
        this.summaryUpdate()

        setTimeout(()=>{
            axios.get(this.url+'/api/frontend-event-sub-category')
            .then(res => {
                this.eventCategories = res.data.data

            })
        }, 1000)
    }


  }

</script>

<style scoped>


.cart_icon {
	font-size: 24px;
	color: #E12028;
}

.class_li {
    position: relative;
}
.cart_number {
	position: absolute;
	top: -15%;
	font-size: 18px;
}

.active{
    color:red !important;
    font-size: 18px;
}


.title {
    border-bottom: 2px solid #F1F1F1;
    margin: 0 30px;
    padding-bottom: 10px;
}
.cart_list ul {
    list-style: none;
}
.cart_list ul li {
    padding: 0 30px 0 0;
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
    width: 100%;
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

.product_name {
    font-size: 14px;
    font-weight: 500;
}

.offer_price {
    font-size: 22px;
    font-weight: 600;
}

.selling_price {
    text-decoration: line-through;
    color: red;
    font-size: 12px;
}
.total_price {
    font-size: 16px;
    color: #6ABD48;
    padding: 0;
    margin: 0;
}

.delete_icon {
    cursor: pointer;
    font-size: 20px;
    padding-top: 30%;
    color:#0073C5;
    position: absolute;
    top: -20%;
    right: 0
}
.delete_icon_mobile{
    cursor: pointer;
    font-size: 20px;
    color:#0073C5;
    position: absolute;
    top: 0;
    right: 13px;
}

.delete_icontwo {
    margin-top: 8px;
    cursor: pointer;
    padding: 5px 7px;
    border-radius: 5px;
    color: #fff;
    text-align: right !important;
    border: 1px solid white;
    right: 0;

}

.btn_color {
    background-color: red;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
.single-cart_item{
    border: 2px solid #0073C5;
    border-radius: 10px;
    z-index: 99999999;
    width: 30%;
    float:right;
    margin-right: 5px;
    max-height: 75vh;
    position: absolute;
    right: 10px;
    background: white;
}
@media only screen and (max-width:768px) and (min-width:501px){
    .single-cart_item{
        width: 50%;
         right: 0 !important;
    }
}

@media only screen and (max-width:500px){
    .single-cart_item{
        width: 98%;
        right: 0 !important;
        height: 100vh;
    }
}
.cart-update-area{
    display: inline-flex;
    justify-content: center;
}
input.cart-update-input {
    width: 20%;
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
.product-mini-cart{
    max-height: 40vh;
    overflow-Y: scroll;
    border-top: 2px solid rgb(221, 221, 221);
    border-bottom: 2px solid rgb(221, 221, 221)
}
.cart-icon-container{
    cursor: pointer;
}
.product-loop-area{
    padding-bottom: 15px;
    border-bottom:1px solid white;
}
.product-loop-area:last-of-type{
    border-bottom: none;
}
.offer_price {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 0px;
}
.selling_price {
    text-decoration: line-through;
    color: red;
    font-size: 12px;
}
span.navbar-toggler-icon.fas.fa-bars.bg-dark.text-light {
    padding-top: 4px;
    color: red !important;
    background: silver !important;
}
.my-cart{
    font-size: 18px;
}
@media screen and (max-width: 767px){
    .cart_image{
        width: 250px;
    }
    .cart-update-area{
        justify-content: center;
    }
}
</style>
