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
                                        <label for="">Webinar</label>
                                        <input type="hidden" name="webinar_id" v-model="inputData.webinar_id"/>
                                       <v-select :options="webinarList" :reduce="webinar => webinar.id" label="meeting_id" v-model="inputData.webinar_id" placeholder="Select Webinar"></v-select>

                                    </div>

                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" v-model="inputData.name" placeholder="Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Designation</label>
                                        <input type="text" name="designation" class="form-control" v-model="inputData.designation">
                                    </div>


                                     <div class="form-group">
                                        <label for=""> Image Upload</label>
                                        <input type="file" name="image" class="form-control">
                                        <div class="mt-4" v-if="isEdit" v-html="showImage"></div>
                            
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
               smList:[],

                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                webinarList:[],
            }
        },
        created() {
           
            this.generalApi = 'webinar-user'
            this.backUrl = '/webinar-user'
            this.isFile = true
            this.isImage = 'image',
            
            
            this.cardTitle = this.isEdit ? 'Edit Webinar User' : 'Add Webinar User'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.webinarList = res.data.webinarList
                
            })
           
        },

        methods:{
            userIdGenerator(){

                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }

</script>