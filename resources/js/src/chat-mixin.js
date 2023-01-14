import { mapGetters } from 'vuex'
import StallChatting from '../components/frontend/helpdesk/StallChatting'

import ReceiveCall from '../components/frontend/stall//customer-care/ReceiveCall'
import MakeCall from '../components/frontend/stall/customer-care/MakeCall.vue';
import SupportUser from '../components/frontend/stall/SupportUser.vue';
import moment from 'moment'
export default {
    
        data(){
            return {
                stalls: {},
                isChatting:false,
                send_message:[],
                receive_message:[],
                stallads: {},
                isReceiveCall:false,
                isMakeCall:false,
                makeCallData:{},
                receiveData:{},
                companyToken:'',
                isCalling:true,
                touchDevice: ('ontouchstart' in window || navigator.msMaxTouchPoints) || false,
                isDragable:true,
                stallLogo: '',
                stallName: '',
                isVideoConversation:false,
                isChat:false,
                chattingUser:[],
               isOutGoingWindow:false,
               isIncomingWindow:false,
               isMinimize:false,
               isMaximize:false,
               isReceived:false,
               supportUsers:[],
               stallOwner:null,
               customerId:'',
               chatUserList:[],
               popupImage: '',
              
               file_name:{},
               chatFormData:{}, 
               images:[],
               is_sent:false,
               isAudio:false,
               isVideo:false,
    
    
            }
        },
      created(){
    
          
        messaging.onMessage((payload)=>{
            
    
            if(payload.data.call_state == 3){
    
                this.isChatting = false
                this.isChatting = true
    
                let chat_document = payload.data.chat_document    
                this.send_message.push({id:payload.data.id, message: payload.data.chat_message, chat_document:chat_document, is_file:payload.data.is_file,  chat_time:this.isTimeAgo(),user_id:payload.data.user_id, receiver_id:payload.data.customer_id, user_name:payload.data.user_name, user_photo:payload.data.user_photo, message_class:'you'}) 

                if(this.user.user.role == 'Customer'){

                    localStorage.setItem('exhibitor_id', payload.data.user_id)

                } else {

                    localStorage.setItem('visitor_id', payload.data.user_id)

                }

                
                
    
                this.loadUser(payload.data)
    
                this.is_sent = true
    
            } else if(payload.data.call_state == 3 && payload.data.call_status == 'received'){
    
                // this.isChat = true
                // this.isChatting = true
    
            }
             else if(payload.data.call_state == 4) {
                //  this.$modal.hide('incomingMessage')
                // this.$modal.hide('outGoingMessage')
            }
    
            else if(payload.data.call_state == 1 && payload.data.call_status != 'received'){           
                this.windowResizes()
                this.$modal.show('receiveCall')
                this.isIncomingWindow = true
                console.log('it works');
                this.receiveData = payload.data
                
                console.log('message received', this.receiveData);
                localStorage.setItem('company_id', payload.data.company_id)
                localStorage.setItem('customer_id', payload.data.customer_id)
    
            } else if(payload.data.call_state == 1 && payload.data.call_status == 'received'){
                this.isCalling = false
                this.isReceived = true
                this.customerId = payload.data.customer_id
            } else if(payload.data.call_state == 2){
                this.isReceived = false
                this.$modal.hide('makeCall')
                this.$modal.hide('receiveCall')
                localStorage.removeItem('company_id')
            }
        })
    
        setTimeout(() => {
              var element = document.getElementById("goto");
              element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"})
            //   .offset(-50);
          }, 1000)
    

        this.updateScroll()
        this.getStallUser()
        this.windowResizes()
    
      },
      mounted(){
    
        
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
    
        chatUserListHeight:function(){
                let mobileheight = $('.support-list-area').innerHeight
                return mobileheight
        },
        
      },
    
      methods: {
    
        isTimeAgo(){
            return moment()
        },
        
        modalOpen(popup){
              this.popupImage = popup;
              $('#popupOpen').click()
        },
    
        
        getStallUser(){
            let company_id = this.$route.params.company_id
            let stall_id = this.$route.params.stall_id

            let stallId = localStorage.getItem('stall_id')
            let companyId = localStorage.getItem('company_id')

            stall_id = stall_id !=undefined? stall_id:stallId
            company_id  = company_id !=undefined? company_id:companyId
            
            if(this.user.user.role == 'Customer'){

                axios.get(this.url+'/api/get-stall-user?company_id='+company_id+'&'+'stall_id='+stall_id)
                .then(res=>{
                    this.supportUsers = res.data.data
                    console.log('stall user', res.data);
        
                    let stallOwner = res.data.data.filter(x => x.id == this.user.user.id).map(x => x.id);
                    this.stallOwner = stallOwner[0]
                    console.log('stall owner', this.stallOwner); 
                })

            } 

            let userId = this.user.user.id

            if(this.user.user.role == 'Company'){
                
                axios.get(this.url+'/api/get-stall-user?user_id='+userId+'&company_id='+company_id+'&stall_id='+stall_id)
                .then(res => {
                   
                    this.supportUsers = res.data.data
    
                    console.log('this.supportUsers', this.supportUsers);
    
                })  

            }


        },
    
        windowResizes(){
    
            if(this.$isMobile() == true){
    
                this.isDragable = false
    
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
    
        getExtension(filename) {
            var parts = filename.split('.');
            return parts[parts.length - 1];
        },
    
        isImage(filename) {
            var ext = this.getExtension(filename);
            switch (ext.toLowerCase()) {
                case 'jpg':
                case 'gif':
                case 'bmp':
                case 'png':
                //etc
                return true;
            }
            return false;
        },
    
    
        sendMessage(){
    
          let messageData =  new FormData($('.chatForm')[0])
    
            let chat_text = $('#chat_text').val()
    
            let chat_message = chat_text.replace(/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/g,'<a href="$1">$1</a>')
    
            //window.scrollTo(0,document.querySelector("#chat").scrollHeight);
            var container = this.$el.querySelector("#chat");
            container.scrollTop = container.scrollHeight - container.clientHeight;
            console.log('SCROLL',container.scrollHeight);
    
    
            var sentData = ''
    
            let customer_id = localStorage.getItem('visitor_id')
            // let auth_id = this.$refs
            let authenticate_id = $('#authenticate_id').val();
            console.log('authenticate_id', authenticate_id);
            let user_id = this.user.user.id
            let message_class = authenticate_id == user_id?'me':'you'
    
            // let stall_id = this.$route.params.stall_id
            // let company_id = this.$route.params.company_id

            // if(stall_id != undefined && company_id != undefined){

            //     localStorage.removeItem('stall_id')
            //     localStorage.removeItem('company_id')


            //     localStorage.setItem('stall_id', stall_id)
            //     localStorage.setItem('company_id', company_id)
            // }

            let stallId = localStorage.getItem('stall_id')
            let companyId = localStorage.getItem('company_id')

            let stall_id = stallId // stall_id !=undefined? stall_id:stallId
            let company_id  = companyId // company_id !=undefined? company_id:companyId

            console.log('stall_id', stall_id);
    
            if(this.user.user.role == 'Customer'){
    
                messageData.append('chat_message', chat_message)
                messageData.append('company_id', company_id)
                messageData.append('stall_id', stall_id)
                messageData.append('user_id', this.user.user.id)
                messageData.append('user_name', this.user.user.name)
                messageData.append('user_photo', this.user.user.photo)
                messageData.append('chat_document', this.file_name)
                
    
            }
  
    
            if(this.user.user.role == 'Company' || this.user.user.role == 'CustomerCare'){

    
                messageData.append('chat_message', chat_message)
                messageData.append('company_id', company_id) 
                messageData.append('stall_id', stall_id) 
                messageData.append('customer_id', customer_id) 
                messageData.append('call_state', 3) 
                messageData.append('user_id', this.user.user.id) 
                messageData.append('user_name', this.user.user.name) 
                messageData.append('user_photo', this.user.user.photo) 
                messageData.append('is_file', this.is_file) 
            }
    
        //    this.chatFormData = ""
            
    
            let apiUrl = this.user.user.role == 'Customer'?this.url+'/api/send-message':this.url+'/api/receive-message'
    
            // event.target.value = ''
            $('#chat_text').val("")
            $('#fiel_upload').val("")
            this.images = []
            
            axios.post(apiUrl, messageData)
            .then(res => {
                console.log(res.data);
                let chat_document = res.data.chat_document
                this.send_message.push({id:res.data.id, message:res.data.chat_message,chat_document:chat_document , is_file:res.data.is_file, user_id:res.data.user_id, receiver_id:res.data.customer_id, chat_time:this.isTimeAgo(), user_name:res.data.user_name, user_photo:res.data.user_photo,message_class:'me'})
                
                localStorage.setItem('chat', JSON.stringify(this.send_message))
    
                this.loadUser(res.data)
                this.is_sent = true
                            
            })
        },
    
    
        chatWith(chatUser){
            
            localStorage.removeItem('exhibitor_id')
            localStorage.removeItem('visitor_id')

            if(this.user.user.role == 'Customer'){

               localStorage.setItem('exhibitor_id', chatUser.user_id) 

            } else {

               localStorage.setItem('visitor_id', chatUser.user_id) 


            }

            // let stall_id = this.$route.params.stall_id
            // let company_id = this.$route.params.company_id

            let user_id = this.user.user.id
            let receiver_id = ''



            if(this.user.user.role == 'Customer'){

                receiver_id = localStorage.getItem('exhibitor_id')

            } else {

                receiver_id = localStorage.getItem('visitor_id')

            }

            console.log('it is stall id', chatUser);

            localStorage.setItem('stall_id', chatUser.stall_id)
            localStorage.setItem('company_id', chatUser.company_id)
            localStorage.setItem('chat_room_id', chatUser.chat_room_id)
            

            // let stallId = localStorage.getItem('stall_id')
            // let companyId = localStorage.getItem('company_id')


            // stall_id = stall_id != undefined?stall_id:stallId
            // company_id = company_id != undefined?company_id:companyId
    
            this.chattingUser = chatUser
    
            let userMsg = JSON.parse(localStorage.getItem('chat'))
            let visitorId = localStorage.getItem('visitor_id')
    
            // let msg = userMsg.filter(message => message.receiver_id == chatUser.user_id).map(message.message)
            // this.send_message = []
           
            let stallId   = chatUser.stall_id
            let companyId     = chatUser.company_id
            let chat_room_id = chatUser.chat_room_id

            axios.get(this.url+'/api/get-pair-message?user_id='+user_id+'&receiver_id='+receiver_id+'&company_id='+companyId+'&stall_id='+stallId+'&chat_room_id='+chat_room_id)
            .then(res => {
                console.log('pair message', res.data);
                
                this.send_message = res.data
            })
    
            this.loadUser(chatUser)
            
            
        },
    
        loadUser(chatUser){

            let stall_id   = chatUser.stall_id //this.$route.params.stall_id
            let company_id = chatUser.company_id //this.$route.params.company_id

            if(this.$route.name == 'StallDetails'){
                localStorage.removeItem('stall_id')
                localStorage.removeItem('company_id')

                localStorage.setItem('stall_id', stall_id)
                localStorage.setItem('company_id', company_id)

            }

            let stallId    = localStorage.getItem('stall_id')
            let companyId  = localStorage.getItem('company_id')

            // stall_id = stall_id != undefined?stall_id:stallId
            // company_id = company_id != undefined?company_id:companyId

            let visitor_id = localStorage.getItem('visitor_id')
            let exhibitor_id = localStorage.getItem('exhibitor_id')

            let userId = this.user.user.id // == 'Customer'?exhibitor_id:visitor_id
            
            axios.get(this.url+'/api/get-chat-user?user_id='+userId+'&company_id='+company_id+'&stall_id='+stall_id)
            .then(res => {
               
                this.chatUserList = res.data

                // console.log('this.chatUserList', this.chatUserList);

            })
    
        },
    
    
        openChat(){
            
            this.isChatting = true
            let user_id = this.user.user.id

            let stall_id   = this.$route.params.stall_id
            let company_id = this.$route.params.company_id

            if(this.$route.name == 'StallDetails'){

                localStorage.setItem('stall_id', stall_id)
                localStorage.setItem('company_id', company_id)  

            }

            

            let stallId    = localStorage.getItem('stall_id')
            let companyId  = localStorage.getItem('company_id')
            

            stall_id = stall_id != undefined?stall_id:stallId
            company_id = company_id != undefined?company_id:companyId

           console.log('open chat stall_id', stall_id);
           console.log('open chat company_id', company_id);

            let api = ''
            if(this.$route.params.stall_id == undefined){

               api = this.url+'/api/load-chat-user?user_id='+user_id

            } else {

            api = this.url+'/api/get-chat-user?user_id='+user_id+'&company_id='+company_id+'&stall_id='+stall_id

            }
            axios.get(api)
            .then(res => {
                console.log('pair message', res.data.user_photo);

                if(this.$route.params.stall_id != undefined){

                    if(this.user.user.role == 'Customer' && res.data.chat_room_id != '123456'){

                    let message = res.data.filter(msg => msg.stall_id  ==  msg.stall_id)
    
                    this.chattingUser = message[0]
                    this.send_message = message[0].message
                    console.log('message', message[0].message);
    
                    }

                    this.chatUserList = res.data

                    console.log('this.chatUserList', this.chatUserList);
                } else {

                    this.chatUserList = res.data

                }

                
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
    
        makeCall(user_id, call_type){
    
             if(call_type == 'voice'){
    
                this.isAudio = true
    
            } else {
    
                 this.isVideo = false
    
            }
    
            if(call_type == 'video'){
    
                this.isVideo = true
                
            } else {
    
                this.isAudio = false
    
            }
    
    
            this.$modal.hide('supportuser')
            this.isOutGoingWindow = true
            this.isCalling = true
    
           
    
            localStorage.setItem('company_id', user_id)
    
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

                let stall_id   = this.$route.params.stall_id
                let company_id = this.$route.params.company_id

                let stallId    = localStorage.getItem('stall_id')
                let companyId  = localStorage.getItem('company_id')
                
                stall_id = stall_id != undefined?stall_id:stallId
                company_id = company_id != undefined?company_id:companyId
                
                console.log('make call stall id', stall_id);
                console.log('make call company id', company_id);
    
                let  data = {
                            callState:1,
                            call_type:call_type,
                            user_id:user_id,
                            company_id:company_id,
                            stall_id:stall_id,
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
            let user_id = localStorage.getItem('company_id')
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
                        localStorage.removeItem('company_id')
                        this.$modal.hide('makeCall')

                        console.log(res);
                }
            })
    
        },
    
        receiveCall(){
    
        let user_id = localStorage.getItem('customer_id')
    
            console.log('user_id', user_id);
    
            let data = {
                customer_id:user_id,
                call_state:1
    
            }
    
            axios.post(this.url+'/api/receive-call', data)
            .then(res => {
    
                if(res){
    
                    this.isReceived = true
                    //  $('#videocall_part').remove()
    
                }
    
            })
        },
    
        cancelIncomingCall(){
            this.$modal.hide('receiveCall')
            this.isReceived = false
            this.isMinimize = false
            this.isMaximize = false
            this.isIncomingWindow = false
            let user_id = localStorage.getItem('company_id')
            let data = {
                customer_id:this.receiveData.customer_id,
                call_state:2,
                user_id:user_id
        }
    
    
        axios.post(this.url+'/api/cancel-incoming-call', data)
        .then(res => {
    
        //  let receive_call = this.url+'/receive-call'
        //  window.close(receive_call)
    
            localStorage.removeItem('company_id')
            localStorage.removeItem('customer_id')
    
        })
        },
    
        minimizeReceiveCallWindow(){
            // this.windowResizes()
            
            this.isMinimize = true
            this.isMaximize = false
            this.$modal.hide('receiveCall')
    
        },
    
        maximizeReceiveCallWindow(){
            // this.windowResizes()
            // this.isReceived = true
            if(this.isReceived == true){
    
              this.isReceived = true  
              
            }
            this.isMinimize = false
            this.isMaximize = true
            this.$modal.show('receiveCall')
        },
    
        minimizeMakeCallWindow(){
            // this.windowResizes()
           this.isMinimize = true
            this.isMaximize = false
            this.$modal.hide('makeCall')
    
        },
    
        maximizeMakeCallWindow(){
            // this.windowResizes()
            this.isMinimize = false
            this.isMaximize = true
            this.$modal.show('makeCall')
        }
      },
    
        components: {
            StallChatting,
            MakeCall,
            ReceiveCall,
            SupportUser,
            // OutGoingMessage,
            // IncomingMessage
        },
    
    }