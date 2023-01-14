<template>
    <section class="content">
      <navbar :signOut="signOut" v-if="isNavbar"></navbar>
      <div class="container-fluid window_size">
        

          <router-view key="this.$router.fullPath"></router-view>
     
      </div><!-- /.container-fluid -->

      <footer-content v-if="isFooter"></footer-content>
    </section>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  data(){
    return {
      height:window.innerHeight,
      width:window.innerWidth,
      isNavbar:true,
      isFooter:true 
    }
  },

  created(){

    if(this.$route.name == 'MakeCall' || this.$route.name == 'ReceiveCall' || this.$route.name == 'JoinCall'){

      this.isNavbar = false
      this.isFooter = false

    }

  },

  computed:{
    ...mapGetters({
      user:'user'
    })
  },
 
  mounted(){
    // $('.window_size').css({'height':this.height, 'width':this.width, 'overflow-y':'scroll'});
 
  },
  methods:{
    signOut(){
      let user_id = this.user.user.id
      this.$store.dispatch('signOut', {
        user_id:user_id,
        activity_status:0
      })
    },

  }
}
</script>