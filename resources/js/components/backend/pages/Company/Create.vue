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
                                            <label for="">Event SubCategory</label>
                                            <v-select 
                                            :options="eventSubCategories" 
                                            :reduce="eventSubCategory => eventSubCategory.id" 
                                            label="event_sub_category_name" 
                                            v-model="inputData.event_sub_category_id" 
                                            placeholder="Select Event Sub Category Name"></v-select> 

                                            <input type="hidden" name="event_sub_category_id" v-model="inputData.event_sub_category_id">
                                    </div>
                                </div><!--col-6 end-->

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expire Date</label>
                                        <input type="date" name="company_expire_date" class="form-control" v-model="inputData.company_expire_date">
                                    </div>
                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" v-model="inputData.company_name" placeholder="Company Name">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Company Logo</label>
                                        <input type="file" name="company_img" class="form-control">
                                        <div class="mt-4" v-if="isEdit" v-html="showImage"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Company Description</label>
                                        <textarea id="l_name" name="company_description" type="text" class="form-control" rows="4" v-model="inputData.company_description" placeholder="Company Description"> </textarea>
                                    </div>
                                </div><!--col-6 end-->


                                

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
               eventSubCategories:[]
            }
        },
        created() {
           
            this.generalApi = 'company'
            this.backUrl = '/company'
            this.isFile = true
            this.isImage = 'image_path',
            
            
            this.cardTitle = this.isEdit ? 'Edit Company' : 'Add Company'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.eventSubCategories = res.data.eventSubCategories
            })
           
        },

        methods:{

        },


    }

</script>