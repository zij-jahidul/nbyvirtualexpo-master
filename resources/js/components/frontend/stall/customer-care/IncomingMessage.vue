<template>
  <div>
   <h4 class="m-4"  v-if="isReceived == true" @click="openChatWndow()"><span class="text-success mt-4 hide_window_open_text"> Click to Open Chat</span></h4>
    <div class="call" v-if="isReceived == false">
      <div>
          <figure class="mb-4 m-4 avatar avatar-xl">
              <img :src="receiveMessageData.customer_photo !='not found'?userImage+receiveMessageData.customer_photo:userImage+'avatar.png'" class="rounded-circle" alt="image">
          </figure>
          <h4 class="m-4"><span class="text-success mt-4">Message requesting from</span> {{ receiveMessageData.customer_name }}</h4>
          <div class="action-button">
              <button type="button" class="btn btn-danger btn-floating btn-lg m-4" data-dismiss="modal" @click="cancelIncomingMessage()">
                Cancel
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
              </button>
              <button type="button" class="btn btn-success btn-pulse btn-floating btn-lg" @click="receiveMessage()">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> -->
                  Accept
              </button>
          </div>
      </div>
      <audio autoplay loop>
      <source :src="soundUrl+'cute-sms-ringtone.mp3'" type="audio/ogg">
      <source :src="soundUrl+'cute-sms-ringtone.mp3'" type="audio/mpeg">
      Your browser does not support the audio element.
      </audio>
  </div>


      <vue-jitsi-meet v-if="isReceived == true"
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
    props:['cancelIncomingMessage', 'receiveMessageData', 'closeChat', 'isReceived'],
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
          isIncoming:false,

        }
    },

components: {
    VueJitsiMeet: JitsiMeet
  },

  created(){
    this.customer_name     = this.receiveMessageData.customer_name
    this.customer_photo    = this.receiveMessageData.customer_photo
    this.customer_id       = this.receiveMessageData.customer_id
    this.roomId            = this.receiveMessageData.roomId
    this.company_user_name = this.receiveMessageData.company_user_name

    console.log('receiveMessageData', this.receiveMessageData);

    // messaging.onMessage((payload)=>{

    //     console.log('received message from incoming', payload.data);

    //     if(payload.data.call_state == 2){
    //         let receive_call_window = this.url+'/receive-call'
    //         window.close(receive_call_window)
    //     }
    // });
    //  this.$refs.jitsiRef.addEventListener('click', this.closeChat())

    

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
          displayName: this.company_user_name,
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
          TOOLBAR_BUTTONS: ["chat"],
          MAIN_TOOLBAR_BUTTONS: ['chat'],
          
        },
        interfaceConfigOverwrite: {
          SHOW_JITSI_WATERMARK: false,
          SHOW_WATERMARK_FOR_GUESTS: false,
          SHOW_CHROME_EXTENSION_BANNER: false,
          SHOW_PROMOTIONAL_CLOSE_PAGE:true,
          
          
        },
        onload: this.onIFrameLoad
      };
    },
  },

  methods:{

    onIFrameLoad () {

    
    this.$refs.jitsiRef.addEventListener('click',this.openChatWndow())

    },

    openChatWndow(){
      this.$refs.jitsiRef.executeCommand('toggleChat')
      this.isIncoming = true
      this.isReceived = true
      $('.hide_window_open_text').text('')
      $('.hide_window_open_text').text('Enjoy Chatting!')

    },


      receiveMessage(){

        let data = {
            customer_id:this.customer_id,
            call_state:3
        }

        axios.post(this.url+'/api/receive-message', data)
        .then(res => {

           if(res){

               this.isReceived = true
              //  $('#videocall_part').remove()

           }

        })
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
