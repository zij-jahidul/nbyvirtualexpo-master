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
                                        <label for=""> User Name </label>
                                        <select name="user_id" class="form-control" v-model="inputData.user_id">
                                            <option> -- Select User Name -- </option>
                                            <option>1</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Session Title</label>
                                        <input type="text" name="session_title" class="form-control" v-model="inputData.session_title" placeholder="Session Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Time Start</label>
                                        <input type="time" name="session_start_time" class="form-control" v-model="inputData.session_start_time">
                                    </div>


                                     <div class="form-group">
                                        <label for="l_name">Session Description</label>
                                        <textarea id="l_name" name="session_description" type="text" class="form-control" rows="4" v-model="inputData.session_description" placeholder="Session Description"> </textarea>
                                    </div>


                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for=""> Event Category Name </label>
                                        <select name="event_category_id" class="form-control" v-model="inputData.event_category_id">
                                            <option> -- Select Customer Name -- </option>
                                            <option>1</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Session By</label>
                                        <input type="text" name="session_by" class="form-control" v-model="inputData.session_by" placeholder="Session By">
                                    </div>

                                     <div class="form-group">
                                        <label for="">Time End</label>
                                        <input type="time" name="session_start_end" class="form-control" v-model="inputData.session_start_end">
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
               smList:[],

                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                regions:[],
            }
        },
        created() {
           
            this.generalApi = 'admin'
            this.backUrl = '/'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'
            
            
            this.cardTitle = this.isEdit ? 'Edit Webinar Meeting Room' : 'Add Webinar Meeting Room'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.regions = res.data.regions
                this.smList = res.data.smList  
            })
           
        },

        methods:{
            userIdGenerator(){

                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }

</script>