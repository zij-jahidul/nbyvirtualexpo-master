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
                                        <label for="">Category Name</label>
                                        <input type="text" name="category_name" v-model="inputData.category_name" class="form-control"
                                            placeholder="Category Name">
                                    </div>
                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="">Category Image</label>
                                        <input type="file" name="cat_img" class="form-control">
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
           
            this.generalApi = 'product-category'
            this.backUrl = '/product-category'
            this.isFile = true
            this.isImage = 'cat_img',
            
            this.cardTitle = this.isEdit ? 'Edit Product Categories' : 'Add Product Categories'


           
        },

        methods:{
        },


    }
</script>