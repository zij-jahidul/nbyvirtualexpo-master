<template>

    <div>
        <section id="singleproduct_part">
            <div class="row justify-content-center">

                <div class="col-md-10 h-100">
                    <div class="row justify-content-center h-100">
                        <div class="col-md-5 h-100">
                            <div class="left-area h-100">
                                <div class="product_left">
                                    <div class="stall_subdiv mt-5">
                                        <img  :src="productImageUrl+singleImage" alt="image.image"  class="img-fluid productsingle_image">
                                    </div>
                                </div>
                                <div class="multiple_image">
                                    <div class="img_one">
                                        <carousel :autoplay="false" :navigation-enabled="true" :controls="true" :dots="true" :nav="false" :loop="false" :responsive="{600:{items:2},900:{items:4},1200:{items:4}}">
                                            <!-- :autoplaySpeed="1000" -->
                                             <img v-for="(image, index) in singleProduct.image" :key="index" :src="productImageUrl+image" alt="image.image"  @click="changeImage(image)" class="img-fluid multiple_image_one">
                                        </carousel>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 h-100">
                            <div class="product_right pt-5  h-100">
                                <div class="row bg-light p-5 product-content-area">
                                    <h2 class="text-info">{{singleProduct.product_name}}</h2>
                                    <table class="product-properties-table mt-3">
                                        <tr>
                                            <th>Product Code </th>
                                            <td>: {{singleProduct.product_code}}</td>
                                        </tr>
                                        <tr>
                                            <th>Brand Name</th>
                                            <td>: {{singleProduct.stall.brand_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>: {{singleProduct.category}}</td>
                                        </tr>
                                        <tr>
                                            <th>Sub Category</th>
                                            <td>: {{singleProduct.subCategory}}</td>
                                        </tr>
                                    </table>
                                    <h6 class="mt-3 mb-3">
                                        <span class="fa fa-star checked icon_color"></span>
                                        <span class="fa fa-star checked icon_color"></span>
                                        <span class="fa fa-star checked icon_color"></span>
                                        <span class="fa fa-star checked icon_color"></span>
                                        <span class="fa fa-star checked icon_color"></span> <span class="ratting_number">5.0 </span>
                                    </h6>
                                    <div class="price-area">
                                        <h3 class="offer_price mt-2 mr-3" v-if="singleProduct.offer_price != null">৳ {{singleProduct.offer_price}}</h3>
                                        <h3 class="offer_price mt-2 mr-3" v-if="singleProduct.offer_price == null">৳ {{singleProduct.selling_price}}</h3>
                                        <span class="selling_price mt-2 mb-2" v-if="singleProduct.offer_price != null">৳ {{singleProduct.selling_price}}</span>
                                    </div>
                                   <div class="action-area mt-5" v-if="user.user.role === 'Customer'">
                                        <button @click="addToCart" class="mr-3 btn-primary btn-lg">Add to Cart</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 mt-3">
                    <div class="row">
                        <div class="col-md-12 bg-light p-5">
                            <h4 class="mb-3 product_details_title">Product Details</h4>
                            <p class="para_one mb-4">{{singleProduct.description}}</p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Button trigger modal -->
            <button type="button" style="display: none" id="modal_launch" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h5 class="text-danger">Please Confirm Previous Stall's Order Or Clear Cart</h5>
                            <button type="button" class="btn btn-secondary" @click="clearCart">Clear Cart</button>
                            <button type="button" class="btn btn-primary" @click="checkout">Checkout</button>
                            <button type="button" class="btn btn-secondary d-none" id="modal_close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import carousel from 'vue-owl-carousel'
import { mapGetters } from 'vuex'
import frmixin from '../../../../src/mixin-frontend'
export default {
mixins:[frmixin],
    components: { carousel },
    data(){
        return {
            apiurl: window.location.origin,
            singleProduct: {},
            singleImage:'',
            cartCounter: '',
            showModal: false

        }
    },
    computed:{
        ...mapGetters({
            user:'user',
        })
    },
    methods:{
        getSingleProduct(){
            axios.get(this.apiurl+'/api/products/'+this.$route.params.id).then(res=>{
                this.singleProduct =res.data.data
                this.singleImage=this.singleProduct.product_img

            })
        },
        getCartItems(){
            axios.get(this.apiurl+'/api/cart').then(res=>{
                this.cartCounter= res.data.count
                //$('#cartCount').text(res.data.count)
                $('#cartCount').click()
            })
        },
        addToCart(){
            axios.post(this.apiurl+'/api/cart', {stall_id:this.singleProduct.stall_id, product_id:this.singleProduct.id, company_id:this.singleProduct.company_id}).then(res=>{
                this.getCartItems()
                if (res.data.status=='cancel'){
                    $('#modal_launch').click()
                }else{
                    this.toastMessage('success', res.data.message, '', 'top-center' )
                }
            })
        },
        clearCart(){
            axios.get(this.apiurl+'/api/cart_clear').then(res=>{
                this.toastMessage('success', res.data.message, '', 'top-center' )
                $('#modal_close').click()
                this.getCartItems()
            })
        },
        checkout(){
            $('#modal_close').click()
            this.$router.push({name:'CheckOutPage'})
        },
        changeImage(image){
            this.singleImage = image
        },
        toastMessage(type, message, icon, position, actionIcon){
            var toast = null;
            if(type == 'success'){
                toast = this.$toasted.success
            } else if(type == 'info'){
                toast = this.$toasted.info
            } else if(type == 'error'){
                toast = this.$toasted.error
            } else {

            }
            toast(message, {
                // theme:'bubble',
                position:position?position:'top-right',
                iconPack:'fontawesome',
                icon:icon?icon:'check',
                duration:2000,
                action: {
                    icon: actionIcon?actionIcon:'times',
                    class:'text-white',
                    onClick: (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                },
            });
        },

    },
    created(){
        this.getSingleProduct()
    },
    props:['cartCount']

}
</script>

<style scoped>

/*.btn_one {*/
/*    font-size: 20px;*/
/*    padding: 15px 30px;*/
/*    background-color: #0073C5;*/
/*    color: #fff;*/
/*    border-radius: 10px;*/
/*    margin-right: 10px;*/
/*}*/


#singleproduct_part {
    background-color: #EEEEEE;
    padding-bottom: 5%;
}
.product_left {
    background-color: #EEEEEE;
}

.product_right ul {
    list-style: none;
}
.product_right ul li h2 {
    padding: 0 0px 15px 0;
    line-height: 48px;

}
span {
    font-size: 18px;
}
.icon_color {
    color: #F7931E;
}
.ratting_number {
    font-size: 18px;
    margin-left: 10px;
}
.selling_price {
    text-decoration: line-through;
    font-size: 18px;
    color: rgb(214, 85, 85);
}
.product_right ul li .offer_price{
    font-size: 28px;
    font-weight: 700;
}

.multiple_image_one {
    width: 20% !important;
    margin-top: 2%;
    margin-right: 1%;
    margin-left: 1%;
    cursor: pointer;
}
.multiple_image_one:hover{
    box-shadow: 0 0 5px silver;
    transform: scale(1.1);
}

.product_details_title {
    color: #6ABD48;
}
.para_one {
    font-size: 18px;
}

.para_two {
    font-size: 18px;
}
.product-content-area{
    display: block;
}
.product-content-area p{
    margin-bottom: 0;
}
.product-properties-table th, td{
    padding: 2px 10px 2px 0;
}
.price-area {
    display: inline-flex;
}
.productsingle_image{
    width: 100%;
}
.owl-carousel .owl-item img {
    display: block;
    width: 100%!important;
}
</style>
