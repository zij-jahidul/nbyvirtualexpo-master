<template>
  <div>

        <div class="call" v-if="isCalling">
          
      <div>
          <figure class="mb-4 m-4 avatar avatar-xl">
              <img :src="makeCallData.company_user_photo != 'not found'? userImage+makeCallData.company_user_photo:userImage+'avatar.png'" class="rounded-circle" alt="image">
          </figure>
          <h4 class="m-4"><span class="text-primary mt-4">Calling to...</span> {{ makeCallData.company_user_name }} </h4>
          <div class="action-button">
              <button :class="isVideo == false?'btn-secondary':'btn-primary'" class="btn btn-floating btn-lg m-4"><span><i class="fa fa-video"></i></span></button>
              <button  class="btn btn-primary btn-floating btn-lg m-4"><span><i class="fa fa-microphone"></i></span></button>
              <button type="button" class="btn btn-danger btn-floating btn-lg m-4" data-dismiss="modal"  @click="cancelOutGoingCall()">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                  <span><i class="fa fa-phone" style="transform: rotate(224deg);"></i></span>
                  
                  
                  
              </button>

          </div>
      </div>
      <audio autoplay loop>
        <source :src="soundUrl+'outgoing-ring.mp3'" type="audio/ogg">
        <source :src="soundUrl+'outgoing-ring.mp3'" type="audio/mpeg">
        Your browser does not support the audio element.
        </audio>
  </div>



      <vue-jitsi-meet v-if="isCalling == false"
      ref="jitsiRef"
      domain="meet.jit.si"
      :options="jitsiOptions"
    ></vue-jitsi-meet>
    <button v-if="isCalling == false" style="z-index:999999999999; background:red;" class="call-cancel-button bg-danger btn btn-sm btn-danger" @click="cancelOutGoingCall()"><i class="fa fa-phone" style="transform: rotate(224deg);"></i></button>
  </div>
</template>


<script>
import { JitsiMeet } from '@mycure/vue-jitsi-meet';
import mixin from '../../../../src/mixin-frontend'

export default {
    mixins:[mixin],
    props:['cancelOutGoingCall', 'makeCallData', 'isCalling', 'closeMeeting', 'isAudio', 'isVideo'],
     data(){
        return {
          company_user_name:'',
          company_user_photo:'',
          customer_name:'',
          roomId:'',
          company_id:'',
          company_user_token:'',
          callType:''
        }
    },

components: {
    VueJitsiMeet: JitsiMeet
  },

  created(){


        console.log('makeCallData',this.makeCallData);

       this.company_user_name  = this.makeCallData.company_user_name
       this.company_user_photo = this.makeCallData.company_user_photo
       this.customer_name      = this.makeCallData.customer_name
       this.company_id         = this.makeCallData.company_id
       this.roomId             = this.makeCallData.roomId
       this.company_user_token = this.makeCallData.company_user_token
       this.callType = this.makeCallData.call_type


       console.log('companyid', this.makeCallData.company_id);

      if(this.makeCallData.call_state == 1 && this.makeCallData.call_status == 'received'){
           this.isCalling = false

        }

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
          displayName: this.customer_name,
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
          MAIN_TOOLBAR_BUTTONS: ['microphone', 'camera', 'hangup'],

        },
        onload: this.onIFrameLoad
      };
    },
  },

  methods:{

    onIFrameLoad () {
  // this.$refs.jitsiRef.addListener('readyToClose', this.closeMeeting())
    // this.$refs.jitsiRef.executeCommand('toggleFilmStrip');
    // this.$refs.jitsiRef.executeCommand('toggleChat')
    this.$refs.jitsiRef.executeCommand('toggleTileView');

    },

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

button.call-cancel-button{

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
