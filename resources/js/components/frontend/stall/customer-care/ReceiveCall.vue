<template>
  <div>

    <div class="call" v-if="isReceived == false"> 
      <div>
          <figure class="mb-4 m-4 avatar avatar-xl">
              <img :src="receiveData.customer_photo !='not found'?userImage+receiveData.customer_photo:userImage+'avatar.png'" class="rounded-circle" alt="image">
          </figure>
          <h4 class="m-4">{{ receiveData.customer_name }} <span class="text-success mt-4">Ringing...</span></h4>
          <div class="action-button">
              <button type="button" class="btn btn-danger btn-floating btn-lg m-4" data-dismiss="modal" @click="cancelIncomingCall()">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                  <span><i class="fa fa-phone" style="transform: rotate(228deg);"></i></span>
              </button>
              <button type="button" class="btn btn-success btn-pulse btn-floating btn-lg" @click="receiveCall()">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> -->
                  <span><i class="fa fa-phone"></i></span>
              </button>
          </div>
      </div>
      <audio autoplay loop>
      <source :src="soundUrl+'incoming-ring.mp3'" type="audio/ogg">
      <source :src="soundUrl+'incoming-ring.mp3'" type="audio/mpeg">
      Your browser does not support the audio element.
      </audio>
  </div>


      <vue-jitsi-meet v-if="isReceived == true"
      ref="jitsiRef"
      domain="meet.jit.si"
      :options="jitsiOptions"
    ></vue-jitsi-meet>
    <button v-if="isReceived == true" style="z-index:999999999999; background:red;" class="call-cancel-button bg-danger btn btn-sm btn-danger" @click="cancelIncomingCall()"><i class="fa fa-phone" style="transform: rotate(224deg);"></i></button>
  </div>
</template>

<script>

import { JitsiMeet } from '@mycure/vue-jitsi-meet';
import mixin from '../../../../src/mixin-frontend'

export default {
    mixins:[mixin],
    props:['cancelIncomingCall', 'receiveData', 'closeMeeting', 'isReceived','receiveCall'],
     data(){
        return {
          url:window.location.origin,
          userImage:'',
          soundUrl:'',
          customer_name:'',
          customer_photo:'',
          company_user_name:'',
          customer_id:'',
          roomId:'',
          callType:'',
          modalwidth:438,
          modalHeight:489,
          

        }
    },

components: {
    VueJitsiMeet: JitsiMeet
  },

  created(){
    console.log('this.receiveData', this.receiveData);
    this.customer_name     = this.receiveData.customer_name
    this.customer_photo    = this.receiveData.customer_photo
    this.customer_id       = this.receiveData.customer_id
    this.roomId            = this.receiveData.roomId
    this.company_user_name = this.receiveData.company_user_name
    this.callType = this.receiveData.call_type
    this.modalwidth = this.screenWidth
    this.modalHeight = this.screenHeight

    // $('.jitsi-icon').click(function(){
    //   this.$modal.hide('receiveCall')
    //   alert('success')
    // })

  },
     computed: {


    jitsiOptions () {
      return {
        roomName: this.roomId,
        width:this.$isMobile()?370:810,
        height:500,
        noSSL: false,
        userInfo: {
          email: 'user@email.com',
          displayName: this.company_user_name,
        },
        configOverwrite: {
          prejoinPageEnabled: false,
          enableNoisyMicDetection: false,
          disableDeepLinking:true,
          startWithVideoMuted:this.callType == 'voice'?true:false,
          liveStreamingEnabled: true,
          
        },
        interfaceConfigOverwrite: {
          SHOW_JITSI_WATERMARK: false,
          SHOW_WATERMARK_FOR_GUESTS: false,
          SHOW_CHROME_EXTENSION_BANNER: false,
          SHOW_PROMOTIONAL_CLOSE_PAGE:true,
          TOOLBAR_BUTTONS: [
                    'microphone', 'camera', 'fullscreen',
                    'tileview', 'profile',
                    'recording', 'livestreaming',
                    'videoquality', 'settings',
                    'shortcuts','hangup'
                ],
          MAIN_TOOLBAR_BUTTONS: ['microphone', 'camera','hangup'],
          
          
        },
        onload: this.onIFrameLoad,
        onclick:this.clickIFrame
      };
    },
  },

  methods:{
    // closeWindow(){
    //   this.$modal.hide('receiveCall')
    //   alert('success')
    // },
    onIFrameLoad () {

      this.$refs.jitsiRef.executeCommand('toggleTileView');
    // this.$refs.jitsiRef.executeCommand('toggleChat')
    // setTimeout(() => {

    //   }, 3000)
     

    // this.$refs.jitsiRef.executeCommand('hangup');

      
    

    },

    clickIFrame(){
       this.$refs.jitsiRef.addEventListener('readyToClose', this.rejectCall(event)) 
    },

    rejectCall(e){
    
    this.cancelIncomingCall()
      
     
    }

  }
}
</script>

<style scoped>

.call{
  position:absolute;
  right:0;
  left:0;
  text-align:center;
}

.call .action-button .btn {
    width: 70px;
    height: 70px;
    margin: 0 15px;
}

.call-cancel-button{

    z-index: 2147483647;
    background: #FF0202 !important;
    position: absolute;
    left: 44.1%;
    right: 50%;
    bottom: 5.6%;
    color: #fff;
    border-radius: 50%;
    transform: translate(50%, 50%);
    width: 45px;
    height: 45px;
    border: none;

}

.btn.btn-danger {
    background: #fd397a;
    border-color: #fd397a;
}

.btn.btn-success.btn-pulse:not(:disabled):not(.disabled) {
    -webkit-box-shadow: 0 0 0 0 rgba(10,187,135,.9)!important;
    -moz-box-shadow: 0 0 0 0 rgba(10,187,135,.9)!important;
    box-shadow: 0 0 0 0 rgba(10,187,135,.9)!important;
    -webkit-animation: pulse 1.5s infinite!important;
}

.btn.btn-success {
    background: #0abb87;
    border-color: #0abb87;
}

.text-success {
    color: #0abb87!important;
}

.btn.btn-floating {
    height: 35px;
    width: 35px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -moz-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -moz-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

figure {
    margin: 0 0 1rem;
}

figure.avatar {
    display: inline-block;
    margin-bottom: 0;
    height: 2.3rem;
    width: 2.3rem;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

figure.avatar.avatar-xl {
    height: 6.1rem;
    width: 6.1rem;
}

figure.avatar>a>img, figure.avatar>img {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.rounded-circle {
    border-radius: 50%!important;
}

img {
    vertical-align: middle;
    border-style: none;
}

</style>
