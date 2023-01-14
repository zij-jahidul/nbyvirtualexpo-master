<template>
        <div class="container mt-2 mb-5">
            <div class="row  justify-content-center">
                <div class="col-12">
                    <div class="card my-2">
                        <div class="card-header bg-primary">
                           <router-link :to="{name:'CustomerOrder'}" class="back_arrow" ><i class="fas fa-times"></i></router-link>
                            <h3 class="text-center text-white mb-0">My Orders</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="text-center mb-2">Shipping To</h4>
                                    <table class="table table-bordered address_table">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{singleOrder.user.name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{singleOrder.user.email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{singleOrder.shipping.phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{singleOrder.shipping.address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Area</th>
                                            <td>{{singleOrder.shipping.area}}</td>
                                        </tr>
                                        <tr>
                                            <th>Thana</th>
                                            <td>{{singleOrder.shipping.thana}}</td>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{singleOrder.shipping.district}}</td>
                                        </tr>
                                        <tr>
                                            <th>Post Code</th>
                                            <td>{{singleOrder.shipping.post_code}}</td>
                                        </tr>
                                        <tr>
                                            <th>landmarks</th>
                                            <td>{{singleOrder.shipping.landmarks}}</td>
                                        </tr>
                                        <tr>
                                            <th>Order Date</th>
                                            <td>{{singleOrder.created_at}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-9">
                                    <h4 class="text-center mb-2">Order Details</h4>
                                    <table class="table table-bordered table-responsive-md">
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Details</th>
                                            <!-- <th>Product Photo</th> -->
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        <tr v-for="orderDetails in singleOrder.order_details" :key="orderDetails.id">
                                            <td>{{ sl++ }}</td>
                                            <td>{{orderDetails.product_name}}</td>
                                            <!-- <td>Product Photo</td> -->
                                            <td style="text-align:center">{{orderDetails.quantity}}</td>
                                            <td> ৳ {{orderDetails.price}}</td>
                                            <td> ৳ {{orderDetails.price * orderDetails.quantity}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th class="text-info">Total Quantity</th>
                                            <th class="text-info">{{singleOrder.quantity}}</th>
                                            <th class="text-success">Grand Total</th>
                                            <th class="text-success">৳ {{singleOrder.amount}}</th>
                                        </tr>
                                    </table>
                                    <router-link :to="{name:'CustomerInvoice', params:{id:singleOrder.invoice.id}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Invoice</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>

import frmixin from '../../../src/mixin-frontend'
export default {
mixins:[frmixin],
name: "CustomerOrderDetails",

    data(){
        return {
            singleOrder: {},
            sl:1,
        }
    },
    methods:{
        getOrder(){
            let orderId = this.$route.params.id
            axios.get(this.url+'/api/order/'+orderId).then(response=>{
                this.singleOrder = response.data.data
                console.log(this.singleOrder)
            })
        }
    },
    created(){
       this.getOrder()
    }
}
</script>


<style scoped>
.address_table th, .address_table td{
   padding: 2px 5px !important;
}

.back_arrow:hover{
    text-decoration: none;
    color: darkcyan;
}
.back_arrow{
    position: absolute;
    margin-top: 5px;
    cursor: pointer;
    padding: 0 7px;
    border-radius: 5px;
    color: #fff;
    text-align: right !important;
    border: 1px solid white;
    right:5px;
}
.card{
    border: 2px solid rgb(64 144 220);
    border-radius: 0.5rem;
}
th{
    text-align: center;
}
</style>
