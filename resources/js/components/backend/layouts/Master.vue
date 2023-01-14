<template>
  <div>

<navbar v-if="showSidebar" ></navbar>
<sidebar v-if="showSidebar" :signOut="signOut"></sidebar>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
             <router-view key="this.$router.fullPath"></router-view>
            <div id="app_backend"></div>
        </div>
    </section>
</div>
       <!-- <navbar :signOut="signOut"></navbar>
      <div class="container-fluid">
        <div class="row">
         
            <router-view key="this.$router.fullPath"></router-view>
          
        </div>
          
      </div>/.container-fluid -->
</div>
</template>

<script>
import {mapGetters} from 'vuex'
import Navbar from './Navbar.vue'
import Sidebar from './Sidebar.vue'
export default {
  
  data(){
    return {
      showSidebar:true

    }
  },

  components:{
    Navbar,
    Sidebar
  },

  created(){
    if(this.$route.name == 'SignIn' && this.user.user.role == 'Customer'){
      this.showSidebar = false
    }
  },
  computed:{
    ...mapGetters({
      user:'user'
    })
  },
    methods:{
    signOut(){
      let user_id = this.user.user.id
      this.$store.dispatch('signOut', {
        user_id:user_id,
        activity_status:0
      }) 
    }
  }
}
</script>