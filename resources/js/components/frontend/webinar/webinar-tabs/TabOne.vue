<template>
    <div class="container">
        <div class="row">

            <div class="col-lg-2 col-12"></div>
            <div class="col-lg-10 col-12 cart-container">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <img :src="imageUrl+'live-recording.png'" alt="Live Recording" class="img-fluid live-recording-absolute">
                                <p class="time"> <i class="fas fa-circle timeline-dots text-danger"></i>10.00 PM - 12.00 PM  (GMT +6.00) </p>
                                <h5 class="webinar-title mt-2 mb-2"> Important of Digital Marketing today's Perspective</h5>
                                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus venenatis lectus non dolor convallis vehicula.s mattis a vitae eros.</p>
                            </div>
                            <div class="col-lg-4 text-right d-lg-block d-none">
                                <img :src="imageUrl+'live-recording.png'" alt="Live Recording" class="img-fluid live-recording pull-right">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <img :src="imageUrl+'speaker-1.jpg'" alt="Live Recording" class="img-fluid speaker-photo">
                                            </div>
                                            <div class="col-9 speaker-details">
                                                <p><strong>Md. Numan Al Kalif</strong></p>
                                                <p><small>Motivational Spearker</small></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <img :src="imageUrl+'speaker-2.jpg'" alt="Live Recording" class="img-fluid speaker-photo">
                                            </div>
                                            <div class="col-9 speaker-details">
                                                <p><strong>Dr. Mujtaba Ar -Rashid</strong></p>
                                                <p><small>Marketing Expert</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-12 text-right">
                            <!-- <button class="btn btn-success pull-right">Join Now</button>-->
                                <a class="hover_button btn btn-success pull-right" href="" @click="webinarOpen()">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <p class="time"> <i class="far fa-circle timeline-dots" style="color: green; background: white"></i>10.00 PM - 12.00 PM  (GMT +6.00) </p>
                                <h5 class="webinar-title mt-2 mb-2">Important of Digital Marketing today's Perspective</h5>
                                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus venenatis lectus non dolor convallis vehicula.s mattis a vitae eros.</p>
                            </div>
                            <div class="col-lg-4 text-right d-lg-block d-none">
                                <img :src="imageUrl+'live-recording.png'" alt="Live Recording" class="img-fluid live-recording pull-right">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <img :src="imageUrl+'speaker-2.jpg'" alt="Live Recording" class="img-fluid speaker-photo">
                                            </div>
                                            <div class="col-9 speaker-details">
                                                <p><strong>Md. Numan Al Kalif</strong></p>
                                                <p><small>Motivational Spearker</small></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <img :src="imageUrl+'speaker-2.jpg'" alt="Live Recording" class="img-fluid speaker-photo">
                                            </div>
                                            <div class="col-9 speaker-details">
                                                <p><strong>Dr. Mujtaba Ar -Rashid</strong></p>
                                                <p><small>Marketing Expert</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-12 text-right">
<!--                                <button class="btn btn-success pull-right">Join Now</button>-->
                                <button class="hover_button btn btn-success pull-right disabled" >Up Coming</button>
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
export default {
name: "TabOne",
    data(){
        return {
            url:window.location.origin,
            imageUrl : window.location.origin,
        }
    },
    created() {
        this.imageUrl = this.imageUrl+'/frontend/assets/webinar/'
       console.log(this.user.user.name.replace(/ +/g, ""));
    },
    computed:{
        ...mapGetters({
            user:'user'
        })
    },
    methods:{
        webinarOpen(){
            let clientName = this.user.user.name.replace(/ +/g, "")
            let room_url = this.url+'/websession/meeting?meetingId=87079684973&nickname='+clientName

            window.open(room_url,
             "DescriptiveWindowName",
            "resizable,scrollbars,status")
        }
    }
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
    background-color: #6ABD48 !important;
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
