<template>

  <div v-if="user.user.role =='Customer' || ( stallId == user.stall_owner.stall_id)">


            <section id="stalllayout_part">
                <LazyVideo style="width:100%; position:relative; height:80%; height: 950px; object-fit: cover;" :src="imageUrl+'exibitionhall.mp4'" :poster="imageUrl+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>
                <div class="stall_layout">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- v-for="(adds, index) in stallads" :key="index" -->

                            <p class="text-light" v-for="(adds, index) in stallads" :key="index">

                                <img @click="modalOpen(adds.image)" v-if="adds.ads_position == 3" :src="adds.image" class="img-fluid stall_banner_left">
                                <img @click="modalOpen(adds.image)" v-if="adds.ads_position == 4" :src="adds.image" class="img-fluid stall_banner_right">
                                <img @click="modalOpen(adds.image)" v-if="adds.ads_position == 5" :src="adds.image" class="img-fluid stall_banner_right_two">
                                <img @click="modalOpen(adds.image)" v-if="adds.ads_position == 6" :src="adds.image" class="img-fluid stall_banner_left_two">
                                <img @click="modalOpen(adds.image)" v-if="adds.ads_position == 2" :src="adds.image" class="img-fluid stall_company_logo">

                                <iframe class="iframedesign" id="ShowFrameID" :src="adds.ads_position == 1?adds.video_link+'?wmode=opaque&amp;modestbranding=1&amp;rel=0&autoplay=1&controls=1&mute=0':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                 
                            </p>
             <!-- Button trigger modal -->
                            <button type="button" style="display:none" id="popupOpen" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">

                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <img :src="popupImage"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          <div class="stalllayout_img_div">
                            <img :src="this.imageUrl+'stall.jpeg'" alt="Stall-Layout" class="img-fluid stall_layout_img">
                            <img :src="companyImgUrl+stallLogo"  id="stall_image" alt="Stall-Layout" class="img-fluid stall_company_name">
                           
                          <div class="chat-call-message">
                              <router-link to= "#"  @click.native="openChatWindow()"
                                class="far fa-comment-dots">
                                 

                              </router-link>

                              <router-link to="#"  @click.native="openCallWindow()" class="fas fa-video">

                              </router-link>

                              <router-link to="" v-if="user.user.role === 'Customer'" class="fas fa-envelope">

                              </router-link>
                          </div>

                              <div class="top-nav-button">
                                  <button class="button-item"><a href="#tab0" @click="goToTab('#tab0')"><span class="d-none d-sm-none d-md-block">Product</span><span class="d-block d-sm-block d-md-none"><i class="fab fa-product-hunt"></i></span></a></button>
                                  <button class="button-item"><a href="#tab1" @click="goToTab('#tab1')"><span class="d-none d-sm-none d-md-block">Resource</span><span class="d-block d-sm-block d-md-none"><i class="fas fa-suitcase-rolling"></i></span></a></button>
                                  <button class="button-item"><a href="#tab2" @click="goToTab('#tab2')"><span class="d-none d-sm-none d-md-block">About</span><span class="d-block d-sm-block d-md-none"><i class="fas fa-address-card"></i></span></a></button>
                              </div>
                        </div>

                        </div> 
                    </div>
                   <!-- StallChatting start here -->

                   <!-- StallChatting end here -->
                </div>
            </section>

        <div class="container pl-0"  style="margin-bottom: 20%;"  id="product_area">
            <div class="row">
                <div class="col-md-12 text-right pl-0">
                    <div class="bg-orange cvbank-tablist-main mb-3">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li :class="['nav-item  stall-tab',{active:currentTab.name === tab.name}]" v-for="(tab, tabindex) in tabs" :key="tabindex"
                                @click.prevent="currentTab = tab" :id="'tab'+tabindex">
                                <a href=""  class="menu-tab-button"  >{{ tab.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Login Component goes here-->
            <keep-alive>
                <component :is="currentTab.component" class="tab"></component>
            </keep-alive>
        </div>

    <!-- <div class="window-footer" v-if="isOutGoingWindow == true && isMinimize == true">



        <button type="button" @click="cancelOutGoingCall()" >
            <i class="fas fa-times" style="color:#fff;"></i>
        </button>
        <button type="button" @click="maximizeMakeCallWindow()"><i class="fas fa-window-maximize"></i></button>
         <button type="button" @click="minimizeMakeCallWindow()"><i class="fas fa-window-minimize"></i></button>

    </div>
    <div class="window-footer" v-if="isIncomingWindow == true && isMinimize == true">

        <button type="button" @click="cancelIncomingCall()" >
            <i class="fas fa-times" style="color:#fff;"></i>
        </button>
        <button type="button" @click="maximizeReceiveCallWindow()"><i class="fas fa-window-maximize"></i></button>

        <button type="button" @click="minimizeReceiveCallWindow()"><i class="fas fa-window-minimize"></i></button>
       

    </div> -->
     <!-- <div class="bto">
        <router-link to="#" id="open_chat_window" class="open_chat_window"  @click.native="openChat()">
        <i class="far fa-comments"></i>
        </router-link>
    </div> -->
  </div>
<div v-else>
    <div class="text-center">
    <h4  class="bg-danger text-white">Sorry, you have no right to access in this stall ! </h4>
    <img width="50%" :src="stallImage+'locked.gif'" alt="">
    <!-- <router-link :to="this.url+'/stall-details/'+">Go back to your stall</router-link> -->
    </div>
</div>
</template>


<script>
import { mapGetters } from 'vuex'
import Products from "../stall/stall-tabs/Products";
import Resources from "../stall/stall-tabs/Resource";
import AboutUs from "../stall/stall-tabs/AboutUs";
import Offer from "../stall/stall-tabs/Offer";
import VideoLazy from 'vue-lazyload-video'

import chat_mixin from '../../../src/chat-mixin'
import frmixin from '../../../src/mixin-frontend'




let tabs = [
    {
        name:'Product',
        component:Products
    },
    // {
    //     name:'Offer',
    //     component:Offer
    // },
    {
        name:'Resource',
        component: Resources
    },
    {
        name:'About Us',
        component: AboutUs
    }
]


export default {
mixins:[frmixin, chat_mixin],

    data(){
        return {
            stalls: {},
            tabs,
            currentTab: tabs[0],
            stallads:{},
            popupImage:'',
            stallLogo:''

        }
    },

computed:{
    ...mapGetters({
        user:'user'
    }),

    stallId:function(){
        return this.$route.params.stall_id
    },

    companyId:function(){
        return  this.$route.params.company_id
    },
},
created(){

    setTimeout(() => {
          var element = document.getElementById("goto");
          element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"})
        //   .offset(-50);
      }, 1000)


    let stall_id = this.$route.params.stall_id
    console.log('this.$route.params')
    console.log(this.$route.params)

    setTimeout(() => {
        axios.get(this.url+'/api/frontend-stall-details?stall_id='+stall_id)
        .then(res => {
           this.stallLogo = res.data.data.company_logo
        //    console.log('stall', res.data.data);
        this.stallName = res.data.data.stall_name

        console.log(' res.data.data',  res.data.data);
        

        })
    }, 1000)

    setTimeout(() => {
        axios(this.url+'/api/showads-stall?stall_id='+stall_id).then(response=>{
            this.stallads = response.data.data;
            console.log('ShowAds',this.stallads)
        })
    }, 1000)

},
methods:{
    modalOpen(popup){
          this.popupImage = popup;
          $('#popupOpen').click()
    },

    openChatWindow(){
        $('#open_chat_window').click()
    }
    
},

 
    components: {
        VideoLazy,
    },

}
</script>

<style scoped>
    .bto {
        position: fixed !important;
        bottom: 15%;
        right: 3%;
        z-index: 9999;
        cursor: pointer;
    }

    .bto i {
        width: 60px;
        height: 57px;
        border-radius: 50%;
        background-color: #0073C5;
        color: #fff;
        z-index: 9999;
        line-height: 60px;
        text-align: center;
        font-size: 32px;
    }

@media only screen and (min-width:322px) and (max-width:640px){

  #container{
      width:97% !important;
      right:21 px !important;
    bottom: -72px !important;
  }  

  main header{
    width:114% !important;
    font-size: inherit !important;
  }

  

  .user-name{
    left: 19% !important;
    top: 18px !important;
}

  .user-name h2{
      font-size: inherit !important;
  }

  aside li.aside_li{
     font-size: inherit !important; 
  }

  .aside_username{
      margin-left:31% !important;
  }
}

.user-name {
    /* width: 89%; */
    left: 62px;
    position: absolute;
}

.window-header{
    height:40px;
    padding:5px;
    background:#0073C5;

}

.window-header button{
    float:right;
    border: none;
    background: transparent;
}

.window-header button i{
    color:#fff;
}

.window-footer {
    height: 50px;
    padding: 5px;
    background: #0073C5;
    z-index: 999999999999999999999999;
    position: absolute;
    width: 100%;
    /* display: flex; */
    /* overflow: hidden; */
    /* margin-top: 10%; */
    
    bottom: 0px;
    left: 0px;
    right: 0px;
}

.window-footer button{
    float:right;
     border: none;
    background: transparent;
}

.window-footer button i{
    color:#fff;
}

.vm--container{
        z-index: 999999999999 !important;
        right: 10px;
        bottom: 109px;
}

.stall_company_logo {
    position: absolute;
    left: 69%;
    top: 63%;
    transform: translateX(-50%);
    width: 9% !important;
    z-index: 999;
}


.iframedesign {
    position: absolute;
    left: 39%;
    right: 0;
    height: 31%;
    top: 22%;
    width: 21.5%;
    z-index: 1;
}
@media only screen and (max-width: 767px) and (min-width: 501px){
    .iframedesign{
        top:25%
    }
}
@media only screen and (max-width: 500px){
    .iframedesign{
        top:27%;
        height: 30%;
    }
}

.stall_banner_left {
    position: absolute;
    left: 5%;
    top: 36%;
    width: 8.8%;
    height: 46%;
     transform: rotate(-2deg);
    z-index: 999;
}

.stall_banner_left_two {
    position: absolute;
    left: 15%;
    top: 21%;
    width: 9.4%;
    height: 57%;
    z-index: 999;
}

.stall_banner_right {
    position: absolute;
    right: 4%;
    top: 36%;
    width: 9%;
    height: 40%;
    rotate: 1deg;
    z-index: 999;
}

.stall_banner_right_two {
    position: absolute;
    right: 14%;
    top: 22%;
    width: 9%;
    height: 52%;
    rotate: 1deg;
    z-index: 999;
}




.stalldetails_image_stall {
    width: 100%;
    height: 850px !important;
}

li.nav-item.stall-tab:focus{
    color:#fff;
}

li.nav-item.stall-tab.active{
    background: #0073C5;
    color:#fff;
}
li.nav-item.stall-tab .active a{
    color: white;
}
li.nav-item.stall-tab {
    padding: .8% 5%;
}
li.nav-item.stall-tab a{
    color: #000;
    text-decoration:none;
}
li.nav-item.stall-tab a:focus {
    text-decoration: none;
    color:#fff;
}
ul#pills-tab {
    margin: 3% 5px;
    border-bottom: 1px solid #e6e6e6;
}
.top-nav-button {
    display: inline-grid;
    position: absolute;
    left: 28%;
    top: 22%;
}
.top-nav-button button {
    margin-top: 5px;
}
button.button-item {
    color: white;
    background: #0073C5;
    border: 1px solid #0073C5;
    border-radius: 5px;
    max-width: 10vw;
    font-size: 1.5vw;
}

button.button-item a{
    text-decoration: none;
    color:whitesmoke;
}
@media only screen and (max-width:768px){
    button.button-item {
        font-size: 2vw;
        margin-top: .2vw;
        /*padding: .75vw;*/
        border-radius: 1vw;
    }
}
.chat-call-message {
    display: grid;
    position: absolute;
    top: 21.6%;
    right: 26%;
}

.chat-call-message a{
    text-decoration: none;
}
.chat-call-message .fas, .chat-call-message .far {
    background: #0073C5;
    margin-top: .5vw;
    padding: .75vw;
    border-radius: 1vw;
    border: 1px solid #0073C5;
    font-size: .9vw;
    color:#fff;
}
@media only screen and (max-width:768px){
    .chat-call-message .fas, .chat-call-message .far {
        font-size: 2vw;
        padding: .8vw 1.2vw;
        margin-top: .4vw;
    }
}
.stall_company_name{
    height: 13% !important;
    top:2% !important;
}
#container{
    width: 350px !important;
}
.modal-dialog{
    max-width: fit-content!important;
}
button.close {
    position: absolute;
    right: 5px;
    top: 5px;
    background: silver;
    padding: 5px;
    border-radius: 5px;
    color: red;
}
.stall_banner_left:hover, .stall_banner_right:hover, .stall_banner_right_two:hover, .stall_banner_left_two:hover, .stall_company_logo:hover{
    cursor: pointer;
}
.modal{
    z-index: 9999999 !important;
}
</style>
