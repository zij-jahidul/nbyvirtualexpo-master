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
                                        <input type="hidden" name="company_id" v-model="inputData.company_id">
                                        <v-select 
                                        :options="companies" 
                                        :reduce="company => company.id" 
                                        label="company_name" 
                                        v-model="inputData.company_id" 
                                        placeholder="Select Company"></v-select> 


                                    </div>
                                </div><!--col-6 end-->

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">User Name</label>
                                        <input type="hidden" name="user_id" v-model="inputData.user_id">
                                        <v-select 
                                        :options="users" 
                                        :reduce="user => user.id" 
                                        label="name" 
                                        v-model="inputData.user_id" 
                                        placeholder="Select User Name"></v-select> 
                                    </div>
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="">Event Category</label>
                                        <input type="hidden" name="event_category_id" v-model="inputData.event_category_id">
                                        <v-select 
                                        :options="event_categories" 
                                        :reduce="event_category => event_category.id" 
                                        label="event_category_name" 
                                        v-model="inputData.event_category_id" 
                                        placeholder="Select Event Category Name"></v-select> 
                                     </div>
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Blog Title</label>
                                        <input type="text" name="title" class="form-control" v-model="inputData.title" placeholder="Blog Title">
                                    </div>
                                </div><!--col-6 end-->

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Topic</label>
                                        <input type="text" name="tropic" class="form-control" v-model="inputData.tropic" placeholder="Blog Topic">
                                    </div>
                                </div><!--col-6 end-->

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Live Broadcust</label>
                                        <input type="text" name="live_broadcust" class="form-control" v-model="inputData.live_broadcust" placeholder="Live Broadcust">
                                    </div>
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea id="l_name" name="description" type="text" class="form-control" rows="4" v-model="inputData.description" placeholder="Description"> </textarea>
                                    </div>
                                </div><!--col-6 end-->


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Feature Image</label>
                                        <input type="file" name="feature_image" class="form-control">
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
               
                companies       : [],
                regions         : [],
                event_categories: [],
                users           : []
            }
        },
        created() {
           
            this.generalApi = 'blog'
            this.backUrl = '/blog'
            this.isFile = true
            this.isImage = 'feature_image'
            this.inputData.password = 'RS-1234'
            
            
            this.cardTitle = this.isEdit ? 'Edit Blog' : 'Add Blog'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.companies        = res.data.companies
                this.event_categories = res.data.event_categories
                this.users            = res.data.users

                console.log(this.companies)  
                console.log(this.event_categories)  
                console.log(this.users)  
            })
           
        },

        methods:{
            
        },


    }

</script>