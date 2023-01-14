<template>
    <div style="position:relative">
        <div id="goto" style="margin-top: -55px;  position:absolute"></div>
        <div class="row h-100">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3 h-100" v-for="(product, index) in products" :key="index"  v-if="!product.isComplete">
                <div class="card single-product-area h-100">
                    <router-link :to="'/single-product/'+company_id+'/'+stall_id+'/'+product.id">
                        <img :src="productImageUrl+product.product_img" alt="Live Recording" class="img-fluid product-photo">
                    </router-link>

                    <span class="discount-offer" v-if="product.offer_price">{{product.selling_price - product.offer_price}}৳ OFF</span>
                    <h5 class="text-center">{{product.product_name}}</h5>
                    <div class="row">
                        <div class="col-8 text-center">
                            <p class="price">৳ <span v-if="product.offer_price">{{product.offer_price}}</span> <span v-else>{{product.selling_price}}</span>  <small v-if="product.offer_price" class="discount-price pl-3">৳
                                {{product.selling_price}}</small></p>
                        </div>
                        <div class="col-4 text-center">
                            <span class="fa fa-star checked"></span> 5
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import frmixin from '../../../../src/mixin-frontend'
export default {
mixins:[frmixin],
name: "Products",
    data(){
        return{

            products:{},
            stall_id:'',
            company_id:'',

        }
    },

    created() {
        let company_id = this.$route.params.company_id
        let stall_id = this.$route.params.stall_id
        setTimeout(() => {
            axios.get(this.url+'/api/products?company_id='+company_id+'&'+'stall_id='+stall_id).then(response=>{
                this.products = response.data.data;
                console.log('product', response.data.data)
            })
        }, 1000)


    },

    methods:{

    },


    mounted(){
        let company_id = this.$route.params.company_id
        let stall_id = this.$route.params.stall_id

        this.company_id = company_id
        this.stall_id = stall_id
        console.log('company_id', company_id);
        console.log('stall_id', stall_id);
    }
}
</script>

<style scoped>
.product-photo {
    width: 85% !important;

}
.price{
    color: #6abd47 !important;
}
.discount-price{
    color: red !important;
    text-decoration: line-through;
}
.price-area{
    display: flex;
    justify-content: center;
}
.card.single-product-area {
    border: 1px solid #f1f0f0;
    box-shadow: 0 0 2px silver;
    padding: 15px;
}
.fa-star.checked{
    color: gold;
}
.discount-offer {
    position: absolute;
    background: red;
    color: white;
    font-size: 10px;
    padding: 2px 5px;
    top: -1px;
    right: -1px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 5px;
    border-right: 1px solid #f1f0f0;
    border-top: 1px solid #f1f0f0;
}
</style>
