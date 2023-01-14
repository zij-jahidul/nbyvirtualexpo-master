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
                                        <label for="">Topic*</label>
                                        <input type="text" name="topic" v-model="inputData.topic" class="form-control" placeholder="e.g.My Meeting" required
												data-validation-required-message="This field is required">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Description </label>
                                        <textarea name="description" v-model="inputData.description" id="textarea" class="form-control" required
												placeholder="description"></textarea>
                                    </div>
                                    <div class="form-group">
										<label>
											<input @click="isShowing = false" class="select_schedule" type="radio" name="select_schedule" value="1" checked>
											<strong>Single Class</strong>
										</label>
										<label>
											<input @click="isShowing = true" class="select_schedule" type="radio" name="select_schedule" value="2">
											<strong>Recurring Class</strong>
										</label>
									</div>
                                </div><!--col-6 end-->
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">When Start (Date)</label>
                                        <input type="date" name="start_date" class="form-control" v-model="inputData.start_date">
                                    </div>

                                    <div class="form-group">
                                        <label for=""> Start Time </label>
                                        <input type="time" name="start_time" class="form-control" v-model="inputData.start_time">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Duration</label>
                                        <div class="input-group">
                                            <input type="text" name="d_hour" class="form-control" placeholder="e.g.3"
                                                data-validation-required-message="This field is required">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon5">Hours</span>
                                            </div>
                                            <input type="text" name="d_min" class="form-control" placeholder="e.g.60"
                                                data-validation-required-message="This field is required">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon5">Minute</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row recurrence_div" v-if="isShowing">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Recurrence</label>
                                        <input type="hidden" name="recurrance" v-model="inputData.recurrance">
                                        <v-select :options="recurranceOptions" :reduce="recurranceOption => recurranceOption.value" label="name" v-model="inputData.recurrance" @input="onChangeRecurrence" placeholder="Select Recurrance"></v-select>
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <leble>Select Repeat Every<span class="required">*</span></leble>
                                        <div class="col-lg-10 col-md-10 float-left">
                                            <input type="hidden" name="r_every" v-model="inputData.r_every">
                                            <div class="repeat_every">
                                                <v-select 
                                                :options="reNumbers" 
                                                :reduce="reNumber => reNumber"
                                                label=r_every 
                                                v-model="inputData.r_every" 
                                                placeholder="Select Repeat every"></v-select> 
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2 float-left">
                                            <span id="r_every_value">Day</span><span class="r_every_value_s"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <lebel>End Date<span class="required">*</span></lebel>
                                        <div class="controls">
                                            <input type="date" id="end_date" v-model="inputData.end_date" class="form-control" name="end_date">
                                            <div class="form-control-position">
                                                <i class="feather icon-message-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12" v-if="occurs_on_div_show">
                                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                        <label class="col-lg-3 col-md-3 control-label">Occurs on</label>
                                        <div class="col-lg-1 col-md-1 weekly_days floar-left" >
                                            <ul>
                                                <li v-for="day in days" :key="day.day_sort_name">
                                                    <input type="checkbox" name="days[]" v-model="inputData.days" :value="day.dt">
                                                    <label>{{ day.day_sort_name }}</label>
                                                </li>
                                            </ul>
                                            
                                        </div>            
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="monthly_days_div">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-6 col-lg-6 float-left">
                                            <div class="col-lg-2 col-md-2 control-label text-right float-left">
                                                <input type="radio" name="occurs_on" v-model="inputData.occurs_on" value=1 checked>
                                            </div>
                                            <div class="col-lg-10 col-md-10 float-right">
                                                <input type="hidden" name="occurs_on_week" v-model="inputData.occurs_on_week">
                                                <v-select :options="occursOnWeekOptions" :reduce="occursOnWeekOption => occursOnWeekOption.value" label="name" v-model="inputData.occurs_on_week" placeholder="Select Day"></v-select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 float-right">
                                            <div class="col-lg-2 col-md-2 control-label text-right float-left">
                                                <input type="radio" name="occurs_on" v-model="inputData.occurs_on" value=2 >
                                            </div>
                                            <div class="col-lg-10 col-md-10 float-right">
                                                <input type="hidden" name="monthly_days_number" v-model="inputData.monthly_days_number">
                                                <div class="monthly_days_number">
                                                    <v-select 
                                                    :options="monthlyDaysNumbers" 
                                                    :reduce="monthlyDaysNumber => monthlyDaysNumber"
                                                    label=monthly_days_number 
                                                    v-model="inputData.monthly_days_number" 
                                                    placeholder="Select Day"></v-select> 
                                                </div>
                                            </div>
                                        </div>
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
                days:[],
                reNumbers:[],
                monthlyDaysNumbers:[],
                isShowing:false,
                occurs_on_div_show:false,
                occursOnShowing:false,
                monthlyDaysDivShowing:false,
                monthly_days_div:false,
                recurranceOptions: [
                    { name: 'Daily', value: 1 },
                    { name: 'Weekly', value: 2 },
                    { name: 'Monthly', value: 3 }
                ],
                
                occursOnWeekOptions: [
                    { name: 'First', value: 1 },
                    { name: 'Second', value: 2 },
                    { name: 'Third', value: 3 },
                    { name: 'Fourth', value: 4 },
                    { name: 'Last', value: 5 },
                ],
            }
        },
        methods:{
            onChangeRecurrence(value){
                if(value == 1){
                   this.occurs_on_div_show = false
                   this.monthly_days_div = false
                }
                if(value == 2){
                   this.occurs_on_div_show = true
                   this.monthly_days_div = false
                }
                if(value == 3){
                   this.occurs_on_div_show = false
                   this.monthly_days_div = true
                }
            }
        },
        created() {
           
            this.generalApi = 'webinar'
            this.backUrl = '/webinar'
            this.isFile = true
            this.isImage = 'image_path',
            this.inputData.password = 'RS-1234'
            
            
            this.cardTitle = this.isEdit ? 'Add Webinar' : ' Edit Webinar'

            axios.get(this.url+'/api/'+this.generalApi)
            .then(res => {
               
                this.days = res.data.days
                this.reNumbers = res.data.reNumbers  
                this.monthlyDaysNumbers = res.data.monthlyDaysNumbers  
                this.smList = res.data.smList  
            })
           
        },
  
    }

    

</script>