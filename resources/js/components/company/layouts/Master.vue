<template>
    <div>
       <navbar :signOut="signOut"></navbar>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <sidebar v-if="showSidebar" :signOut="signOut"></sidebar>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <router-view key="this.$router.fullPath"></router-view>
          </div>
        </div>
          
      </div><!-- /.container-fluid -->
    </div>
</template>

<script>
export default {
  data(){
    return {
      showSidebar:true
    }
  },

  created(){
    if(this.$route.name == 'SignIn'){
      this.showSidebar = false
    }
  },
    methods:{
    signOut(){
      this.$store.dispatch('signOut')
    }
  }
}
</script>