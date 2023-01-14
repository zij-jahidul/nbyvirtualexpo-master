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
                                                <label for="">Resource Name</label>
                                                <input type="text" name="name" v-model="inputData.name" class="form-control"
                                                       placeholder="Resource Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Resource File</label>
                                            <input type="file" name="resource_file_name" class="form-control">
                                            <!--                                        <div class="mt-4" v-if="isEdit"> <div class="float-left"><img class="rounded" style="width:100px; height:100px;" :src="inputData.image_path+product_img" alt=""> </div>-->
                                        </div>
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

        this.generalApi = 'stall-resource'
        this.backUrl = '/stall-resource'
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
