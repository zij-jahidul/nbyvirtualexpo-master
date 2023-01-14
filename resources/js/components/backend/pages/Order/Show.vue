<template>
    <div class="container mt-2 mb-5">
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header">
                        <router-link :to="{name:'Order'}" class="back_arrow" ><h3 style="display:inline-flex"><i class="fas fa-arrow-left"></i></h3></router-link>    <h3 class="text-center mb-0"><span class="text-success">#{{order.order_number}}</span> Order Details</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="text-center mb-0">shipping_address To</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered address_table">
                            <tr>
                                <th>Name</th>
                                <td>{{order.user.name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{order.user.email}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{order.shipping.phone}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{order.shipping.address}}</td>
                            </tr>
                            <tr>
                                <th>Area</th>
                                <td>{{order.shipping.area}}</td>
                            </tr>
                            <tr>
                                <th>Thana</th>
                                <td>{{order.shipping.thana}}</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>{{order.shipping.district}}</td>
                            </tr>
                            <tr>
                                <th>Post Code</th>
                                <td>{{order.shipping.post_code}}</td>
                            </tr>
                            <tr>
                                <th>landmarks</th>
                                <td>{{order.shipping.landmarks}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{order.created_at}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="text-center mb-0">Order Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justified-content-center">
                           <div class="col-12">
                               <div class="update-area">
                                   <span>Status Update</span>
                                       <v-select :options="status_option" :reduce="order_status=>order_status.id" label="name" placeholder="Select Status"  name="status" v-model="status">

                                       </v-select>
                                   <input type="hidden" name="status" v-model="status">
                                   <button class="btn btn-success" @click="statusUpdate"> Update</button>
                               </div>
                           </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Product Details</th>
                                <!-- <th>Product Photo</th> -->
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                            <tr v-for="(orderDetails, index) in order.order_details" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{orderDetails.product_name}}</td>
                                <!-- <td>Product Photo</td> -->
                                <td>{{orderDetails.quantity}}</td>
                                <td> ৳ {{orderDetails.price}}</td>
                                <td> ৳ {{orderDetails.price * orderDetails.quantity}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th class="text-info">Total Quantity</th>
                                <th class="text-info">{{order.quantity}}</th>
                                <th class="text-success">Grand Total</th>
                                <th class="text-success">৳ {{order.amount}}</th>
                            </tr>
                        </table>
<!--                        <router-link :to="{name:'CustomerInvoice', params:{id:order.invoice.id}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Invoice</router-link>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return{
            order:{},
            apiUrl: window.location.origin,
            status:null,
            status_option: [
                {
                    id: 1,
                    name: 'Pending',
                },
                {
                    id: 2,
                    name: 'Processing',
                },
                {
                    id: 3,
                    name: 'Delivered',
                },
                {
                    id: 4,
                    name: 'Cancelled',
                },

            ]

        }
    },
    methods:{
        getOrder(){
            let orderId =this.$route.params.id
            axios.get(this.apiUrl+'/api/back/order/'+orderId ).then(res=>{
                this.order = res.data.data
                this.status = this.order.order_status
                console.log(this.order)
            })
        },
        statusUpdate(){
            axios.post(this.apiUrl+'/api/update-order-status/'+this.order.id, {order_status:this.status}).then(res=>{
                this.toastMessage('success', res.data.message, '', 'top-right' )
            })
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
        this.getOrder()
    }
}
</script>

<style scoped>
.address_table th, .address_table td{
    padding: 2px 5px !important;
}
.back_arrow {
    position: absolute;
}
.back_arrow:hover{
    text-decoration: none;
    color: darkcyan;
}
.update-area{
    text-align: center;
    width: 100%;
    display: inline-flex;
    margin-bottom: 10px;
    justify-content: center;
}
.update-area span {
    margin-top: 5px;
    margin-right: 10px;
}
.form-control{
    width: 25%;
    margin-right: 10px;
}
</style>
