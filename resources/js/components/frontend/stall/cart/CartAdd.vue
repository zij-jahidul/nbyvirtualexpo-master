<template>

    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <!--loop starts-->
                <div class="row single-cart_item">
                    <div class="col-lg-12">
                        <div class = "row">
                            <div class="col-md-6">
                                <i class="fas fa-times delete_icontwo"></i>
                            </div>
                            <div class="col-md-6 text-right">
                               <strong>My Cart</strong>
                            </div>

                        </div>
                    </div>

                    <!-- V-for Start -->
                    <div class="col-lg-12 my-3">
                        <div class="row">
                            <div class="col-md-2">
                                <img :src="this.imgUrl+'product_1.jpg'" alt="image.image" class="img-fluid cart_image">
                            </div>

                            <div class="col-md-8">
                                <h5 class="product_name"> Product Name - Code</h5>
                                <p class="total_price">৳ 165 X 5</p>
                                <div class="cart-update-area">
                                    <button class="btn btn-sm btn-danger">-</button>
                                    <input type="number" min="1" class="cart-update-input form-control-sm">
                                    <button class="btn btn-sm btn-success">+</button>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <i class="fas fa-trash-alt delete_icon"></i>
                            </div>

                        </div>
                    </div>
                    <!-- V-for End -->
                    <div class="col-lg-12 my-3">
                        <div class="row">
                            <div class="col-md-2">
                                <img :src="this.imgUrl+'product_1.jpg'" alt="image.image" class="img-fluid cart_image">
                            </div>

                            <div class="col-md-8">
                                <h5 class="product_name"> Product Name - Code</h5>
                                <p class="total_price">৳ 165 X 5</p>
                                <div class="cart-update-area">
                                    <button class="btn btn-sm btn-danger">-</button>
                                    <input type="number" min="1" class="cart-update-input form-control-sm">
                                    <button class="btn btn-sm btn-success">+</button>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <i class="fas fa-trash-alt delete_icon"></i>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 my-3">
                        <div class="row">
                            <div class="col-md-2">
                                <img :src="this.imgUrl+'product_1.jpg'" alt="image.image" class="img-fluid cart_image">
                            </div>

                            <div class="col-md-8">
                                <h5 class="product_name"> Product Name - Code</h5>
                                <p class="total_price">৳ 165 X 5</p>
                                <div class="cart-update-area">
                                    <button class="btn btn-sm btn-danger">-</button>
                                    <input type="number" min="1" class="cart-update-input form-control-sm">
                                    <button class="btn btn-sm btn-success">+</button>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <i class="fas fa-trash-alt delete_icon"></i>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-12 mt-5">
                        <div class="cart_list">
                            <ul>
                                <li>
                                    <span class="span_left">Item</span>
                                    <span class="li_span_right"> 100 </span>
                                </li>

                                <li>
                                    <span class="span_left">Sub Total</span>
                                    <span class="li_span_right"> 100 </span>
                                </li>

                                <hr>
                                <li>
                                    <span class="span_left"><strong>Grand Total</strong></span>
                                    <span class="li_span_right"> <strong>৳ 100 </strong> </span>
                                </li>

                                <li>
                                    <router-link to ="/checkout-page" class="btn btn-primary btn-lg btn-block">Checkout</router-link>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!--loop ends-->
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
            
        }
    },
    created(){
        
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
}

.delete_icontwo {
    margin-top: 5px;
    cursor: pointer;
    padding: 5px 7px;
    background-color: red;
    border-radius: 33%;
    color: #fff;

}

.btn_color {
    background-color: #0073C5;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
.single-cart_item{
    border: 1px solid silver;
    border-radius: 10px;
    z-index: 99999 !important;
}
.cart-update-area{
    display: inline-flex;
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
</style>
