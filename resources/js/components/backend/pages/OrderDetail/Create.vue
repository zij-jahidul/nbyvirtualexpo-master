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
                                        <label for="">Oder ID</label>
                                        <input type="number" name="order_id" v-model="inputData.order_id" class="form-control"
                                            placeholder="Order ID">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Color</label>
                                        <input type="number" name="color" v-model="inputData.color" class="form-control"
                                            placeholder="Product Color">
                                    </div>

                                     <div class="form-group">
                                        <label for="">Product Price</label>
                                        <input type="number" name="product_price" v-model="inputData.product_price" class="form-control"
                                            placeholder="Product Price">
                                    </div>
                                   
                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Quantity</label>
                                        <input type="number" name="product_qty" v-model="inputData.product_qty" class="form-control"
                                            placeholder="Product Quantity">
                                    </div>

                                     <div class="form-group">
                                        <label for="">Size</label>
                                        <input type="text" name="size" v-model="inputData.size" class="form-control"
                                            placeholder="Product Size">
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
            this.backUrl = '/order-detail'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'
            
            
            this.cardTitle = this.isEdit ? 'Edit Stall Order Details' : 'Add Stall Order Details'

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
