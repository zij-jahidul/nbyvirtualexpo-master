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
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" v-model="inputData.name">  

                                    </div>
                              
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" v-model="inputData.email">  
                                    </div>
                                    <div class="form-group">
                                        <label for="">Upload Photo</label>
                                        <input type="file" name="photo" class="form-control">  
                                    </div>
                                
                                   
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <v-select 
                                        :options="roles" 
                                        :reduce="role => role.role" 
                                        label="role" 
                                        v-model="inputData.role" 
                                        placeholder="Select Role"></v-select> 
                                        <input type="hidden" name="role" v-model="inputData.role">
                                     </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" v-model="inputData.password" placeholder="*******">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="">Password Confirm</label>
                                        <input type="password" name="password_confirm" class="form-control" v-model="inputData.password_confirm" placeholder="*******">
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
              roles:[
                  {'role':'Company'},
                  {'role':'GeneralStaff'},
                  {'role':'CustomerCare'},
                  {'role':'Secretary'},
                  {'role':'QueryAssistant'},
              ]
            }
        },
        created() {
           
            this.generalApi = 'user'
            this.backUrl = '/user'
            this.isFile = true
            this.isImage = 'photo'
            
            
            this.cardTitle = this.isEdit ? 'Edit User' : 'Add User'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               console.log(res.data.roles);
                // this.roles = res.data.roles
            })
           
        },

        methods:{
            userIdGenerator(){

                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }

</script>