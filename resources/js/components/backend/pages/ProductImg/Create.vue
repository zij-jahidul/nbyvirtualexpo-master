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
                                        placeholder="Select Product Name"></v-select> 
                                    </div>

                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Image</label>
                                        <input type="file" name="image" class="form-control" multiple>
                                        <div class="mt-4" v-if="isEdit" v-html="showImage"></div>
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
              
            }
        },
        created() {
           
            this.generalApi = 'product-image'
            this.backUrl    = '/product-image'
            this.isFile     = true
            this.isImage    = 'image_path'
            
            
            this.cardTitle = this.isEdit ? 'Edit Product Image' : 'Add Product Image'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
              
            })
           
        },

        methods:{

        },


    }

</script>