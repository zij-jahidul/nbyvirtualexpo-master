<template>
    <div>
        <div class="container mt-5">
          <div class="row">
              <div class="col-md-12">
                  <div class="card mb-5">
                      <div class="card-header bg-primary text-light">
                          <h3 class="text-center mb-0">Order Page</h3>
                      </div>
                      <div class="card-body">
                          <div class="row justify-content-center">
                              <div class="col-md-3 text-center">
                                  <div class="profile_image2 mb-4 mt-2">
                                      <img :src="this.imageUrl+'/person.png'" alt="stall-image" class="img-fluid profile_image">
                                  </div>
                                  <div class="profile_body">
                                      <p class="text-md-left text-center ml-3"><strong> Name :  {{user.name}} </strong></p>
                                      <p class="text-md-left text-center ml-3"><strong>Email :   {{user.email}} </strong></p>
                                  </div>
                              </div>
                              <div class="col-md-9">
                                  <table class="table table-bordered mt-2 table-responsive-md" style="width: 100%!important;">
                                      <tr>
                                          <th>SL No.</th>
                                          <th>Order Number</th>
                                          <th class="text-center">Quantity</th>
                                          <th>Order Date</th>
                                          <th>Total Price</th>
                                          <th>Action</th>
                                      </tr>

                                      <!-- v-for start -->
                                      <tr v-for="(order, index) in orders" :key="index">
                                          <td>{{ index+1 }}</td>
                                          <td>{{order.order_number}}</td>
                                          <td class="text-center">{{order.quantity}}</td>
                                          <td>{{order.created_at}}</td>
                                          <td>৳ {{order.amount}}</td>
                                          <td>
                                              <router-link :to="{name:'CustomerOrderDetails', params:{id:order.id}}"  class="btn btn-success btn-sm fa fa-eye" ></router-link>
                                              <router-link :to="{name:'CustomerInvoice', params:{id:order.invoice.id}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Invoice</router-link>
                                          </td>
                                      </tr>
                                      <!-- v-for end -->
                                  </table>
                              </div>
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

    data(){
        return {
            apiUrl : window.location.origin,
            carts:[],
            summary:[],
            orders:[],
            user:[],
            serial:0,
        }
    },

     created(){
        this.getOrders()
    },
    methods:{
        getOrders(){
            axios.get(this.apiUrl+'/api/order').then(response =>{
               this.orders  =response.data.data
               this.user    = response.data.user
            })
        }
    }

}
</script>

<style scoped>
.profile_maindiv {
  margin-top: 15%;
  border: 1px solid #ecdddd;
  text-align: center;
  padding-bottom: 30px;
  border-radius: 10px;
}

.profile_image {
  border-radius: 50%;
}
.card{
    border: 2px solid rgb(64 144 220);
    border-radius: 0.5rem;
}
.profile_image {
    border: 2px solid #4090dc;
}
th{
    text-align: center;
    background: rgb(64 144 220);
    color: white!important;
}
.table-bordered th, .table-bordered td{
    border: 1px solid black !important;
}

</style>
