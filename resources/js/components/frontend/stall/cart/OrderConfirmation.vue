<template>
    <div>
        <div class="container mt-5"  v-if="isCartShow">
            <div class="row justify-content-center" v-show="isCart">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-customize text-light">
                            <h3 class="mb-0 text-center"><router-link class="b_kule" :to="{name:'CheckOutPage'}"> <i class="fas fa-arrow-left"></i></router-link> Shipping Address</h3>
                        </div>
                        <div class="card-body">
                            <!--<h4 class="text-center">Choose Address or Add new</h4>-->
                            <!--<ul>-->
                            <!--     <li v-for="(shipping, index) in user.shipping" :key="index" class="list-group-item list-group-item-action">-->
                            <!--        <input class="address-select" type="radio" :value="shipping.id" @click="setAddressID" name="shipping"> {{shipping.address}}, {{shipping.thana}}, {{shipping.district}},  {{shipping.phone}},-->
                            <!--    </li>-->
                            <!--</ul>-->
                            <!--<button class="btn btn-success btn-block" @click="addNewAddress"><i class="fa fa-plus" aria-hidden="true"></i></button>-->

                            <div>
                                 <!--v-if="addressPlus"-->
                                <div class="row" id="new_address_form">
                                    <div class="col-6">
                                        <label>Name</label>
                                        <input type="text" readonly class="form-control" :value="user.name">
                                    </div>
                                    <div class="col-6">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input :class="{error_input : error}" id="phone_input" type="number" @keypress="numberValidation($event); isNumber($event); " class="form-control" v-model="address.phone" name="phone" placeholder="+880-123-XXX-XXXX">
                                        <small class="text-danger phone-error" v-if="error">{{ error_msg}}</small>
                                    </div>
                                </div>
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="address.address" name="address" placeholder="Address">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Area</label>
                                        <input type="text" class="form-control" v-model="address.area" name="area" placeholder="Area">
                                    </div>
                                    <div class="col-6">
                                        <label>Thana</label>
                                        <input type="text" class="form-control" v-model="address.thana" name="thana" placeholder="Thana">
                                    </div>
                                    <div class="col-6">
                                        <label>Select District <span class="text-danger">*</span></label>
<!--                                        <input type="text" class="form-control" v-model="address.district" name="district" placeholder="District">-->
                                        <v-select :options="districts" :reduce="district=>district.name" label="name" placeholder="Select district"  name="district" v-model="address.district">

                                        </v-select>
                                        <input type="hidden" name="district" v-model="address.district">
                                    </div>
                                    <div class="col-6">
                                        <label>Post Code</label>
                                        <input type="text" class="form-control" @keypress="isNumber2($event)" v-model="address.post_code" name="post_code" placeholder="ZIP">
                                    </div>
                                </div>
                                <label>Landmarks</label>
                                <textarea  class="form-control" v-model="address.landmarks" name="landmarks" placeholder="Landmarks"></textarea>
                            </div>
                        </div>
                        <div class="card-header bg-customize text-light">
                               <h3 class="mb-0 text-center">Payment Methods</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method" v-model="payment_method" value="Cash On Delivery" checked required> Cash On Delivery</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method" v-model="payment_method"  value="Mobile Banking"> Mobile Banking</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method" v-model="payment_method" value="Bank Transfer"> Bank Transfer</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method" v-model="payment_method" value="Card VISA/MasterCard"> Card VISA/MasterCard</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method" v-model="payment_method" value="Cheque"> Cheque</li>
                            </ul>
                            <button  class="btn bg-customize text-light btn-block mt-2 mb-2 review-order" @click="order_pre_confirm"><strong>Preview Order</strong></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-customize text-light">
                             <h3 class="mb-0 text-center">Order Summary</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <td>Item</td>
                                    <th>{{summary.quantity}}</th>
                                </tr>
                                <tr>
                                    <td>Sub Total</td>
                                    <th>৳  {{summary.total}}</th>
                                </tr>
                                <tr v-if="charges.shipping_cost!=0 && charges.shipping_cost!=null">
                                    <td>Shipping Cost</td>
                                    <th>৳ {{charges.shipping_cost}}</th>
                                </tr>
                                <tr v-if="charges.offer!=0 && charges.offer!=null">
                                    <td>Discount ({{charges.offer}}%)</td>
                                    <th>৳ {{charges_raw.offer}}</th>
                                </tr>
                                <tr v-if="charges.tax_cost!=0 && charges.tax_cost!=null">
                                    <td>Tax ({{charges.tax_cost}}%)</td>
                                    <th>৳ {{charges_raw.tax_cost}}</th>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <th>৳ {{summary.grandtotal}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5" v-show="isCart == false">
                <h1 class="text-center text-danger">Cart is empty</h1>
            </div>
        </div>


        <!-- Button trigger modal -->
        <button type="button" id="order_confirmation" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModalCenter">

        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Please Review Before Order</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row my-2 single-cart_item" v-for="(cart, index) in carts" :key="index">
                                <div class="col-md-3 pt-3 pb-3">
                                    <img v-for="(image, index) in cart.product.image" :key="index" :src="productImageUrl+image.image" alt="image.image" v-if="index==0" class="img-fluid cart_image">
                                </div>
                                <div class="col-md-9">
                                    <h5 class="product_name my-1">{{cart.product.product_name}}</h5>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="cart-update-area">
                                                Quantity : {{ cart.quantity }}
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p class="total_price" v-if="cart.product.offer_price!=null">৳ {{cart.product.offer_price * cart.quantity}}</p>
                                            <p class="total_price" v-if="cart.product.offer_price==null">৳ {{cart.product.selling_price * cart.quantity}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <h5>Shipping Details</h5>
                                <table class="table table-bordered table-striped table-hover popup-table">
                                    <tr>
                                        <td>Name</td>
                                        <th>{{user.name}}</th>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <th>{{address.phone}}</th>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <th>{{address.address}}</th>
                                    </tr>
                                    <tr>
                                        <td>Area</td>
                                        <th>{{address.area}}</th>
                                    </tr>
                                    <tr>
                                        <td>Thana</td>
                                        <th>{{address.thana}}</th>
                                    </tr>
                                    <tr>
                                        <td>District</td>
                                        <th>{{address.district}}</th>
                                    </tr>
                                    <tr>
                                        <td>Post Code</td>
                                        <th>{{address.post_code}}</th>
                                    </tr>
                                    <tr>
                                        <td>Landmarks</td>
                                        <th>{{address.landmarks}}</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <h5>Order Summary</h5>
                                <table class="table table-bordered table-striped table-hover popup-table">
                                    <tr>
                                        <td>Item</td>
                                        <th>{{summary.quantity}}</th>
                                    </tr>
                                    <tr>
                                        <td>Sub Total</td>
                                        <th>৳  {{summary.total}}</th>
                                    </tr>
                                    <tr v-if="charges.shipping_cost!=0 && charges.shipping_cost!=null">
                                        <td>Shipping Cost</td>
                                        <th>৳ {{charges.shipping_cost}}</th>
                                    </tr>
                                    <tr v-if="charges.offer!=0 && charges.offer!=null">
                                        <td>Discount ({{charges.offer}}%)</td>
                                        <th>৳ {{charges_raw.offer}}</th>
                                    </tr>
                                    <tr v-if="charges.tax_cost!=0 && charges.tax_cost!=null">
                                        <td>Tax ({{charges.tax_cost}}%)</td>
                                        <th>৳ {{charges_raw.tax_cost}}</th>
                                    </tr>
                                    <tr>
                                        <td>Grand Total</td>
                                        <th>৳ {{summary.grandtotal}}</th>
                                    </tr>
                                </table>
                                <h5>Selected Payment Method</h5>
                                <i class="fas fa-check-circle text-customize"></i> {{payment_method}}
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="confirmation_close" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-customize text-white" @click="saveAddress()">Confirm Order</button>
                    </div>
                </div>
            </div>
        </div>



    </div>

</template>

<script>
import vueSelect from 'vue-select'
export default {
    data(){
        return {
            apiUrl : window.location.origin,
            carts:[],
            summary:[],
            address:{},
            user: {},
            addressPlus: false,
            shippingAddressId: null,
            isCart: true,
            isCartShow:false,
            formError:{},
            districts: [],
            error: false,
            error_msg: null,
            navigation:{},
            confirm_order: true,
            payment_method:'Cash On Delivery',
            charges: [],
            charges_raw: [],
            productImageUrl: window.location.origin+'/public/frontend/assets/product-images/',
        }
    },
    created(){
        this.getCartItems()
        this.summaryUpdate()
        this.getUserInformation()
        this.getDistrict()
    },
    methods:{
        order_pre_confirm(){
            $('#order_confirmation').click()
        },
        getCartItems() {
            axios.get(this.apiUrl+'/api/get_cart_items').then(res=>{
                this.carts = res.data.data
                this.charges= res.data.charges
                this.summaryUpdate()
                this.isCartShow=true
                if(this.carts.length == 0){
                    this.isCart = false
                }
                this.navigation.company_id = this.carts[0].company_id
                this.navigation.stall_id = this.carts[0].stall_id
                this.navigation.stall_name = this.carts[0].stall.stall_name.replace(/ /g, '-').toLowerCase()
            })
        },
        getDistrict(){
            axios.get(this.apiUrl+'/api/district').then(res=>{
                this.districts =res.data
            })
        },
        summaryUpdate(){
            this.summary.grandtotal= 0;
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
            this.summary.grandtotal = this.summary.total
            if(this.charges.shipping_cost != 0 && this.charges.shipping_cost!=null) {
                this.summary.grandtotal += parseFloat(this.charges.shipping_cost)
            }
            if(this.charges.offer != 0 && this.charges.offer!=null){
               this.charges_raw.offer = this.summary.grandtotal * parseFloat(this.charges.offer) / 100
               this.summary.grandtotal -= this.charges_raw.offer
            }
            if(this.charges.tax_cost!=0 && this.charges.tax_cost!=null){
                this.charges_raw.tax_cost = this.summary.grandtotal * parseFloat(this.charges.tax_cost) / 100
                this.summary.grandtotal += this.charges_raw.tax_cost
            }
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
        setAddressID(event){
            this.shippingAddressId = event.target.value;
        },
        addNewAddress(){
            this.addressPlus= true
            $(".address-select").prop('checked', false)
            this.shippingAddressId = null
             this.address.shipping_address_id= null

        },
        saveAddress(){

            console.log(this.address)
            // axios.post(this.apiUrl+'/api/shipping-address', this.address).then(res=>{
            //     console.log(res.data)
            // })
            if(this.shippingAddressId!=null){
                this.address.shipping_address_id = this.shippingAddressId
            }else{
                // if(this.address.address == null || this.address.phone == null || this.address.thana== null || this.address.district==null){
                //     alert('* Marked Fields Are Required')
                //     e.preventDefault();
                // }
                // if (this.address.phone.length != 11){
                //     alert('* Phone Number Should 11 Digit')
                //     e.preventDefault();
                // }
                // if (this.address.post_code.length !=null && this.address.post_code.length != 4){
                //     alert('* Post Code Should 4 Digit')
                //     e.preventDefault();
                // }

            }

            //place order

            $('#mini_cart_close').click()
            axios.post(this.apiUrl+'/api/order', this.address).then(res=>{
                //redirect
                console.log(res.status)
                if (res.status == 200){
                    $('#cartCount').text(0)
                    $('#confirmation_close').click()
                    this.$router.push({ name: 'OrderConfirm' })
                }

            }).catch(error =>{

                if(error.response.status == 422){
                    $('#confirmation_close').click()
                    $('body, html').animate({
                        scrollTop: $('#new_address_form').offset().top-20
                    }, 600);
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('input[name="'+item+'"]')
                        let inputAfter = jQuery(document).find('input[name="'+item+'"] + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')
                    })
                }
            })

        },
        getUserInformation(){
            axios.get(this.apiUrl+'/api/frontend-user').then(res=>{
                this.user = res.data;
            })
        },
        isNumber2: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode < 48 || charCode > 57) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        numberValidation(evt){
           let yo = document.getElementById('phone_input').value
            if (yo.charAt(0) != 0 ){
                this.error = true;
                this.error_msg ='Phone number should stat with 0'
                 evt.preventDefault();
            }else{
                this.error = false;
            }
        },
        isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if(this.address.phone.length > 10){
                this.error = true;
                this.error_msg ='Phone number should 11 Digit'
                evt.preventDefault();
            }
            if (charCode < 48 || charCode > 57) {
                evt.preventDefault();
            } else {
                return true;
            }
        }

    }

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
    font-size: 16px;
    font-weight: 600;
    text-align: right;
    padding-right: 5%;
    color: #0073C5;
}

.delete_icon {
    cursor: pointer;
    padding: 5px 7px;
    background-color: red;
    border-radius: 33%;
    color: #fff;
    position: absolute;
    right: -1px;
    top: -1px;
}

.btn_color {
    background-color: #6ABD48;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
.single-cart_item{
    border-bottom: 1px solid silver;
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
label{
    margin-bottom: 0;
    margin-top: 10px;
}
.card{
    margin-bottom: 100px;
}
.list-group-item{
    cursor: pointer;
}
.phone-error {
    position: absolute;
}
.error_input{
    border: 1px solid red;
}
.b_kule{
    position: absolute;
    left: 3%;
}
.popup-table th, .popup-table td{
    font-size: 12px;
    padding: 2px;
}
.modal{
    z-index: 9999999!important;
}
.fa-arrow-left{
    color: white;
}
.card-body{
    border: 2px solid #0073C5!important;
}
.card-header{
    border-bottom: none!important;
}
ul{
    padding-left: 0!important;
}
.modal-header{
    background-color: #0073C5!important;
    color: white;
}
.modal-content{
    border: 3px solid #0073C5!important;
}
.modal-header .close {
    padding: .2rem .5rem;
    margin: 0;
    color: white;
    border: 1px solid white;
    border-radius: 5px;
}
.review-order{
    font-size: 18px;
}
.bg-customize{
    background: #0073C5;
}
.text-customize{
    color: #0073C5;
}
</style>
