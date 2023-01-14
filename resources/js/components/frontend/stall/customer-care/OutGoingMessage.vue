<template>
  <div>
     <h4 class="m-4"   v-if="isChatting == true" @click="openChatWndow()"><span class="text-success mt-4" style="cursor:pointer;"> Your request is accepted. Pls Click Here To Open Chat Widow</span></h4>
    
    <div class="call" v-if="isChatting == false">
      <div>
          <figure class="mb-4 m-4 avatar avatar-xl">
              <img :src="outGoingMessageData.company_user_photo != 'not found'? userImage+outGoingMessageData.company_user_photo:userImage+'avatar.png'" class="rounded-circle" alt="image">
          </figure>
          <h4 class="m-4">{{ outGoingMessageData.company_user_name }} <span class="text-success mt-4">, Please wait and one of our operators will be with you shortly....</span> <button class="text-danger" @click="cancelOutGoingMessage()">Cancel</button></h4>
          <!-- <div class="action-button">
              <button type="button" class="btn btn-danger btn-floating btn-lg m-4" data-dismiss="modal"  @click="cancelOutGoingMessage()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              </button>

          </div> -->
      </div>
      <!-- <audio autoplay loop>
        <source :src="soundUrl+'outgoing-ring.mp3'" type="audio/ogg">
        <source :src="soundUrl+'outgoing-ring.mp3'" type="audio/mpeg">
        Your browser does not support the audio element.
        </audio> -->
    </div>
<!-- {{typeof(outGoingMessageData)}} -->


    <vue-jitsi-meet v-if="isChatting == true"
      ref="jitsiRef"
      domain="meet.jit.si"
      :options="jitsiOptions"
    ></vue-jitsi-meet>

  </div>
</template>


<script>
import { JitsiMeet } from '@mycure/vue-jitsi-meet';
import mixin from '../../../../src/mixin-frontend'

export default {
    mixins:[mixin],
    props:['cancelOutGoingMessage', 'outGoingMessageData', 'isChatting', 'isChat', 'closeChat',],
     data(){
        return {
          company_user_name:'',
          company_user_photo:'',
          customer_name:'',
          roomId:'',
          company_id:'',
          company_user_token:'',
          responseMsg:{}, 
         
        }
    },

components: {
    VueJitsiMeet: JitsiMeet
  },

  watch:{
      responseMsg:function(value){
          this.responseMsg = value
      }
  },

  created(){
      this.responseMsg = this.outGoingMessageData
       this.company_user_name  = this.outGoingMessageData.company_user_name
       this.company_user_photo = this.outGoingMessageData.company_user_photo
       this.customer_name      = this.outGoingMessageData.customer_name
       this.company_id         = this.outGoingMessageData.company_id
       this.roomId             = this.outGoingMessageData.roomId
       this.company_user_token = this.outGoingMessageData.company_user_token
      


       console.log('companyid', this.outGoingMessageData.company_id);

        console.log('this.outGoingMessageData',this.outGoingMessageData)

      if(this.outGoingMessageData.call_state == 3 && this.outGoingMessageData.call_status == 'received'){
           this.isChatting = true
           console.log('this.outGoingMessageData',this.outGoingMessageData)

        }

    //     messaging.onMessage((payload)=>{

    //     console.log('received call message', payload.data);

    //     let join_call = this.url+'/join-call';

    //     if(payload.data.call_state == 1 && payload.data.call_status == 'received'){
    //        this.isCalling = false
    //       //  $('#videocall_part').remove()
    //     }

    //     if(payload.data.call_state == 2){
    //         let make_call_window = this.url+'/make-call'
    //         window.close(make_call_window)
    //     }
    // });
  // this.$refs.jitsiRef.addEventListener('click', this.closeChat())

  },
   computed: {


    jitsiOptions () {
      return {
        roomName: this.roomId,
        width:375,
        height:412,
        noSSL: false,
        userInfo: {
          email: 'user@email.com',
          displayName: this.customer_name,
        },
        configOverwrite: {
          prejoinPageEnabled: false,
          enableNoisyMicDetection: false,
          disableDeepLinking:true,
          startWithVideoMuted:true,
          startWithAudioMuted:true,
          noAutoPlayVideo: true,
          startAudioMuted:true,
          startVideoMuted:true,
          startMutedPolicy:{
              audio: false,
              video: false
          },
          isMutedByFocus:true,
        },
        interfaceConfigOverwrite: {
          SHOW_JITSI_WATERMARK: false,
          SHOW_WATERMARK_FOR_GUESTS: false,
          SHOW_CHROME_EXTENSION_BANNER: false,
          SHOW_PROMOTIONAL_CLOSE_PAGE:true,
          TOOLBAR_BUTTONS: ["chat"],
          MAIN_TOOLBAR_BUTTONS: ['chat'],

        },
        onload: this.onIFrameLoad
      };
    },
  },

  methods:{

    onIFrameLoad () {
  // this.$refs.jitsiRef.addListener('readyToClose', this.closeChat())
    // this.$refs.jitsiRef.executeCommand('toggleFilmStrip');
    this.$refs.jitsiRef.addEventListener('click', this.openChatWndow())
   

    },

    openChatWndow(){

       this.$refs.jitsiRef.executeCommand('toggleChat')
      $('.hide_window_open_text').text('')
      $('.hide_window_open_text').text('Enjoy Chatting!')

      setTimeout(()=>{
        this.$refs.jitsiRef.executeCommand('toggleChat')
      }, 3000)

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
