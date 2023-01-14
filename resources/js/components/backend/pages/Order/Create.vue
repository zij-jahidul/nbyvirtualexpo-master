<template>
    <div>
        <form class="form" @submit.prevent="processData()">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ cardTitle }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                   
                                    <div class="form-group">
                                            <label for="">Product Name</label>
                                            <v-select 
                                            :options="regions" 
                                            :reduce="region => region.product_id" 
                                            label="product_name" 
                                            v-model="inputData.product_id" 
                                            placeholder="Select Product"></v-select> 
                                    </div> 

                                    <div class="form-group">
                                        <label for="">Total Quantity</label>
                                        <input type="number" name="total_qty" v-model="inputData.total_qty" class="form-control"
                                            placeholder="Product Quantity">
                                    </div>
                                   
                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Customer Name </label>
                                        <select name="customer_id" class="form-control" v-model="inputData.customer_id">
                                            <option> -- Select Customer Name -- </option>
                                            <option>1</option>
                                        </select>
                                    </div>

                                     <div class="form-group">
                                        <label for="">Total Price</label>
                                        <input type="number" name="total_price" class="form-control" v-model="inputData.total_price" placeholder="Total Price">
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                           <FormButton :isEdit="isEdit" :backUrl="backUrl"></FormButton>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import mixin from '../../../../src/mixin';
    export default {
        mixins: [mixin],
        data(){
            return {
               smList:[],

                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                regions:[],
            }
        },
        created() {
           
            this.generalApi = 'admin'
            this.backUrl = '/order'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'
            
            
            this.cardTitle = this.isEdit ? 'Edit Stall Order' : 'Add Stall Order'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.regions = res.data.regions
                this.smList = res.data.smList  
            })
           
        },

        methods:{
            userIdGenerator(){

                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }

</script>
