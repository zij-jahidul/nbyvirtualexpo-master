<template>
    <div class="container" v-if="isCartShow">
        <div class="row justify-content-center" v-show="isCart">
            <div class="col-md-12 my-5 text-center" v-if="order.order_number!=null">
                <h3 class="text-center mt-5 text-info">Your order placed Successfully!</h3>
                <h5 class="text-center">Order Number: <strong>{{order.order_number}}</strong> </h5>
                <router-link :to="{name:'Stall', params:{category_id:1, category_name:'premium-pavilion'}}"><button class="btn btn-info text-light">Continue Shopping</button></router-link>
            </div>
            <div class="col-md-12 my-5 " v-else>
                <h3 class="text-danger text-center">No Order Found</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {

  data(){
        return {
            url:window.location.origin,
            image:'',
            order: {},
            apiUrl : window.location.origin,
            isCart: true,
            isCartShow:false,
        }
    },
      created(){
         this.getOrderNumber()
      },
    methods:{
        getOrderNumber()
        {
            axios.get(this.apiUrl+'/api/get-order-number/').then(res=>{
                this.order =  res.data
                this.isCart= true
                this.isCartShow=true
            })
        },
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

.cart_image {
  background-color: #F1F1F1;
  text-align: center;
  padding: 10px 5px;
}

.product_name {
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
	padding: 8px 11px;
	background-color: red;
	border-radius: 50%;
	color: #fff;
	margin-top: 3%;
	float: right;
	margin-right: 10%;
}

</style>
