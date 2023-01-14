<template>

  <div>
    {{ roomId }}
    <vue-jitsi-meet
      ref="jitsiRef"
      domain="meet.jit.si"
      :options="jitsiOptions"
    ></vue-jitsi-meet> 


  </div>

</template>
  
<script>
import { JitsiMeet } from '@mycure/vue-jitsi-meet';

export default {
  data(){
    return {
      roomId:'',
      company_user_name:'',
    }
  },

  created(){
    this.roomId = window.roomId
    this.company_user_name = window.company_user_name
  },

  components: {
    VueJitsiMeet: JitsiMeet
  },

  computed: {
    jitsiOptions () {
      return {
        roomName: this.roomId,
        noSSL: false,
        userInfo: {
          email: 'user@email.com',
          displayName: this.company_user_name,
        },
        configOverwrite: {
          prejoinPageEnabled: false,
          enableNoisyMicDetection: false
        },
        interfaceConfigOverwrite: {
          SHOW_JITSI_WATERMARK: false,
          SHOW_WATERMARK_FOR_GUESTS: false,
          SHOW_CHROME_EXTENSION_BANNER: false
        },
        onload: this.onIFrameLoad
      };
    },
  },
  methods: {
    onIFrameLoad () {
      // do stuff
    },
  },
};
</script>