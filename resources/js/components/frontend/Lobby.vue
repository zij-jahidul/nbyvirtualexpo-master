<template>
   <div>
    <!-- Lobby Part Start -->
    <section id="lobby_part">
        <div class="row">
            <div class="col-lg-12 main-content-area">


                <LazyVideo style="width:100%; position:relative;" :src="imageUrl+'lobby.mp4'" :poster="imageUrl+'lobby.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>

                    <div class="header_ads_one" v-for="(adds, index) in lobbyAds" :key="index">
                            <div class="header_ads_body">
                               <ul class="ads_ul">
                                     <li class="ads_left_li">

                                        <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_left">

                                        <iframe class="iframe_left" :src="adds.ads_position == 4?adds.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                                     </li>

                                     <li class="ads_center_li">
                                             <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_middle">

                                             <iframe class="iframe_middle" :src="adds.ads_position == 2?adds.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                    </li>


                                     <li class="ads_right_li">
                                             <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_right">

                                             <iframe class="iframe_right" :src="adds.ads_position == 3?adds.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                                     </li>

                                 </ul>
                            </div>
                        </div>
                    <div class="floating-menu-container d-block d-sm-block d-md-none d-xl-none">
                        <i class="fas fa-bars" @click="floatingMenu"></i>
                        <div v-if="!isActive" class="floating_menu"  id="floating_menu">
                            <div class="floating-menu-item">
                                <router-link class="lobby_one" :to="user !== null?'/event-room':''">EVENT ROOM</router-link>
                            </div>
                            <div class="floating-menu-item">
                                <router-link class="lobby_two" :to="user !== null?'/exhibition-hall':''">EXHIBITION HALL</router-link>
                            </div>
                            <div class="floating-menu-item">
                                <router-link class="lobby_three" to="#" @click.native="helpDeskOpen()">HELP DESK</router-link>
                            </div>
                            <div class="floating-menu-item">
                                <router-link class="lobby_four" :to="user !== null?'/webinar':''">WEBINAR</router-link>
                            </div>
                            <div class="floating-menu-item">
                                <router-link class="lobby_five" :to="user !== null?'/blog-page':''">MEDIA CENTER</router-link>
                            </div>
                        </div>
                    </div>
                        <div class="lobby_setup d-none d-sm-none d-md-block d-xl-block">
                            <div class="lobby">
                                <ul>
                                    <li>
                                        <router-link class="lobby_one" :to="user !== null?'/event-room':''">EVENT ROOM</router-link>

                                    </li>

                                    <li>
                                        <router-link class="lobby_two" :to="user !== null?'/exhibition-hall':''">EXHIBITION HALL</router-link>
                                    </li>

                                    <li>
                                        <router-link class="lobby_three" to="#" @click.native="helpDeskOpen()">HELP DESK</router-link>
                                    </li>

                                    <li>
                                        <router-link class="lobby_four" :to="user !== null?'/webinar':''">WEBINAR</router-link>
                                    </li>

                                    <li>
                                        <router-link class="lobby_five" :to="user !== null?'/blog-page':''">MEDIA CENTER</router-link>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        
                        <div class="help_pop_button" id="popupOpen" @click="modalOpen"  data-toggle="modal" data-target="#exampleModalCenter"></div>
                           <!-- Button trigger modal -->
                            <!--<button type="button" style="display:none" id="popupOpen" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->

                            <!--</button>-->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                            <div class="modal-body">
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                               </button>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="info-box">
                                                         <button class="btn btn-success">Info-1</button>
                                                    </div>
                                                </div>
                                                  <div class="col-6">
                                                    <div class="info-box">
                                                         <button class="btn btn-info">Info-2</button>
                                                    </div>
                                                </div>
                                                
                                                  <div class="col-6">
                                                    <div class="info-box">
                                                         <button class="btn btn-info">Info-3</button>
                                                    </div>
                                                </div>
                                                
                                                  <div class="col-6">
                                                    <div class="info-box">
                                                        <button class="btn btn-success">Info-4</button>
                                                    </div>
                                                </div>
                                            </div>
                                               
                                            </div>
                                    </div>
                                </div>
                            </div>

                        <div class="footer_ads_left_li" v-for="adLeft in lobbyAds">
                            <img :src="imageUrl+'bottomleft.png'" alt="ads_banner" class="img-fluid footer_ads_one">

                            <iframe class="iframe_footer_left" :src="adLeft.ads_position == 5?adLeft.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                        </div>

                        <div class="footer_ads_right_li" v-for="adRight in lobbyAds">
                            <img :src="imageUrl+'bottomright.png'" alt="ads_banner" class="img-fluid footer_ads_two">

                            <iframe class="iframe_footer_right" :src="adRight.ads_position == 6?adRight.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                        </div>



                         <!-- <div class="bto">
                             <router-link to="#" @click.native="openChat()">
                                <i class="far fa-comments"></i>
                             </router-link>
                        </div> -->

                <sign-up  :signUp="signUp" :isOtp="isOtp" :trySignIn="trySignIn" id="form" v-if="isSignUp"></sign-up>

                <sign-in class="signin"  :signIn="signIn" :trySignUp="trySignUp" id="form" v-if="isSignIn"></sign-in>

                <otp  id="form" :inputData="inputData" v-if="isOtp" :trySignIn="trySignIn" :email="email" :password="password" :otpStatus="otpStatus" :isOtpFailedMessage="isOtpFailedMessage" :role="role" :otp="otp" :otpVerify="otpVerify" :resentOtp="resentOtp" :isOtp="isOtp" :isResentOtp="isResentOtp" :hasResentOtp="hasResentOtp" :resentOtpLink="resentOtpLink"></otp>


            </div>


        <help-desk class="help-desk" style="z-index:999999999999999999;" v-if="isHelpDesk" :helpDeskClose="helpDeskClose" :helpDeskSendMessage="helpDeskSendMessage" :send_message="send_message" :receive_message="receive_message" :adminUser="adminUser" :images="images" :helpdeskChatUser="helpdeskChatUser" :selectedUser="selectedUser"></help-desk>
        </div>

    </section>
   <!-- Lobby Part Start -->
   </div>
</template>

<script>
import {mapGetters} from 'vuex'
import { RadialMenu,  RadialMenuItem } from 'vue-radial-menu'
import VideoLazy from 'vue-lazyload-video'
import SignUp from '../../components/frontend/auth/SignUp'
import SignIn from '../../components/frontend/auth/SignIn'
import Otp from '../../components/frontend/auth/Otp'

import frmixin from '../../src/mixin-frontend'
import HelpDesk from './helpdesk/HelpDesk.vue';
import moment from 'moment'
export default {
 mixins:[frmixin],

    data(){
        return {
            otp:'',
            email:'',
            password:'',
            role:'',
            stallads: {},
            isOtp:false,
            inputData:{},
            isSignIn:false,
            isSignUp:false ,
            isResentOtp:false,
            isOtpFailedMessage:'',
            otpStatus:'',
            hasResentOtp:'',
            isSpin: false,
            lastClicked: 'click on something!',
            lobbyAds: {},
            isHelpDesk:false,

            send_message:[],
            receive_message:[],
            adminUser:[],
            adminAssistant:[],
            isActive:false,
            images:[],
            selectedUser:[]

        }

    },
    computed:{
        ...mapGetters({
            user:'user'
        })
    },

    components: {
         VideoLazy,
         SignUp,
         Otp,
         SignIn,
         RadialMenu,
         RadialMenuItem,
        HelpDesk
    }, 
    created() {
        this.getAdminUser()
        setTimeout(()=>{
             axios(this.url+'/api/lobby-ads').then(response=>{
                this.lobbyAds = response.data.data;
                console.log('lobbyAds', this.lobbyAds)
            })

        }, 1000)


        // FIREBASE MESSAGING

            messaging.onMessage((payload)=>{

            if(payload.data.call_state == 5){


                this.isHelpDesk = true


                this.send_message.push({id:payload.data.id, message: payload.data.chat_message, chat_document:payload.data.chat_document, user_id:payload.data.user_id, user_name:payload.data.user_name, user_photo:payload.data.user_photo, chat_time:this.isTimeAgo(), message_class:'you'})

                console.log('payload heldesk messaging', payload.data);

                this.getAdminUser()

            }
        })


    },
    mounted(){

        // console.log(this.user.token);

        if(this.user !== null){

            this.isSignIn   = false
            this.isSignUp   = false
            this.isOtp      = false

        } else{

            setTimeout(() => {

            this.isSignUp   = true
        }, 3000)

        }
    },
    methods:{

        isTimeAgo(){
            return moment()
        },
          modalOpen(){
              
            setTimeout(()=>{
          $('body').find('.modal-backdrop').hide()
            console.log('sdfsdfsdf')
        }, 100)
         
      },
        floatingMenu(){
            this.isActive = this.isActive != true;
        },
        handleClick (item) {
            this.lastClicked = item;
        },

        signUp(){

            var form_data = new FormData($('.signup')[0])
            let web_token = localStorage.getItem('web_token')
            form_data.append('web_token', web_token)
            axios.post(this.url+'/api/signup', form_data)
            .then(res => {
                console.log(res.data);
                if(res.data.status == 'success'){

                    this.isSignUp     = false
                    this.isOtp        = true
                    this.otp          = res.data.otp
                    this.email        = res.data.email
                    this.password     = res.data.password
                    this.role         = res.data.role
                    localStorage.setItem('otp', res.data.otp)

                }
            })
            .catch(error =>{

                if(error.response.status == 422){
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('input[name="'+item+'"]')
                        let inputAfter = jQuery(document).find('input[name="'+item+'"] + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')


                    })



                }
            })

        },

        trySignIn(){
            this.isSignIn   = true
            this.isSignUp   = false
            this.isOtp      = false

        },

        trySignUp(){
            this.isSignIn   = false
            this.isSignUp   = true
            this.isOtp      = false

        },


        otpVerify(){

        if(this.isOtp == true){
            var otpForm = new FormData($('.otp')[0])

            var digit_1 = $(document).find('input[name=digit_1]').val();
            var digit_2 = $(document).find('input[name=digit_2]').val();
            var digit_3 = $(document).find('input[name=digit_3]').val();
            var digit_4 = $(document).find('input[name=digit_4]').val();
            var digit_5 = $(document).find('input[name=digit_5]').val();
            var digit_6 = $(document).find('input[name=digit_6]').val();

            var confirm_otp = ''

            if(this.otpStatus == 'success'){

                confirm_otp = this.otp
                $(document).find('input[name=confirm_otp]').val(confirm_otp)

            } else {

                  confirm_otp = $(document).find('input[name=confirm_otp]').val();

            }

            var input_otp = digit_1 + digit_2 + digit_3 + digit_4 + digit_5 + digit_6
            console.log(input_otp);
            // if(confirm_otp == input_otp){
                 let web_token = localStorage.getItem('web_token')
                 otpForm.append('web_token', web_token)
                axios.post(this.url+'/api/otp-verify', otpForm)
                .then(res => {
                    // console.log(res.data.status);

                    if(res.data.status == 'success'){
                        this.isOtp = false,
                        this.isSignUp = false
                        console.log(res.data);
                        window.localStorage.setItem('user', JSON.stringify(res.data))
                        location.reload()
                    }
                })

            // } else {

            //     $('.verification').after('<span class="text-danger">Invalid OTP. Please try again</span>')

            // }
        }

        },

        resentOtpLink(){

        // this.isOtp = false
        this.isResentOtp = true
        $('.resent_otp_number').html('<input name="otp_resent_password" value="'+this.password+'">')

        },

        resentOtp(){

        let form_data = new FormData($('.form')[0])

        axios.post(this.url+'/api/resent-otp', form_data)
        .then(res => {
                console.log(res.data);
            if(res.data.otp_status === 'success'){
                console.log('otp', res.data.otp);
                this.isResentOtp = false
                this.isSignUp    = false
                this.isOtp       = true
                this.hasResentOtp = res.data.otp
                this.otp         = res.data.otp
                this.email       = res.data.email
                this.otpStatus   = res.data.otp_status
                this.role        = res.data.role

            } else {
                // console.log(res.data);
                if(res.data.otp_status == 'failed'){
                    this.otpStatus          = res.data.otp_status
                    this.isOtpFailedMessage = res.data.message
                }


            }

        })
        },

        signIn(){
            let web_token = localStorage.getItem('web_token')

            if(this.isOtp == true){
                this.$store
                .dispatch('signIn', {
                    email:this.email,
                    password:this.password,
                    role:this.role,
                    web_token:web_token


                })
                .the(response => {

                    if(response == undefined){
                        let error_message = JSON.parse(localStorage.getItem('error'));
                        console.log(error_message[0].message);
                        $('.sign_in_error').html('<strong class="text-danger">'+error_message[0].message+'</strong>')
                    }

                })
                .catch(error =>{
                    console.log(error.response.status);

                if(error.response.status == 422){
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('#email')
                        let inputAfter = jQuery(document).find('#password + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')

                    })



                }
            })
            } else {
                let sinInFormData = new FormData($('.signInForm')[0])
                sinInFormData.append('web_token', web_token)

                this.$store.dispatch('signIn', sinInFormData)

                .then(response => {
                    if(response == undefined){
                        let error_message = JSON.parse(localStorage.getItem('error'));
                        console.log(error_message[0].message);
                        $('.sign_in_error').html('<strong class="text-danger">'+error_message[0].message+'</strong>')
                    }

                })
                .catch(error =>{
                if(error.response.status == 422){
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('#email')
                        let inputAfter = jQuery(document).find('#password + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')

                    })



                }
            })
            }

        },

        // HELP DESK Chatting
        getAdminUser(){

            axios.get(this.url+'/api/helpdesk-chat-user')
            .then(res =>{
                this.adminUser = res.data
            })
        },
        helpDeskOpen(){
            
        if(this.user.user.role == 'Customer' || this.user.user.role == 'Company'){
            axios.get(this.url+'/api/get-admin-user')
            .then(resUser => {
                    axios.post(this.url+'/api/create-authority-chat-user', resUser.data)
                    .then(res => {

                        this.adminUser = res.data
                        console.log('this.adminUser', this.adminUser);
                        

                    })

            })
        } else {

            this.getAdminUser()
            

        } 

         this.isHelpDesk = true   
            
        },


        helpDeskClose(){
            this.isHelpDesk = false
        },


        helpDeskSendMessage(){
        
        let messageData =  new FormData($('.chatForm')[0])

        console.log('messageData', messageData);

        let chat_text = $('#chat_text').val()

        let chat_message = chat_text.replace(/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/g,'<a href="$1">$1</a>')

        var container = this.$el.querySelector("#chat");
        container.scrollTop = container.scrollHeight - container.clientHeight;
        console.log('SCROLL',container.scrollHeight);

        console.log('recever action', this.receive_message);

        var sentData = ''

        let guest_user_id = localStorage.getItem('guest_id')
        let authority_id = localStorage.getItem('authority')

        // let auth_id = this.$refs
        let authenticate_id = $('#authenticate_id').val();
        let user_id = this.user.user.id
        let message_class = authenticate_id == user_id?'me':'you'


        if(this.user.user.role == 'Customer' || this.user.user.role == 'Company'){

            messageData.append('chat_message', chat_message)
            messageData.append('authority_id', authority_id)
            // messageData.append('stall_id', stall_id)
            messageData.append('user_id', this.user.user.id)
            messageData.append('user_name', this.user.user.name)
            messageData.append('user_photo', this.user.user.photo)
            messageData.append('chat_document', this.file_name)

        }

        if(this.user.user.role == 'Secretary' || this.user.user.role == 'QueryAssistant'){

            messageData.append('chat_message', chat_message)
            messageData.append('authority_id', authority_id) 
            // messageData.append('stall_id', stall_id) 
            messageData.append('guest_user_id', guest_user_id) 
            messageData.append('call_state', 3) 
            messageData.append('user_id', this.user.user.id) 
            messageData.append('user_name', this.user.user.name) 
            messageData.append('user_photo', this.user.user.photo) 
            messageData.append('is_file', this.is_file) 


        }

        console.log('messageData',messageData);

        let apiUrl = this.user.user.role == 'Customer' || this.user.user.role == 'Company'?this.url+'/api/helpdesk-send-message':this.url+'/api/help-desk-receive-message'

        $('#chat_text').val("")
        $('#fiel_upload').val("")
        this.images = []

            axios.post(apiUrl, messageData)
            .then(res => {
                console.log(res.data);

                this.send_message.push({id:res.data.id, chat_document:res.data.chat_document, message:res.data.chat_message, user_id:res.data.user_id, user_name:res.data.receiver_name, chat_time:this.isTimeAgo(), user_photo:res.data.user_photo,message_class:'me'})

                // localStorage.setItem('chat', JSON.stringify(this.send_message))
                
            })
        },

        helpdeskChatUser(user){
          console.log('chat user', user);  
          this.selectedUser = user

          if(this.user.user.role == 'Customer' || this.user.user.role == 'Company'){
               localStorage.removeItem('guest_id')
              localStorage.removeItem('authority')
              localStorage.setItem('guest_id', user.receiver_id)
              localStorage.setItem('authority', user.user_id)

          } else {
              localStorage.removeItem('guest_id')
              localStorage.removeItem('authority')
               localStorage.setItem('guest_id', user.user_id)
              localStorage.setItem('authority', user.receiver_id)
          }

         

          axios.post(this.url+'/api/get-helpdesk-pair-message', user)
          .then(res=> {
              console.log('pair message', res.data)
              this.send_message = res.data
          })

        },

        helpDeskReceiveMessage(){

        }

    }
}
</script>

<style scoped>
.chat{
    z-index: 2147483647;
    position: absolute;
    right: 0;
    /* top:0; */
    bottom: 28%;
}
.li_first_div::after {
    content: "";
    background-color: red;
}

.main-content-area{
    position: relative;
    /* z-index: -1; */
}


.banner_ads_image_left {
    position: relative;
}

.iframe_left {
	position: absolute;
	left: 2.5%;
	top: 1%;
	bottom: 0px;
	right: 0;
	width: 19.2%;
	height: 71%;
}

.banner_ads_image_middle {
    position: relative;
}

.iframe_middle {
	position: absolute;
	width: 24%;
	height: 87%;
	left: 30.2%;
	top: 3%;
}

.banner_ads_image_right {
    position: relative;
}
.iframe_right {
	position: absolute;
	left: 62.7%;
	top: 1%;
	bottom: 0px;
	right: 0;
	width: 18.9%;
	height: 70%;
}

.footer_ads_one {
    position: relative;
}
.footer_ads_two {
    position: relative !important;
}

.iframe_footer_left {
	position: absolute;
	left: 33.3%;
	top: 10%;
	bottom: 0px;
	right: 0;
	width: 28.2%;
	height: 67%;
	transform: rotate(-1deg);
}

.iframe_footer_right {
	position: absolute;
	left: 32.3%;
	top: 9%;
	bottom: 0px;
	right: 0;
	width: 28.2%;
	height: 68%;
	transform: rotate(2deg);
}

    /* Down to top button End */
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

.floating-menu-container {
    position: absolute;
    top: 34%;
    color: red;
    background-color: rgba(255,255,255,.8) !important;
    z-index: 99999;
    left: 50%;
    padding: 5px 10px;
    text-align: right;
    transform: translate(-50%, 0);
}
.floating-menu-item a {
    color: #424242;
}
.floating-menu-container:hover{
    cursor: pointer;
}
.floating-menu-item {
    border-bottom: 1px solid #9e8585;
    font-size: 12px;
    padding-top: 2px;
}
.floating-menu-item:last-child {
    border: none;
}
.floating_menu{
    transition: .5s all linear;
}
.floating-menu a {
    color: silver;
}
.help_pop_button {
    background: transparent;
    height: 150px;
    width: 100px;
    position: absolute;
    z-index: 999;
    top: 44%;
    right: 11%;
    cursor: pointer;
}
.modal{
    z-index: 9999999 !important;
}
.modal-backdrop.show{
    display: none!important;
}
.info-box {
    text-align: center;
    border-radius: 10px;
    padding: 20px 0;
    margin-top: 10px;
    box-shadow: 0px 0px 6px #777777;
    border: 1px solid gray;
}
.info-box:hover{
      background: rgba(0,0,255,.1); 
      cursor: pointer;
}
button.close {
    position: absolute;
    right: 0;
    top: 0;
    background: silver;
    padding: 3px;
    border-radius: 5px;
    color: red;
}
</style>
