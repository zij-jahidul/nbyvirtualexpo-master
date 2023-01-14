<template>
    <section class="content">
      <!-- <navbar :signOut="signOut"></navbar> -->
      <div class="container-fluid window_size">

          <router-view key="this.$router.fullPath"></router-view>
     
      </div><!-- /.container-fluid -->

      <!-- <footer-content></footer-content> -->
    </section>
</template>

<script>
// import { mapGetters } from 'vuex'
export default {
  data(){
    return {
      height:window.innerHeight,
      width:window.innerWidth 
    }
  },

  computed:{
    // ...mapGetters({
    //   user:'user'
    // })
  },
 
  mounted(){
    // $('.window_size').css({'height':this.height, 'width':this.width, 'overflow-y':'scroll'});
 
  },
  methods:{
    // signOut(){
    //   this.$store.dispatch('signOut')
    // },

  }
}
</script>