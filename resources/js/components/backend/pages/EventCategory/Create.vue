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
                                        <label for="">Event Category Name</label>
                                        <input type="text" name="event_category_name" class="form-control" v-model="inputData.event_category_name" placeholder="Event Category Name">
                                    </div>
                                </div><!--col-6 end-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Event Category Photo</label>
                                        <input type="file" name="event_cat_img" class="form-control">
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
           
            this.generalApi = 'event-category'
            this.backUrl = '/event-category'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'
            
            
            this.cardTitle = this.isEdit ? 'Edit Event Category' : 'Add Event Category'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.regions = res.data.regions
                this.smList = res.data.smList  
            })
           
        },

        methods:{
           
        },


    }

</script>