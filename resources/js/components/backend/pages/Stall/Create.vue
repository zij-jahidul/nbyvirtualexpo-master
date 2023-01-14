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
                                        :options="companyName" 
                                        :reduce="companyName => companyName.id" 
                                        label="company_name" 
                                        v-model="inputData.company_id" 
                                        placeholder="Select Company"></v-select>
                                        <input type="hidden" name="company_id" v-model="inputData.company_id"> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="">Stall Layout</label>
                                        <v-select 
                                        :options="stallLayout" 
                                        :reduce="stallLayout => stallLayout.id" 
                                        label="layout_name" 
                                        v-model="inputData.stall_layout_id" 
                                        placeholder="Select Layout"></v-select>
                                        <input type="hidden" name="stall_layout_id" v-model="inputData.stall_layout_id"> 
                                </div>
                            </div>

                    
                            <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="">Event SubCategory</label>
                                            <v-select 
                                            :options="eventSubCategories" 
                                            :reduce="eventSubCategories => eventSubCategories.id " 
                                            label="event_sub_category_name" 
                                            v-model="inputData.event_sub_category_id " 
                                            placeholder="Select Event Sub Category"></v-select> 
                                            <input type="hidden" name="event_sub_category_id" v-model="inputData.event_sub_category_id"> 
                                    </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="hidden" name="status" v-model="inputData.status">
                                        <v-select :options="status" :reduce="statu => statu.value" label="name" v-model="inputData.status" placeholder="Select Status"></v-select>
                                    </div>            
                                </div>
                            </div>

                            

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stall Name</label>
                                    <input type="text" name="stall_name" class="form-control" v-model="inputData.stall_name" placeholder="Stall Name">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" v-model="inputData.brand_name" placeholder="Brand Name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Manufacturer Name</label>
                                    <input type="text" name="manufacturer_name" class="form-control" v-model="inputData.manufacturer_name" placeholder="Manufacturer Name">
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                            
                                    <div class="form-group">
                                        <label for="">Open Time</label>
                                        <input type="time" name="open_time" class="form-control" v-model="inputData.open_time">
                                    </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Close Time</label>
                                    <input type="time" name="close_time" class="form-control" v-model="inputData.close_time">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stall Live Boardcust</label>
                                    <input type="text" name="stall_live_boardcust" class="form-control" v-model="inputData.stall_live_boardcust" placeholder="Stall Live Boardcust">
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stall Announcement</label>
                                    <input type="text" name="stall_announcement" class="form-control" v-model="inputData.stall_announcement" placeholder="Stall Announcement">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l_name">Stall Brochure</label>
                                    <input id="l_name" name="stall_brochure" type="file" class="form-control"  placeholder="Stall Brochure">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l_name">Stall Description</label>
                                    <textarea id="l_name" name="stall_description" type="text" class="form-control" rows="4" v-model="inputData.stall_description" placeholder="Stall Description"> </textarea>
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
               companyName: [],
               stallLayout: [],
               eventSubCategories: [],
                    status:[
                        {name:'Active',value:1},
                        {name:'Inactive',value:0}
                    ],
            }
        },
        created() {
           
            this.generalApi = 'stall'
            this.backUrl = '/stall'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'

            this.cardTitle = this.isEdit ? 'Edit Stall Product' : 'Add Stall Products'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
                this.companyName = res.data.companyName
                this.stallLayout = res.data.stallLayout
                this.eventSubCategories = res.data.eventSubCategories

                console.log(this.companyName)
                console.log(this.stallLayout)
                console.log(this.eventSubCategories)

            });
        },

        methods:{
            userIdGenerator(){

                this.inputData.user_id = "RS-VS-"+this.inputData.ffc  
        
            }
        },


    }

</script>