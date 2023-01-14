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
                                        <label for="">Stall Name</label>
                                        <v-select 
                                        :options="stalls" 
                                        :reduce="stall => stall.id" 
                                        label="stall_name" 
                                        v-model="inputData.stall_id" 
                                        placeholder="Select Stall Name"></v-select> 
                                        <input type="hidden" name="stall_id" v-model="inputData.stall_id">
                                    </div>


                                    <div class="form-group">
                                        <label for="">Adds Position</label>
                                        <input type="hidden" name="ads_position" v-model="inputData.ads_position">
                                       <v-select :options="adsPositions" :reduce="adsPosition => adsPosition.value" label="name"  @input="changeAdsType" v-model="inputData.ads_position" placeholder="Select Position"></v-select>
                                    </div>


                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                    <div class="form-group" v-if="isAdsVideo">
                                            <label for="video_link">Video Link</label>
                                            <input  type="text" id="video_link" name="video_link" class="form-control" v-model="inputData.video_link" placeholder="e.g.https://www.youtube.com/04554dd">
                                    </div>
                                    <div class="form-group" v-if="isAdsImage">
                                        <label for=""> Image Upload</label>
                                        <input type="file" name="image" class="form-control">
                                        <div class="mt-4" v-if="isEdit" v-html="showImage"></div>
                            
                                    </div>   
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="hidden" name="status" v-model="inputData.status">
                                       <v-select :options="status" :reduce="statu => statu.value" label="name" v-model="inputData.status" placeholder="Select Status"></v-select>
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
               stalls:[],   
                  adsPositions:[
                    {name: 'Center',value: 1},
                    {name: 'Sponsor',value: 2},
                    {name: 'Right Side Small',value: 3},
                    {name: 'Right Side Big',value: 4},
                    {name: 'Left Side Small',value: 5},
                    {name: 'Left Side Big',value: 6}
                ],
                 status:[
                    {name:'Active',value:1},
                    {name:'Inactive',value:0}
                ],
                isAdsVideo:false,
                isAdsImage:false,
            }
        },
        created() {
            this.generalApi = 'stall-ads'
            this.backUrl = '/stall-ads'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'

            this.cardTitle = this.isEdit ? 'Edit Stall Ads' : 'Add Stall Ads'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
                this.stalls = res.data.stalls
                console.log('stall', res.data.stalls)
            })
           
        },

        methods:{
            changeAdsType(value){
                if(value == 1){
                   this.isAdsImage = false
                   this.isAdsVideo = true
                }
                else{
                    this.isAdsVideo = false
                    this.isAdsImage = true
                }
                console.log(value);
                
            },
        },


    }

</script>