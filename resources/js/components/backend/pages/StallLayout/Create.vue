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
                                <div class="col-md-6" v-if="firstFormShow">
                                    <div class="form-group">
                                        <label for="">Event SubCategory</label>
                                        <v-select
                                            :options="event_sub_categories"
                                            :reduce="event_sub_category => event_sub_category.id"
                                            label="event_sub_category_name"
                                            v-model="inputData.event_sub_category_id"
                                            placeholder="Select Event Sub Category Name"></v-select>
                                        <input type="hidden" name="event_sub_category_id" v-model="inputData.event_sub_category_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select Company</label>
                                        <v-select
                                            :options="companies"
                                            :reduce="company => company.id"
                                            label="company_name"
                                            v-model="inputData.company_id"
                                            placeholder="Select Company"
                                            @input="getCompanyDetails(inputData.company_id)"
                                        >
                                        </v-select>
                                        <input type="hidden" name="company_id" v-model="inputData.company_id">
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="firstFormShow">
                                    <div class="row">
                                        <div class="col-6 stall-image-area" v-for="(stall,index) in stalls" :key="index">
                                            <label>
                                                <input  type="radio"  :value="stall" name="layout_img" :checked="stall==inputData.layout_image"   @change="getLayoutImage(stall)" >
                                                <img  :src="imgUrl+stall" alt="Stall-Image" class="img-fluid stall-img mb-2" width="150px">
                                            </label>
                                        </div>
                                    </div>
<!--                                    <p class="btn btn-success" @click="nextStep" v-text="buttonValue"></p>-->
                                </div>
                            </div>
                                <div class="row" v-if="formShow">
                                    <div class="col-md-6">
                                        <img v-if="layout_selected_image"  :src="imgUrl+layout_selected_image" alt="Stall-Image"  v-bind:style="{ background: inputData.layout_color}" class="img-fluid stall-img-single mb-2" width="100%">
                                        <img v-if="layout_selected_image" :src="companyLogoUrl+companyLogo" alt="Company Logo" class="company_logo">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Layout Name</label>
                                            <input type="text" name="layout_name" v-model="inputData.layout_name" class="form-control"
                                                placeholder="Layout Name">
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <input type="hidden" name="company_id" v-model="inputData.company_id" class="form-control"
                                                       placeholder="Layout Name">
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <colour-picker
                                                v-model="inputData.layout_color"
                                                label="Pick Colour"
                                                picker="chrome"
                                                name="layout_color"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <label for="l_name">Layout Description</label>
                                            <textarea id="l_name" name="layout_description" type="text" class="form-control" rows="4" v-model="inputData.layout_description" placeholder="Layout Description"> </textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Layout Size</label>
                                            <input type="text" name="layout_size" v-model="inputData.layout_size" class="form-control"
                                                placeholder="Layout Size">
                                        </div>
<!--                                         <div class="form-group">-->
<!--                                            <label for="">Layout Image</label>-->
<!--                                            <input type="file" name="layout_img" class="form-control">-->
<!--                                            <div class="mt-4" v-if="isEdit" v-html="showImage"></div>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer" v-if="formShow">
                           <FormButton :isEdit="isEdit" :backUrl="backUrl"></FormButton>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    let global_company_id;
    import mixin from '../../../../src/mixin';
    import  ColourPicker  from 'vue-colour-picker'
    export default {
        mixins: [mixin],
        components: {
            'colour-picker': ColourPicker
        },
        data(){
            return {
               smList:[],
                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                companyDataInput: [],
                company_id : '',
                event_sub_categories:[],
                companies:[],
                colour: '#000000',
                formShow : true,
                firstFormShow: true,
                stalls : [
                    'stall.jpeg',
                    'Stall_01.PNG',
                ],

                imgUrl : window.location.origin+'/public/frontend/assets/stall/',
                apiUrl : window.location.origin,
                layout_select: '',
                layout_selected_image: '',

                inputData:{
                   company_id: this.company_id,
                },
                companyLogo : '',
                companyName : '',
                companyLogoUrl : window.location.origin+'/public/frontend/assets/company/',
                layoutSelection: '',
                buttonValue: 'Next'
            }
        },
        methods:{
            getLayoutImage(stall){
                this.layout_selected_image= stall
            },
            flushData(){
                return global_company_id
            },
            layoutTrigger(event){
                $(document).find('.layout_select').trigger('click')
            },
            getCompanyDetails(id)
            {
                axios.get(this.url+'/api/get_company_details/'+id).then(response =>{
                    this.companyLogo=response.data.company_img
                })
            }

        },
        created() {
            this.generalApi = 'stall-layout'
            this.backUrl = '/stall-layout'
            this.isFile = true
            this.isImage = 'image_path'
            this.cardTitle = this.isEdit ? 'Edit Stall Layout' : 'Add Stall Layout'
            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
                this.event_sub_categories = res.data.event_sub_category
                this.companies = res.data.companies
            })
            if(this.isEdit==true){
                this.layoutSelection= 1
            }



        },
        mounted() {
            setTimeout(() => {
                this.getLayoutImage(this.inputData.layout_image)
                this.getCompanyDetails(this.inputData.company_id)
            }, 2000)
        },
        watch:{
            company_id: function (val) {
                this.inputData.company_id =  val
            },
        }

    }
</script>
<style>
.company_logo {
    position: absolute;
    left: 51%;
    transform: translate(-56%, 45px);
    width: 100px;
}
.compnay-name {
    position: absolute;
    top: 16%;
    left: 50%;
    transform: translate(-50%, 0);
}
.input-group-addon{
    position: absolute;
    right: 0;
}
</style>
