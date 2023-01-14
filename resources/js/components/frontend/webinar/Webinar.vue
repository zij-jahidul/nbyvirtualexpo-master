<template>
    <div class="container">
        <div class="row">

            <div class="col-lg-2 col-12"></div>
            <div class="col-lg-10 col-12 cart-container">
                <div class="card mb-3" v-for="(item, index) in webinars" :key="index">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <img :src="webinarImage+'live-recording.png'" alt="Live Recording" class="img-fluid live-recording-absolute">
                                <p class="time"> <i class="fas fa-circle timeline-dots text-danger"></i> {{item.start_time}} - {{item.end_time}}  (GMT +6.00) </p>
                                <h5 class="webinar-title mt-2 mb-2"> {{ item.topic}} </h5>
                                <p class="text-justify"> {{item.description}} </p>
                            </div>
                            <div class="col-lg-4 text-right d-lg-block d-none">
                                <img :src="webinarImage+'live-recording.png'" alt="Live Recording" class="img-fluid live-recording pull-right">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="row">
                                    
                                    <div class="col-lg-6 col-12" v-for="speaker in item.speakers" :key="speaker.id">
                                        <div class="row">
                                            <div class="col-3">
                                                <img :src="webinarUserImage+speaker.image" alt="Live Recording" class="img-fluid speaker-photo">
                                            </div>
                                            <div class="col-9 speaker-details">
                                                <p><strong> {{speaker.name}} </strong></p>
                                                <p><small> {{speaker.designation}} </small></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-12 text-right">
                            <!-- <button class="btn btn-success pull-right">Join Now</button>-->
                                <router-link class="hover_button btn btn-success pull-right" to="#" @click.native="webinarOpen(item.meeting_id)" v-if="item.upcoming == 'yes'">Join Now</router-link>
                                <button v-if="item.upcoming == 'no'" class="hover_button btn btn-success pull-right disabled" >Up Coming</button>

                            </div>
                        </div>
                    </div>
                </div>
              

            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import frmixin from '../../../src/mixin-frontend'
export default {
mixins:[frmixin],
name: "TabOne",
    data(){
        return {
         webinars:[]   
        }
    },
    created() {
       this.getWebinar()
    },

    methods:{

        getWebinar(){
            axios.get(this.url+'/api/webinar-live-session')
            .then(res => {
                this.webinars = res.data.data
                console.log('webinar', res.data);
            })
        },
        webinarOpen(meetingId){
            let clientName = this.user.user.name.replace(/ +/g, "")
            let room_url = this.url+'/websession/meeting?meetingId='+meetingId+'&nickname='+clientName

            window.open(room_url,
             "DescriptiveWindowName",
            "resizable,scrollbars,status")
        }
    },

    computed:{
        ...mapGetters({
            user:'user'
        })
    },
}
</script>

<style scoped>
.cvbank-tablist-main .nav-item .active {
    color: green !important;
    border-bottom: 1px solid green !important;
    background: transparent;
}

a.btn{
    color:black !important;
}
.btn.focus, .btn:focus{
    box-shadow: none;
}
ul#pills-tab {
    border-bottom: 1px solid silver;
}
li.nav-item.date-nav:first-child {
    padding: 0;
}
li.nav-item.date-nav {
    padding: 0 20px;
}
.webinar-title {
    color: green;
}
.btn-success {
    background-color: #0073C5 !important;
    border-color: #6ABD48 !important;
}
.speaker-photo {
    border-radius: 50%;
    border: 1px solid silver;
}
.speaker-details p{
    margin: 0;
}
.card{
    border: none;
    background-color: #ededed;
}
.cart-container{
    border-left: 2px solid green;
}
.timeline-dots {
    position: absolute;
    left: -28px;
    top: 5px;
}
.live-recording-absolute{
    display: none;
}
@media screen and (max-width: 992px){
    .live-recording-absolute{
        display: block;
        position: absolute;
        right: 0;
        top: -5%;
    }
}
</style>
