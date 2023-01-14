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
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Stall Name</label>
                                                <v-select
                                                :options="stalls"
                                                :reduce="stalls => stalls.id"
                                                label="stall_name"
                                                v-model="inputData.stall_id"
                                                placeholder="Select Stall Name"></v-select>

                                                <input type="hidden" name="stall_id" v-model="inputData.stall_id">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Product Category</label>
                                                <v-select
                                                :options="productCategories"
                                                :reduce="productCategories => productCategories.id"
                                                label="category_name"
                                                v-model="inputData.product_category_id"
                                                 @input="onChangeProduct"
                                                placeholder="Select Product Category"></v-select>
                                                <input type="hidden" name="product_category_id" v-model="inputData.product_category_id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Product SubCategory</label>
                                                <v-select
                                                :options="productSubCategories"
                                                :reduce="productSubCategory => productSubCategory.id"
                                                label="sub_category_name"
                                                v-model="inputData.product_sub_category_id"
                                                placeholder="Select Product SubCategory"></v-select>
                                                <input type="hidden" name="product_sub_category_id" v-model="inputData.product_sub_category_id">
                                             </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Product Name</label>
                                                <input type="text" name="product_name" v-model="inputData.product_name" class="form-control"
                                                    placeholder="Product Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                                <label for="">Color</label>
                                                <input type="text" name="color" v-model="inputData.color" class="form-control"
                                                    placeholder="Product Color">
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Product Code</label>
                                                <input type="text" name="product_code" v-model="inputData.product_code" class="form-control"
                                                    placeholder="Product Code">
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Size</label>
                                                <input type="text" name="size" v-model="inputData.size" class="form-control"
                                                    placeholder="Product Size">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Sale Price</label>
                                                <input type="number" name="selling_price" class="form-control" v-model="inputData.selling_price" placeholder="Whole Sale Price">
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="">Offer Price</label>
                                                <input type="number" name="offer_price" v-model="inputData.offer_price" class="form-control"
                                                    placeholder="Offer Price">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                              <div class="form-group">
                                                    <label for="">Cost Price</label>
                                                    <input type="number" name="cost_price" class="form-control" v-model="inputData.cost_price" placeholder="Cost Price">
                                                </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="">Whole Sale Price</label>
                                                <input type="number" name="wholesale_price" class="form-control" v-model="inputData.wholesale_price" placeholder="Whole Sale Price">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="l_name">Product Description</label>
                                        <textarea id="l_name" name="description" type="text" class="form-control" rows="4" v-model="inputData.description" placeholder="Product Description"> </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Product Feature Image</label>
                                        <input type="file" name="product_img" class="form-control">
<!--                                        <div class="mt-4" v-if="isEdit"> <div class="float-left"><img class="rounded" style="width:100px; height:100px;" :src="inputData.image_path+product_img" alt=""> </div>-->
                                    </div>

                                    <div class="form-group">
                                        <label for="">Product Gallery</label>
                                        <input type="file" name="image[]" class="form-control" multiple>
                                        <div class="mt-4" v-if="isEdit"> <div class="float-left" v-for="(image, index) in inputData.images" :key="index"> <a href="javascript:void(0)" @click="deleteItem(inputData.id, image.id)"><i class="fa fa-times delete"></i></a> <img class="rounded" style="width:100px; height:100px;" :src="inputData.image_path+image.image" alt=""> </div> </div>
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
               stalls:[],
               productCategories:[],
               productSubCategories:[],
            }
        },
        created() {

            this.generalApi = 'product'
            this.backUrl = '/product'
            this.isFile = true
            this.isImage = 'images',

            this.cardTitle = this.isEdit ? 'Edit Stall Product' : 'Add Stall Products'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {

                this.stalls = res.data.stalls
                this.productCategories = res.data.productCategories


                console.log(this.stalls)
                console.log(this.productCategories)
            })

        },




        methods:{
            onChangeProduct(product_id){

              console.log(product_id);
              axios.get(this.url+'/api/get-sub-category?product_id='+product_id)
              .then(res => {
                  this.productSubCategories = res.data
                console.log(res.data);
              })

            }
        },


    }

</script>

<style scoped>
.delete{
        position: absolute;
    color: palevioletred;
}
</style>
