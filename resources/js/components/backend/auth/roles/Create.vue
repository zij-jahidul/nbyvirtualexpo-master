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
              
            }
        },
        created() {
           
            this.generalApi = 'role'
            this.backUrl = '/role'
            this.isFile = true
            this.isImage = 'image_path'
            
            
            this.cardTitle = this.isEdit ? 'Edit Role' : 'Add Role'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
             
            })
           
        },

        methods:{
            
        },


    }

</script>