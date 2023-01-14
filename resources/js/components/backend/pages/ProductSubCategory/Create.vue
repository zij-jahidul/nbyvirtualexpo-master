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
                                        <label for="">Product Category</label>
                                        <v-select 
                                        :options="productcategories" 
                                        :reduce="productcategory => productcategory.id" 
                                        label="category_name" 
                                        v-model="inputData.product_category_id" 
                                        placeholder="Select Product Category"></v-select> 

                                        <input type="hidden" name="product_category_id" v-model="inputData.product_category_id">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sub Category Image</label>
                                        <input type="file" name="sub_cat_img" class="form-control">
                                        <div class="mt-4" v-if="isEdit" v-html="showImage"></div>
                                    </div> 
 
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sub Category Name</label>
                                        <input type="text" name="sub_category_name" v-model="inputData.sub_category_name" class="form-control"
                                            placeholder="Enter Product Sub Category">
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
               productcategories:[],
            }
        },
        created() {
           
            this.generalApi = 'product-subCategory'
            this.backUrl = '/product-subCategory'
            this.isFile = true
            this.isImage = 'image_path',
            
            this.cardTitle = this.isEdit ? 'Edit Product Categories' : 'Add Product Categories'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
                this.productcategories = res.data.productcategory
            })
           
        },

        methods:{
            userIdGenerator(){

                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }
</script>