<template>
  <div>

    <!-- Footer Part Start -->
    <section id="footer_part">
        <nav class="navbar fixed-bottom navbar-expand-lg navbar-light bg-dark">
        <!-- <div class="col-md-2 order-2 order-md-1 sm_class">
            <button class="btn_success">Exhibitor</button>
        </div> -->
        <div class="col-lg-12">
            <div class="videoCall">
                    <modal name="supportuser" :draggable="isDragable" :clickToClose="false" :reset="true"  :resizable="true" :adaptive="true"  :width="300" :height="400">
                    <div class="window-header">
                        <strong class="text-white">{{stallName}} Support List</strong>
                        <button type="button" @click="closeSupportWindow()" >
                            <i class="fas fa-times" style="color:#fff;"></i>
                        </button>
                    </div>
                    <support-user class="support-list-area" :supportUsers="supportUsers" :makeCall="makeCall"></support-user>
                </modal> 

                <modal name="receiveCall" :draggable="isDragable" :clickToClose="false" :reset="true"  :resizable="true" :adaptive="true" :width="815" :height="530">
                <div class="window-header">
                    <button type="button" @click="cancelIncomingCall()" >
                        <i class="fas fa-times" style="color:#fff;"></i>
                    </button>
                    <button type="button" @click="maximizeReceiveCallWindow()"><i class="fas fa-window-maximize"></i></button>
                    <button type="button" @click="minimizeReceiveCallWindow()"><i class="fas fa-window-minimize"></i></button>

                </div>

            <receive-call :cancelIncomingCall="cancelIncomingCall" :receiveData="receiveData" :closeMeeting="closeMeeting" :isReceived="isReceived" :receiveCall="receiveCall"></receive-call>
         </modal>

         <modal name="makeCall" :draggable="isDragable" :clickToClose="false" :reset="true" :resizable="true" :adaptive="true" :width="815" :height="530">
            <div class="window-header">
                <button type="button" @click="cancelOutGoingCall()" ><i class="fas fa-times" style="color:#fff;"></i>
                </button>
                 <button type="button" @click="maximizeMakeCallWindow()"><i class="fas fa-window-maximize"></i></button>
                <button type="button" @click="minimizeMakeCallWindow()"><i class="fas fa-window-minimize"></i></button>
            </div>
            <make-call :cancelOutGoingCall="cancelOutGoingCall" :makeCallData="makeCallData" :isCalling="isCalling" :closeMeeting="closeMeeting" :isAudio="isAudio" :isVideo="isVideo"></make-call>
         </modal>

        </div> 
        <stall-chatting id="chatting_bot" v-if="isChatting" :closeChat="closeChat" :is_sent="is_sent"
        :chatFormData="chatFormData" :sendMessage="sendMessage" :send_message="send_message" :chatUserList="chatUserList" :receive_message="receive_message" :chattingUser="chattingUser" :chatWith="chatWith" :images="images" :openCallWindow="openCallWindow" :makeCall="makeCall">
        </stall-chatting>

        <div class="window-footer" v-if="isOutGoingWindow == true && isMinimize == true">

            <button type="button" @click="cancelOutGoingCall()" ><i class="fas fa-times" style="color:#fff;"></i>
            </button>
            <button type="button" @click="maximizeMakeCallWindow()"><i class="fas fa-window-maximize"></i></button>
            <button type="button" @click="minimizeMakeCallWindow()"><i class="fas fa-window-minimize"></i></button>

        </div>
            <div class="window-footer" v-if="isIncomingWindow == true && isMinimize == true">
                <button type="button" @click="cancelIncomingCall()" ><i class="fas fa-times" style="color:#fff;"></i>
                </button>
                <button type="button" @click="maximizeReceiveCallWindow()"><i class="fas fa-window-maximize"></i></button>
                <button type="button" @click="minimizeReceiveCallWindow()"><i class="fas fa-window-minimize"></i></button>
            </div>
            <!-- v-if="this.$route.name != 'StallDetails'" -->
            <div class="bto">
                <router-link to="#"   @click.native="openChat()">
                <i class="far fa-comments" id="open_chat_window"></i>
                </router-link>
            </div>

            <!-- :autoplaySpeed="5000" -->
            <carousel :autoplay="true" :nav="false" :dots="false" :loop="true"   :autoplayTimeout="2000" :responsive="{0:{items:1,nav:false},600:{items:2},900:{items:4},1200:{items:5}}">
                <!-- :autoplaySpeed="1000" -->

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'0.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'1.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'2.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                <img :src="footerImgUrl+'3.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'4.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                <img :src="footerImgUrl+'5.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'6.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'7.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'8.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'9.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="footerImgUrl+'10.gif'" alt="wlogo" class="img-fluid btn_gray">
                </div>

            </carousel>

        </div>


        </nav>

    </section>
    <!-- Footer Part Start -->
  </div>
</template>

<script>
import chat_mixin from '../../../src/chat-mixin'
import carousel from 'vue-owl-carousel'
import frmixin from '../../../src/mixin-frontend'
export default {
 mixins:[frmixin, chat_mixin],
    components: { carousel },
    data(){
    return {
        
    }
    },
    created(){
        
    }
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
 .vm--container{
        z-index: 999999999999 !important;
}   
.owl-carousel .owl-item img {
    display: block;
    width: 75%!important;
}

.btn_gray {
    background: #f8f8f8;
    border-radius: 5px;
    margin-top: 2%;
    height: 65px;
}
#footer_part {
    height: 71px;
}
.bg-dark {
	background: rgb(255, 255, 255 , .3) !important;
}


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
    rotate: -2deg;
    z-index: 9999;
}

.stall_banner_left_two {
    position: absolute;
    left: 15%;
    top: 21%;
    width: 9.4%;
    height: 57%;
    z-index: 9999;
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
