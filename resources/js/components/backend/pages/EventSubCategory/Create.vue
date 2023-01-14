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
                                            <label for="">Event Category</label>
                                            <v-select 
                                            :options="eventCategories" 
                                            :reduce="eventCategory => eventCategory.id" 
                                            label="event_category_name" 
                                            v-model="inputData.event_category_id" 
                                            placeholder="Select Event Category Name"></v-select> 
                                            <input type="hidden" name="event_category_id" v-model="inputData.event_category_id">
                                    </div>


                                    <div class="form-group">
                                        <label for="">Product Photo</label>
                                        <input type="file" name="event_sub_cat_img" class="form-control">
                                        <div class="mt-4" v-if="isEdit" v-html="showImage"></div>
                                    </div>

                                   
                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Event Sub Category Name</label>
                                        <input type="text" name="event_sub_category_name" class="form-control" v-model="inputData.event_sub_category_name" placeholder="Event Sub Category Name">
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
               eventCategories:[]
            }
        },
        created() {
            this.generalApi = 'event-subcategory'
            this.backUrl = '/event-subcategory'
            this.isFile = true
            this.isImage = 'image_path'
            
            
            this.cardTitle = this.isEdit ? 'Edit Event Sub Category' : 'Add Event Sub Category'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.eventCategories = res.data.eventCategories
                console.log(this.eventCategories)
            })
           
        },

        methods:{
            userIdGenerator(){
                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }

</script>