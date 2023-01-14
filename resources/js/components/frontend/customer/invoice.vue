<template>
   <div class="container" style="margin-bottom: 100px">
       <div class="row justify-content-center">
           <div class="col-md-8">
               <div class="card mt-5">
                   <div class="card-header bg-primary text-light">
                       <h3 class="mb-0"><img :src="image_url+invoice.order.stall.company.company_img" class="img-responsive img-fluid company-logo" alt="Logo" width="75px"> {{invoice.order.stall.stall_name}}</h3>
                       <span class="back_arrow" @click="$router.go(-1)">
                           <i class="fas fa-times"></i>
                       </span>
                   </div>
                   <div class="card-body p-5">
                       <h3 class="text-center invoice-number mb-0">Invoice No# {{invoice.invoice_number}}</h3>
                       <div class="row">
                           <div class="col-md-6 text-md-left text-center">
                               <h4>From</h4>
                               <h6 class="mt-4"><strong>{{invoice.order.stall.stall_name}}</strong></h6>
                           </div>
                           <div class="col-md-6 text-md-light text-center">
                               <h4>To</h4>
                               <h6><strong>{{invoice.user.name}}</strong></h6>
                               <p class="mb-0">{{invoice.user.email}}</p>
                               <p class="mb-0">{{invoice.order.shipping.phone}}</p>
                               <p class="mb-0">{{invoice.order.shipping.address}}</p>
                               <p class="mb-0">{{invoice.order.shipping.area}}</p>
                               <p>{{invoice.order.shipping.thana}}, {{invoice.order.shipping.district}} - {{invoice.order.shipping.post_code}}</p>
                           </div>
                       </div>
                       <table class="table table-bordered table-responsive-md">
                           <tr style="background: silver" class = "bg-primary">
                               <th>SL</th>
                               <th>Description</th>
                               <th>Unit Price</th>
                               <th>Quantity</th>
                               <th width="150px">Amount</th>
                           </tr>
                           <tr  v-for="(product, index) in invoice.order.order_details" :key="index">
                               <td>{{index+1}}</td>
                               <td>{{product.product_name}}</td>
                               <td>{{product.price}} Tk.</td>
                               <td style="text-align:center">{{product.quantity}}</td>
                               <td>{{product.price * product.quantity}} Tk.</td>
                           </tr>
                           <tr border="none">
                               <td colspan="2" style="border: none!important;"></td>
                               <td colspan="2">Quantity</td>
                               <td>{{ invoice.order.quantity }}</td>
                           </tr>
                           <tr>
                               <td colspan="2" style="border: none!important;"></td>
                               <td colspan="2">Discount</td>
                               <td>{{ invoice.order.offer }} Tk.</td>
                           </tr>
                           <tr>
                               <td colspan="2" style="border: none!important;"></td>
                               <td colspan="2">Shipping Charge</td>
                               <td>{{ invoice.order.shipping_cost }} Tk.</td>
                           </tr>
                           <tr>
                               <td colspan="2" style="border: none!important;"></td>
                               <td colspan="2">Tax</td>
                               <td>{{ invoice.order.tax_cost }} Tk.</td>
                           </tr>
                           <tr>
                               <td colspan="2" style="border: none!important;"></td>
                               <td colspan="2">Grand Total</td>
                               <td>{{invoice.order.amount}} Tk.</td>
                           </tr>
                       </table>

                   </div>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
export default {
    name: "invoice",
    data(){
        return{
            logoUrl: window.location.origin+'/frontend/assets/home-images/logo.png',
            invoice : [],
            url: window.location.origin,
            image_url: window.location.origin+'/frontend/assets/company/'
        }
    },
    created() {
        this.getInvoice()
    },
    methods: {
        getInvoice() {
            axios.get(this.url+'/api/invoice/'+this.$route.params.id).then(response =>{
                this.invoice= response.data
            })
        }
    }
}
</script>

<style scoped>
.back_arrow {
    position: absolute;
}
.back_arrow:hover{
    text-decoration: none;
    color: darkcyan;
    cursor: pointer;
}
.card{
    border: 2px solid rgb(64 144 220);
    border-radius: 0.5rem;
}

th{
    text-align: center;
    background: rgb(64 144 220);
    color: white!important;
}
.table-bordered th, .table-bordered td{
    border: 1px solid black !important;
}
.back_arrow{
    position: absolute;
    right: 5px;
    top: 0;
}
.invoice-number {
    margin-top: -25px;
}
.back_arrow{
    margin-top: 5px;
    cursor: pointer;
    padding: 0 7px;
    border-radius: 5px;
    color: #fff;
    text-align: right !important;
    border: 1px solid white;
    right:5px;
}
.company-logo {
    background: white;
    border-radius: 5px;
    padding: 10px;
}
</style>
