<template>
  <div class="meeting">
    <div class="container-zoom">
      <ZoomFrame :nickname="nickname" :meetingId="meetingId" :password="password"/>
    </div>
  </div>
</template>

<script>
import ZoomFrame from "./ZoomFrame";

export default {
  name: "app",
  data: function () {
      return {
          nickname: '',
          meetingId: '',
          password: '',
      }
  },
  components: {
    ZoomFrame,
  },
  created : function (){
      this.nickname = this.$route.query.nickname;
      this.meetingId = this.$route.query.meetingId;
      this.password = this.$route.query.password;

      console.log('nickname', this.$route.query.nickname);
  }
};
</script>

<style>
.container-zoom {
  width: 70%;
  height: 100%;
}
</style>