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
                                        <label for="">Adds Type</label>
                                        <input type="hidden" name="ads_type" v-model="inputData.ads_type">
                                       <v-select :options="adsType" :reduce="ads => ads.value" label="name" v-model="inputData.ads_type" @input="changeAdsType" placeholder="Select Type"></v-select>
                                    </div>


                                     <div class="form-group">
                                        <label for="">Adds Position</label>
                                        <input type="hidden" name="ads_position" v-model="inputData.ads_position">
                                       <v-select :options="adsPositions" :reduce="adsPosition => adsPosition.value" label="name" v-model="inputData.ads_position" placeholder="Select Position"></v-select>
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
                adsType:[
                    {name: 'Image',value: 0},
                    {name: 'Video',value: 1}
                ],
                adsPositions:[
                    {name: 'Home',value: 1},
                    {name: 'Loby-Center',value: 2},
                    {name: 'Loby-Right',value: 3},
                    {name: 'Loby-Left',value: 4},
                    {name: 'Loby-Bottom-Right',value: 5},
                    {name: 'Loby-Bottom-Left',value: 6},
                    {name: 'Exhibition-Center',value: 7},
                    {name: 'Exhibition-Right',value: 8},
                    {name: 'Exhibition-Left',value: 9},
                    {name: 'Exhibition-Bottom-Right',value: 10},
                    {name: 'Exhibition-Bottom-Left',value: 11},
                    {name: 'Event-Room',value: 12},
                ],
                status:[
                    {name:'Active',value:1},
                    {name:'Inactive',value:0}
                ],
                isAdsVideo:false,
                isAdsImage:false,
                video_link:[]
            }
        },
        created() {
           
            this.generalApi = 'ads'
            this.backUrl = '/ads'
            this.isFile = true
            this.isImage = 'image',
                     
            
            
            this.cardTitle = this.isEdit ? 'Edit  Ads' : 'Add  Ads'

            if(this.isEdit){
                    if(this.isImage){
                        this.isAdsImage = true
                        this.isAdsVideo = false
                    }
                    else if(this.video_link == 'null'){
                        this.isAdsVideo = true
                        this.isAdsImage = false
                    }

                }

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
               console.log(res.data);
                this.video_link = res.data
                console.log(video_link)
              
            })
           
        },

        methods:{
            changeAdsType(value){
                if(value == 0){
                   this.isAdsImage = true
                   this.isAdsVideo = false
                }
                else{
                    this.isAdsVideo = true
                    this.isAdsImage = false
                }
                console.log(value);
                
            },
            // imageVideo(){
               
            // }
        },


    }

</script>