<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="form" @submit.prevent>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3 class="my-4">Select Delivery District</h3>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Stall Name</label>

                            <v-select
                                @input="getStallDetails"
                                :options="stalls"
                                :reduce="stalls=> stalls.id"
                                label="stall_name"
                                v-model="stall_id"
                                placeholder="Select Stall"></v-select>
                            <input type="hidden" name="stall_id" v-model="stall_id">
                            <small v-if="error" class="text-danger">Please Select Stall</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>
                            <input type="checkbox" v-model="selectedAll" />
                            Select all
                        </label>
                    </div>
                    <div class="col-2" v-for="district in districts" :key="district.id">

                        <input type="checkbox" v-model="delivery_district" :value="district.id"/>
                        {{district.name}}
                    </div>
                    <div class="col-6">
                        <button  class="btn btn-success btn-block my-3" @click="saveDistricts">Save</button>
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
        return {
            apiUrl: window.location.origin,
            delivery_district:[],
            stall_id:'',
            stalls:[],
            districts:[],
            error: false,
            count: 64
        }
    },
    created(){
            this.getDistrictList()
            this.getStall()
    },
    computed: {
        selectedAll: {
            set(val) {
                this.delivery_district = []
                if (val) {
                    for(let i = 1; i <= this.count; i++) {
                        this.delivery_district.push(i)
                    }
                }
            },
            get() {
                return this.delivery_district.length === this.count
            }
        }
    },
    methods:{
        getDistrictList(){
            axios.get(this.apiUrl+'/api/delivery-district').then(res=>{
               this.districts = res.data
            })
        },
        getStall(){
            axios.get(this.apiUrl+'/api/get-delivery-stall').then(res=>{
                this.stalls = res.data
            })
        },
        getStallDetails(){
            this.error = false
            axios.get(this.apiUrl+'/api/delivery-district/'+this.stall_id).then(res=>{
                this.delivery_district = res.data
            })
        },
        saveDistricts(){
            axios.post(this.apiUrl+'/api/delivery-district', {district_id: this.delivery_district, stall_id:this.stall_id}).then(res=>{
                if (res.data.status=='success'){
                    this.toastMessage('success', res.data.message, '', 'top-right' )
                }else if (res.data.status=='cancel'){
                    this.toastMessage('error', res.data.message, '', 'top-right' )
                }

            })
        }
    }

}
</script>

<style scoped>

</style>
