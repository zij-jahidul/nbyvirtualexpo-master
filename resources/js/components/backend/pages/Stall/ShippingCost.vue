<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form" @submit.prevent>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h3 class="my-4">Select Delivery District</h3>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Stall Name</label>
                                <v-select
                                    @input="getCharges()"
                                    :options="stalls"
                                    :reduce="stalls=> stalls.id"
                                    label="stall_name"
                                    v-model="shipping.stall_id"
                                    placeholder="Select Stall"></v-select>
                                <input type="hidden" name="stall_id" v-model="shipping.stall_id">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Shipping Cost (Amount)</label>
                            <input type="number" v-model="shipping.shipping_cost" name="shipping_cost" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Tax (in %)</label>
                            <input type="number"   v-model="shipping.tax_cost" name="tax_cost" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Discount (in %)</label>
                            <input type="number"  v-model="shipping.offer" name="offer" class="form-control">
                        </div>
                        <div class="col-6">
                            <button  class="btn btn-success btn-block my-3" @click="saveShipping">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import mixin from '../../../../src/mixin';
export default {
    mixins: [mixin],
    data(){
        return{
            stall_id:'',
            stalls:[],
            apiUrl: window.location.origin,
            shipping:{},
            originalValue: [],
        }
    },
    created() {
        this.getStall()
    },
    methods: {
        getStall(){
            axios.get(this.apiUrl+'/api/get-delivery-stall').then(res=>{
                this.stalls = res.data
            })
        },
        saveShipping(){
            axios.post(this.apiUrl+'/api/delivery-charge', this.shipping).then(res=>{
                if (res.data.status=='success'){
                    this.toastMessage('success', res.data.message, '', 'top-right' )
                }else if (res.data.status=='cancel'){
                    this.toastMessage('error', res.data.message, '', 'top-right' )
                }

            })
        },
        getCharges()
        {
       if (this.shipping.stall_id != null){
           axios.get(this.apiUrl+'/api/delivery-charge/'+this.shipping.stall_id).then(res=>{
               if (res.data.msg !='notFound'){
                   this.shipping = res.data
               }
           })
       }

        }
    }
}
</script>
<style scoped>
.vs__clear{
    display: none;
}
</style>
