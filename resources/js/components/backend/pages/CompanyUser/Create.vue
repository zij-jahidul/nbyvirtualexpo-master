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
                                            <label for="">Company Name</label>
                                            <v-select 
                                            :options="companies" 
                                            :reduce="company => company.id" 
                                            label="company_name" 
                                            v-model="inputData.company_id" 
                                            placeholder="Select Company"></v-select> 
                                            <input type="hidden" name="company_id" v-model="inputData.company_id" >
                                    </div>
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="">User Name</label>
                                            <v-select 
                                            :options="users" 
                                            :reduce="user => user.id" 
                                            label="name" 
                                            v-model="inputData.user_id" 
                                            placeholder="Select User Name"></v-select> 
                                            <input type="hidden" name="user_id" v-model="inputData.user_id">
                                    </div>
                                </div><!--col-6 end-->

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="">Event SubCategory</label>
                                            <v-select 
                                            :options="event_subcategories" 
                                            :reduce="event_sub_category => event_sub_category.event_sub_category_id" 
                                            label="event_sub_category_name" 
                                            v-model="inputData.event_sub_category_id" 
                                            placeholder="Select Event Sub Category Name"></v-select> 
                                            <input type="hidden" name="event_sub_category_id" v-model="inputData.event_sub_category_id" >
                                    </div>
                                </div>col-6 end -->

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
                companies:[],
                users:[],
                event_subcategories:[],
            }
        },
        created() {
           
            this.generalApi = 'company-user'
            this.backUrl = '/company-user'
            this.isFile = true
            this.isImage = 'image_path'
            
            this.cardTitle = this.isEdit ? 'Edit Company User' : 'Add Company User'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.companies           = res.data.companies
                this.users               = res.data.users
                this.event_subcategories = res.data.event_subcategories
            })
           
        },

        methods:{
        },


    }

</script>