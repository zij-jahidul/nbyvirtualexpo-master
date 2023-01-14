<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- <router-link to="webinar"><i class="fas fa-chevron-left fa-2x back-button-conference"></i></router-link>
                <div class="hall-banner"> -->
                    <!-- <img :src="webinarImage+'hallroom.mp4'" alt="Live Recording" class="img-fluid"> -->
                    
                    <iframe v-if="eventAds.status == 1" :src="'https://www.youtube.com/embed/'+eventAds.video_link+'?autoplay=1'" style="width:100%; height: 520px;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <img v-else :src="this.assetsImage+'event.jpeg'">
                    <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/ldy3VEPIRk0?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->

                    <!-- <LazyVideo style="width:100%;" :src="webinarImage+'hallroom.mp4'" :poster="webinarImage+'lobby.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/> -->
                    <!-- <iframe :src="url+'/websession/meeting?meetingId=84410236628&nickname='+username" frameborder="0" class="ifram_one"></iframe> -->
                    <!-- <img :src="webinarImage+'tv.png'" alt="Live TV" class="img-fluid live-tv"> -->
                
                
                </div>
            </div>
        </div>
</template>
<script>
import frmixin from '../../../src/mixin-frontend'
import { mapGetters } from 'vuex'
    export default {
        mixins:[frmixin],
    data(){
        return {
             eventAds: '',
        }
    },
    created(){
        this.liveBroadcast();
    },
    methods:{
        liveBroadcast(){
            axios(this.url+'/api/event-room-live').then(response=>{
                    this.eventAds = response.data;
                    console.log('event-ads', this.eventAds)
                })
        }
    },
    computed:{
    ...mapGetters({
        user:'user'
    })
    },
}
</script>

<style>

.hall-details h3{
    color: green;
    margin: 20px 0;
}
.speaker-photo {
    border-radius: 50%;
    border: 1px solid silver;
}

.speaker-details p{
    margin: 0;
}
.hall-banner{
    position: relative;
}
 .live-tv {
     position: absolute;
     left: 53%;
     transform: translate(-50%,0);
     top: 8%;
     width: 35%;
 }
.ifram_one{
    position: absolute;
    left: 29%;
    right: 0;
    height: 37%;
    top: 29%;
    width: 45%;
 }
</style>
