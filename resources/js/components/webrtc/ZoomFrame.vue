<template>
  <div class="iframe-container">
    <meta charset="utf-8">
     <!-- <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.5/css/bootstrap.css" /> -->
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.5/css/react-select.css" />

    <div id="zoom-root"></div>

    <meta name="format-detection" content="telephone=no">
  </div>
</template>

<script>
import Vue from 'vue'
import { ZoomMtg } from '@zoomus/websdk';
console.log("checkSystemRequirements");
console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

// CDN version default
ZoomMtg.setZoomJSLib('https://source.zoom.us/1.8.5/lib', '/av'); 

ZoomMtg.preLoadWasm();

ZoomMtg.prepareJssdk();

var API_KEY = 'pjEvk8UPRX-Rk6VBNuLm9g';

var API_SECRET = 'f83k1Sv0rLssQ1BTu3bL2JsT0nAA89gd1Wni';

export default {
  name: "ZoomFrame",
  data: function() {
    return {
      src: "",
      meetConfig: {},
      signature: {},
      url:window.location.origin,
       imageUrl : window.location.origin,
    };
  },
  props: {
    nickname: String,
    meetingId: String,
    password: String
  },
  created: function() {
    // Meeting config object
    this.imageUrl = this.imageUrl+'/frontend/assets/webinar/'

    this.meetConfig = {
      apiKey: API_KEY,
      apiSecret: API_SECRET,
      meetingNumber: this.meetingId,
      userName: this.nickname,
      passWord: this.password,
      leaveUrl: this.url+"/webinar",
      role: 1
    };

    // Generate Signature function
    this.signature = ZoomMtg.generateSignature({
      meetingNumber: this.meetConfig.meetingNumber,
      apiKey: this.meetConfig.apiKey,
      apiSecret: this.meetConfig.apiSecret,
      role: this.meetConfig.role,
      success: function(res) {
        // eslint-disable-next-line
        console.log("success signature: " + res.result);
      }
    });

    // join function
    ZoomMtg.init({
      leaveUrl: this.url+"/webinar",
      isSupportAV: true,
      success: () => {
        ZoomMtg.join({
          meetingNumber: this.meetConfig.meetingNumber,
          userName: this.meetConfig.userName,
          signature: this.signature,
          apiKey: this.meetConfig.apiKey,
          userEmail: "mehedi.uiu@gmail.com",
          passWord: this.meetConfig.passWord,
          success: function(res) {
            // eslint-disable-next-line
            console.log("join meeting success");
          },
          error: function(res) {
            // eslint-disable-next-line
            console.log(res);
          }
        });
      },
      error: function(res) {
        // eslint-disable-next-line
        console.log(res);
      }
    });
  },
  mounted: function() {}
};
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
</style>
<!-- Add "scoped" attribute to limit CSS to this component only -->

