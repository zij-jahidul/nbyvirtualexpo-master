<template>

    <div v-if="user.user.role =='Customer' || ( stallId == user.stall_owner.stall_id)">

        <!-- Video Call Modal -->
        <div class="videoCall">
            <modal name="receiveCall" :draggable="isDragable" :clickToClose="false" :reset="true"  :resizable="true" :adaptive="true" :width="screenWidth" :height="screenHeight">
                <div class="window-header">
                    <button type="button" @click="cancelIncomingCall()" >
                        <i class="fas fa-times" style="color:red;"></i>
                    </button>
                    <button type="button" @click="maximizeReceiveCallWindow()"><i class="fas fa-window-maximize"></i></button>
                    <button type="button" @click="minimizeReceiveCallWindow()"><i class="fas fa-window-minimize"></i></button>

                </div>

                <receive-call :cancelIncomingCall="cancelIncomingCall" :receiveData="receiveData" :closeMeeting="closeMeeting" :isReceived="isReceived"></receive-call>
            </modal>

            <modal name="makeCall" :draggable="isDragable" :clickToClose="false" :reset="true" :resizable="true" :adaptive="true" :width="screenWidth" :height="screenHeight">
                <div class="window-header">

                    <button type="button" @click="cancelOutGoingCall()" ><i class="fas fa-times" style="color:red;"></i>
                    </button>
                    <button type="button" @click="maximizeMakeCallWindow()"><i class="fas fa-window-maximize"></i></button>
                    <button type="button" @click="minimizeMakeCallWindow()"><i class="fas fa-window-minimize"></i></button>




                </div>
                <make-call :cancelOutGoingCall="cancelOutGoingCall" :makeCallData="makeCallData" :isCalling="isCalling" :closeMeeting="closeMeeting"></make-call>
            </modal>

            <modal name="supportuser" :draggable="isDragable" :clickToClose="true" :reset="true" :resizable="true" :adaptive="true" :width="300">
                <div class="window-header">
                    <strong class="text-white">{{stallName}} Support List</strong>
                    <button type="button" @click="closeSupportWindow()" >
                        <i class="fas fa-times" style="color:red;"></i>
                    </button>
                </div>
                <support-user :supportUsers="supportUsers" :makeCall="makeCall"></support-user>
            </modal>
        </div>

        <section id="stalllayout_part" style="position:relative">
            <img style="width:100%; object-fit: cover;" :src="imageUrl+'new_stall.jpg'"/>

                <div class="top-nav-button">
                    <button class="button-item"><a href="#tab0" @click="goToTab('#tab0')"><span class="d-none d-sm-none d-md-block">Product</span><span class="d-block d-sm-block d-md-none"><i class="fab fa-product-hunt"></i></span></a></button>
                    <button class="button-item"><a href="#tab1" @click="goToTab('#tab1')"><span class="d-none d-sm-none d-md-block">Resource</span><span class="d-block d-sm-block d-md-none"><i class="fas fa-suitcase-rolling"></i></span></a></button>
                    <button class="button-item"><a href="#tab2" @click="goToTab('#tab2')"><span class="d-none d-sm-none d-md-block">About</span><span class="d-block d-sm-block d-md-none"><i class="fas fa-address-card"></i></span></a></button>
                </div>
                <div class="chat-call-message">
                    <router-link to = "#" @click.native="openChat();" v-if="user.user.role === 'Customer'" class="far fa-comment-dots">
                    </router-link>
                    <router-link to="#" v-if="user.user.role === 'Customer'" @click.native="openCallWindow()" class="fas fa-video">
                    </router-link>
                    <router-link to="" v-if="user.user.role === 'Customer'" class="fas fa-envelope">
                    </router-link>
                </div>
                <stall-chatting id="chatting_bot" v-if="isChatting" :closeChat="closeChat" :sendMessage="sendMessage" :send_message="send_message" :receive_message="receive_message" :companyUser="companyUser"></stall-chatting>

        </section>

        <div class="container pl-0"  style="margin-bottom: 20%;">
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

        <div class="window-footer" v-if="isOutGoingWindow == true && isMinimize == true">



            <button type="button" @click="cancelOutGoingCall()" >
                <i class="fas fa-times" style="color:red;"></i>
            </button>
            <button type="button" @click="maximizeMakeCallWindow()"><i class="fas fa-window-maximize"></i></button>
            <button type="button" @click="minimizeMakeCallWindow()"><i class="fas fa-window-minimize"></i></button>

        </div>
        <div class="window-footer" v-if="isIncomingWindow == true && isMinimize == true">

            <button type="button" @click="cancelIncomingCall()" >
                <i class="fas fa-times" style="color:red;"></i>
            </button>
            <button type="button" @click="maximizeReceiveCallWindow()"><i class="fas fa-window-maximize"></i></button>

            <button type="button" @click="minimizeReceiveCallWindow()"><i class="fas fa-window-minimize"></i></button>

        </div>
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
import Resource from "../stall/stall-tabs/Resource";
import AboutUs from "../stall/stall-tabs/AboutUs";
import Offer from "../stall/stall-tabs/Offer";
import VideoLazy from 'vue-lazyload-video'
import StallChatting from '../helpdesk/StallChatting'

import ReceiveCall from './customer-care/ReceiveCall'
import MakeCall from './customer-care/MakeCall.vue';




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
        component: Resource
    },
    {
        name:'About Us',
        component: AboutUs
    }
]

import frmixin from '../../../src/mixin-frontend'
import SupportUser from './SupportUser.vue';
// import OutGoingMessage from './customer-care/OutGoingMessage.vue';
// import IncomingMessage from './customer-care/IncomingMessage.vue';
export default {
    mixins:[frmixin],

    data(){
        return {
            stalls: {},
            tabs,
            currentTab: tabs[0],
            isChatting:false,
            send_message:[],
            receive_message:[],
            stallads: {},
            isReceiveCall:false,
            isMakeCall:false,
            makeCallData:{},
            receiveData:{},
            // receiveMessageData:{},
            // outGoingMessageData:{},
            companyToken:'',
            isCalling:true,
            screenWidth:'',
            screenHeight:'',
            touchDevice: ('ontouchstart' in window || navigator.msMaxTouchPoints) || false,
            isDragable:true,
            stallLogo: '',
            stallName: '',
            isVideoConversation:false,
            isChat:false,
            companyUser:[],
            isOutGoingWindow:false,
            isIncomingWindow:false,
            isMinimize:false,
            isMaximize:false,
            isReceived:false,
            supportUsers:[],
            stallOwner:null,



        }
    },
    created(){
        setTimeout(() => {
            var element = document.getElementById("goto");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"}).offset(-50);
        }, 1000)



        let stall_id = this.$route.params.stall_id
        console.log('this.$route.params')
        console.log(this.$route.params)
        setTimeout(() => {
            axios.get(this.url+'/api/frontend-stall-details?stall_id='+stall_id)
                .then(res => {
                    this.stallLogo = res.data.data.company_logo
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

        this.updateScroll()


        messaging.onMessage((payload)=>{

            if(payload.data.call_state == 3){
                let chat_information= localStorage.getItem('chatInfo')

                localStorage.removeItem('visitor')

                localStorage.setItem('visitor', payload.data.customer_id)

                this.isChatting = true

                this.receive_message.push({message: payload.data.chat_message, chat_time:payload.data.chat_time,user_id:payload.data.user_id, user_name:payload.data.user_name, user_photo:payload.data.user_photo, message_class:'you'})


            } else if(payload.data.call_state == 3 && payload.data.call_status == 'received'){



            }
            else if(payload.data.call_state == 4) {

            }

            else if(payload.data.call_state == 1 && payload.data.call_status != 'received'){
                let receive_call_url = window.location.origin+'/receive-call';
                this.isIncomingWindow = true
                this.$modal.show('receiveCall')
                this.receiveData = payload.data
                localStorage.setItem('support_id', payload.data.company_id)

            } else if(payload.data.call_state == 1 && payload.data.call_status == 'received'){
                this.isCalling = false
                this.isReceived = true
                this.screenWidth = window.innerWidth
                this.screenHeight = window.innerHeight
            } else if(payload.data.call_state == 2){
                this.isReceived = false
                this.$modal.hide('makeCall')
                this.$modal.hide('receiveCall')
                localStorage.removeItem('support_id')
                // console.log('payload.data', payload.data);
            }
        })

        this.getStallUser()
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

    methods: {
        getStallUser(){
            let company_id = this.$route.params.company_id
            let stall_id = this.$route.params.stall_id
            axios.get(this.url+'/api/get-stall-user?company_id='+company_id+'&'+'stall_id='+stall_id)
                .then(res=>{
                    this.supportUsers = res.data.data
                    console.log('stall user', res.data);

                    let stallOwner = res.data.data.filter(x => x.id == this.user.user.id).map(x => x.id);
                    this.stallOwner = stallOwner[0]
                    console.log('stall owner', this.stallOwner);
                })
        },
        windowResizes(){

            if(this.$isMobile() == true){

                this.isDragable = false

                if(this.isChat == false){

                    this.screenWidth = window.innerWidth
                    this.screenHeight = window.innerHeight

                } else {

                    this.screenWidth = 380
                    this.screenHeight = window.innerHeight - 50

                }


            } else {
                if(this.isChat == false){

                    this.screenWidth = window.innerWidth - 300
                    this.screenHeight = window.innerHeight - 50

                } else {

                    this.screenWidth = 380
                    this.screenHeight = window.innerHeight - 50

                }

            }
        },

        closeMeeting(){
            this.$modal.hide('makeCall')
            this.$modal.hide('receiveCall')
        },
        goToTab(tabId){
            console.log(tabId)
            $(tabId).click()
        },

        closeChat(){
            //   this.$modal.hide('outGoingMessage')
            //   this.$modal.hide('incomingMessage')
        },

        sendMessage(event){

            console.log(event.target.value);
            let chat_message = event.target.value

            //   window.scrollTo(0,document.querySelector("#chat").scrollHeight);
            var container = this.$el.querySelector("#chat");
            container.scrollTop = container.scrollHeight - container.clientHeight;
            console.log('SCROLL',container.scrollHeight);


            var sentData = ''

            let customer_id = localStorage.getItem('visitor')
            // let auth_id = this.$refs
            let authenticate_id = $('#authenticate_id').val();
            let user_id = this.user.user.id
            let message_class = authenticate_id == user_id?'me':'you'
            console.log('authenticate_id', authenticate_id);

            if(this.user.user.role == 'Customer'){
                sentData = {

                    company_id:this.$route.params.company_id,
                    chat_message:chat_message,
                    user_id:this.user.user.id,
                    user_name:this.user.user.name,
                    user_photo:this.user.user.photo

                }

            }

            if(this.user.user.role == 'Company' || this.user.user.role == 'CustomerCare'){

                sentData = {
                    customer_id:customer_id,
                    call_state:3,
                    chat_message:chat_message,
                    user_id:this.user.user.id,
                    user_name:this.user.user.name,
                    user_photo:this.user.user.photo
                }
            }

            let apiUrl = this.user.user.role == 'Customer'?this.url+'/api/send-message':this.url+'/api/receive-message'

            axios.post(apiUrl, sentData)
                .then(res => {
                    console.log(res.data);

                    this.send_message.push({message:res.data.chat_message, user_id:res.data.user_id, chat_time:res.data.chat_time, user_name:res.data.user_name, user_photo:res.data.user_photo,message_class:'me'})

                    event.target.value = ''
                })
        },


        openChat(){
            //  this.$modal.show('outGoingMessage')
            this.isChatting = true
            let company_id = this.$route.params.company_id
            axios.get(this.url+'/api/company-user?company_id='+company_id)
                .then(res =>{
                    let data = {
                        user_id:res.data.id,
                        user_name:res.data.name,
                        user_photo:this.url+'/public/images/user/'+res.data.photo
                    }

                    this.companyUser = data
                })
        },

        closeChat(){
            this.isChatting = false
        },

        updateScroll(){
            // var element = document.getElementById("chatting_bot");
            // element.scrollTop = element.scrollHeight;
            jQuery('#chatting_bot').animate({scrollTop:0},0);
        },
        openCallWindow(){
            this.getStallUser()
            this.$modal.show('supportuser')
        },

        closeSupportWindow(){
            this.$modal.hide('supportuser')
        },
        makeCall(user_id){
            this.$modal.hide('supportuser')
            this.isOutGoingWindow = true
            this.isCalling = true
            localStorage.setItem('support_id', user_id)

            this.windowResizes()

            let token ='';
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function(token){

                    console.log('token', token);
                    token = token
                })


            let  data = {
                callState:1,
                user_id:user_id,
                stall_id:this.$route.params.stall_id,
                company_id:this.$route.params.company_id,
                customer_token:token
            }

            axios.post(this.url+'/api/make-call', data)
                .then(res =>{
                    if(res){

                        this.$modal.show('makeCall')
                        console.log('make call',res);

                        this.makeCallData = res.data
                    }
                })





        },

        cancelOutGoingCall(){
            this.isOutGoingWindow = false
            this.isMinimize = false
            this.isMaximize = false
            let user_id = localStorage.getItem('support_id')
            let  data = {
                callState:2,
                stall_id:this.$route.params.stall_id,
                company_id:this.$route.params.company_id,
                company_user_token:this.companyToken,
                user_id:user_id
            }

            axios.post(this.url+'/api/cancel-outgoing-call', data)
                .then(res => {

                    if(res){
                        // let cancel_call_url = this.url+'/make-call'
                        // window.close(cancel_call_url)
                        localStorage.removeItem('support_id')
                        this.$modal.hide('makeCall')

                        console.log(res);
                    }
                })

        },

        cancelIncomingCall(){
            this.$modal.hide('receiveCall')
            this.isReceived = false
            this.isMinimize = false
            this.isMaximize = false
            this.isIncomingWindow = false
            let user_id = localStorage.getItem('support_id')
            let data = {
                customer_id:this.receiveData.customer_id,
                call_state:2,
                user_id:user_id
            }


            axios.post(this.url+'/api/cancel-incoming-call', data)
                .then(res => {

                    //  let receive_call = this.url+'/receive-call'
                    //  window.close(receive_call)

                    localStorage.removeItem('support_id')

                })
        },

        minimizeReceiveCallWindow(){
            this.windowResizes()
            this.isMinimize = true
            this.isMaximize = false
            let windowHeight = window.innerHeight
            this.$modal.hide('receiveCall')

        },

        maximizeReceiveCallWindow(){
            this.windowResizes()
            this.isReceived = true
            this.isMinimize = false
            this.isMaximize = true
            let windowHeight = window.innerHeight
            this.$modal.show('receiveCall')
        },

        minimizeMakeCallWindow(){
            this.windowResizes()
            this.isMinimize = true
            this.isMaximize = false
            let windowHeight = window.innerHeight
            this.$modal.hide('makeCall')

        },

        maximizeMakeCallWindow(){
            this.windowResizes()
            this.isMinimize = false
            this.isMaximize = true
            let windowHeight = window.innerHeight
            this.$modal.show('makeCall')
        }
    },
    components: {
        VideoLazy,
        StallChatting,
        MakeCall,
        ReceiveCall,
        SupportUser,
        // OutGoingMessage,
        // IncomingMessage
    },

}
</script>

<style scoped>

.window-header{
    height:40px;
    padding:5px;
    background:#124884;

}

.window-header button{
    float:right;
}

.window-footer {
    height: 50px;
    padding: 5px;
    background: #124884;
    z-index: 999999999999999999999999;
    position: absolute;
    width: 100%;
    /* display: flex; */
    /* overflow: hidden; */
    /* margin-top: 10%; */
    bottom: 1px;
}

.window-footer button{
    float:right;
}

.vm--container{
    z-index: 999999999999 !important;
}

.stall_company_logo {
    position: absolute;
    left: 69%;
    top: 63%;
    transform: translateX(-50%);
    width: 9% !important;
    z-index: 9999;
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
    z-index: 9999;
}

.stall_banner_right_two {
    position: absolute;
    right: 14%;
    top: 22%;
    width: 9%;
    height: 52%;
    rotate: 1deg;
    z-index: 9999;
}




.stalldetails_image_stall {
    width: 100%;
    height: 850px !important;
}

li.nav-item.stall-tab.active{
    background: #6abd47 !important;
}
li.nav-item.stall-tab .active a{
    color: white !important;
}
li.nav-item.stall-tab {
    padding: .8% 5%;
}
li.nav-item.stall-tab a{
    color: black !important;
}
li.nav-item.stall-tab a:hover {
    text-decoration: none;
}
ul#pills-tab {
    margin: 3% 5px;
    border-bottom: 1px solid #e6e6e6;
}
.top-nav-button {
    display: inline-grid;
    position: absolute;
    left: 10%;
    top: 39%;
}
.top-nav-button button {
    margin-top: 5px;
}
button.button-item {
    color: white;
    background: green;
    border: 1px solid yellowgreen;
    border-radius: 5px;
    max-width: 10vw;
    font-size: 1.5vw;
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
    top: 37%;
    right: 15%;
}
.chat-call-message .fas, .chat-call-message .far {
    background: green;
    margin-top: .5vw;
    padding: .75vw;
    border-radius: 1vw;
    border: 1px solid greenyellow;
    font-size: .9vw;
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
</style>
