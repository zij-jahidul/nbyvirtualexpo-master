<template>

  <div>

    <div id="container"> 
        <aside class="customer-aside">
            <header>
                <div class="profile-pic">
                    <img style="width:40px; height:40px; border-radius:50%;" :src="userImage+user.user.photo">
                </div>
                <div class="header-tools">
                   <span @click="isSearch = !isSearch"> <i class="fa fa-search"></i></span>
                   <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                </div>
                <input v-if="isSearch" type="text" placeholder="search">
            </header>
            <!-- <ul>

               <li v-for="(assistant, asIndex) in adminUser" :key="asIndex" v-if="!assistant.isComplete" @click="user.user.id ==helpdeskChatUser(assistant)">
                    <img style="width:55px;height:55px;" :src="userImage+assistant['photo']" alt="">
                    <div>
                        <h2>{{ assistant['name'] }}</h2>
                        <h3>
                            <span class="status green"></span>
                            online
                        </h3>
                    </div>
                </li>
            </ul> -->

            <ul class="list-group aside_ul">
                <li class="aside_li list-group-item d-flex justify-content-between align-items-center" v-for="(assistant, asIndex) in adminUser" :key="asIndex" @click="helpdeskChatUser(assistant); focusUser(asIndex)" :class="'user_list'+asIndex" v-if="adminUser.length > 0">                        
                    <img style="width:45px; height:45px; margin-left:1%;" class="" :src="assistant.user_photo" alt="">
                    <small style="margin-left: 27%; position:absolute;">{{ assistant.user_name }} &nbsp; <i class="status" :class="assistant.online_status == 1?'green':''"></i></small> 
                    <span class="badge badge-primary badge-pill" v-if="assistant.message_reading > 0"> {{assistant.message_reading}} </span>                        
                </li>
               
            </ul>
        </aside>
        <main>
            <header>
                <div class="image">
                    <img v-if="selectedUser.user_photo != null" style="width:45px;height:45px;" :src="selectedUser.user_photo" alt="No Image">
                    <img v-else :src="userImage+'user-default.png'" style="width:45px;height:45px;" alt="">
                </div>
                <div class="user-name">
                    <h2>{{ selectedUser.user_name != null?selectedUser.user_name:'No User' }}</h2>
                    <h4>{{ selectedUser.online_status == 1?'online':'offline' }}</h4>
                </div>
                <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt=""> -->
                <div class="tools">
                    <!-- <span v-if="selectedUser.user_name !=null"><i class="fa fa-video"></i></span>
                    <span v-if="selectedUser.user_name !=null"><i class="fas fa-phone" aria-hidden="true" style="transform: rotateZ(92deg);"></i></span> -->
                    <span  @click="helpDeskClose"><i class="fa fa-minus"></i></span>
                    <span @click="helpDeskClose"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
            </header>


             <ul id="chat" class="customer-chat" ref="chat_box"> 
               
                <li v-for="(msg, msgIndex) in send_message" :key="msgIndex" :class="user.user.id == msg.user_id?'me':'you'"  v-if="!msg.isComplete">
                    <div class="entete">
                        
                    </div>
                    <!-- <div class="triangle"></div> -->

                    <img v-if="user.user.id != msg.user_id && msg.user_photo != null && isMessageShow != msg.id" :class="{'you':user.user.id != msg.user_id}" style="width:35px;height:35px; border-radius:50%" :src="url+'/'+msg.user_photo" alt="">
                    
                    <div v-if="isMessageShow != msg.id" class="message" @mouseenter="showCaret(msg)">
                        
                        <!-- Chat maessage and caret icon showing in chatbox -->
                        <span v-html="msg.message"></span><span v-if="isCaretShow == msg.id" class="text-right" :class="'delete-message'+msg.id" @click="showToolPan(msg)" ><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                        <!-- Image showing in chatbox-->
                        <div v-if="msg.chat_document != null"><img class="img-fluid" v-for="(chat_item, j) in JSON.parse(msg.chat_document)" :key="j" :src="chatImage+chat_item.chat_document" alt=""></div> 
                       
                    </div>
                    <!-- Message sender image showing -->
                     <img v-if="user.user.id == msg.user_id && msg.user_photo != null && isMessageShow != msg.id" :class="{'me':user.user.id == msg.user_id}" style="width:35px;height:35px; border-radius:50%" :src="url+'/'+msg.user_photo" alt="">

                    <!-- Message time showing -->
					<div><span v-if="isMessageShow != msg.id" style="font-size:0.7em">{{ chatTime(msg.chat_time)}}</span></div>

                    <!-- Delete message modal  -->
                     <modal :name="'actionBox'+msg.id"  :shiftX="0.9" :draggable="isDragable" :width="300" :height="125">

                     <div class="card panbox"  @mouseleave="hidePanBox" >
                            <div class="card-body">
                                <ul>
                                    <li><a href="javascript:void(0)" @click="deleteSingleMessage(msg, send_message, msgIndex)">Delete Message</a></li>
                                    <li><a href="javascript:void(0)" @click="deleteAllConversation(msg)">Delete All Conversation</a></li>
                                </ul>
                            </div>
                        </div>
                     </modal>
                </li>

                <!-- Preview image after file attached  -->
                <li style="border-top:2px solid #0073C5;background:#fff;" v-if="images.length > 0">
                  <span class="image_loop" style="position:relative;" v-for="(image, key) in images" :key="reloadKey" @click="removeImage(key)">
                        <span><i class="fa fa-times" aria-hidden="true"></i></span>
                        <img style="width:100px;height:100px; margin:2px;" class="preview" :ref="'image'" />
                        
                        <!-- {{ image.name }} -->
                       
                    </span>
                </li>
            </ul>
            <footer>
                <!-- Message sending form  -->
                <form class="chatForm" @submit.prevent="helpDeskSendMessage();scrollActionOnSubmit()" @keyup.enter="helpDeskSendMessage();scrollActionOnEnter()">
                <textarea class="form-control" id="chat_text" name="chat_text" placeholder="Type your message"></textarea>
                <span><i class="fa fa-image" ref="open_file_window" @click="openFileWindow"></i></span>
                <!-- <span><i class="fa fa-paperclip" aria-hidden="true" ref="open_file_window" @click="openFileWindow"></i></span> -->
                <input type="hidden" id='authenticate_id' :value="user.user.id">
                <input type="file" style="display:none" id="fiel_upload" name="chat_document[]" @change="onFileChange($event)" ref="file_attached" multiple>
                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> </button>
                </form>
            </footer>
        </main>
	</div>


  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import frmixin from '../../../src/mixin-frontend'
import moment from 'moment'
export default {
mixins:[frmixin],
props:['helpDeskClose', 'helpDeskSendMessage', 'send_message', 'receive_message', 'adminUser', 'images', 'helpdeskChatUser', 'selectedUser'],

data(){
    return {
        getMessage:[],
        userName:'',
        userPhoto:'',
		userId:'',
		isSelectedAssistant:false,
        isSearch:false,
		userMessage:[],
        isCaretShow:false,
        isActionBoxShow:false,
        isMessageShow:false,
        attach: false,
        selectedFile: '',
        reloadKey: 0,
        isDragable:true,
        messageKey:0,


    }
},

created(){

},

mounted(){


},


computed:{
	...mapGetters({
		user:'user'
	})
},

methods:{

    scrollActionOnSubmit(){

        let chatWindow = document.getElementById('chat'); 
        var xH = chatWindow.scrollHeight; 
        chatWindow.scrollTo(0, xH);

    },

    scrollActionOnEnter(){

       let chatWindow = document.getElementById('chat'); 
        var xH = chatWindow.scrollHeight; 
        chatWindow.scrollTo(0, xH);

    },

    onFileChange(e) {
      let vm = this;
      var selectedFiles = e.target.files;
      for (let i = 0; i < selectedFiles.length; i++) {
        console.log(selectedFiles[i]);
        this.images.push(selectedFiles[i]);
      }

      for (let i = 0; i < this.images.length; i++) {
        let reader = new FileReader();
       reader.onload = (e) => {
          this.$refs.image[i].src = reader.result;

          console.log(this.$refs.image[i].src);
        };

        reader.readAsDataURL(this.images[i]);
      }

            let height = $('#chat').innerHeight
            $('#chat').scrollTop = 0;
      
    },

    removeImage (index) { 

        // var arrayImages = this.images;

        // var index = arrayImages.indexOf(arrayImages[i]);

        // arrayImages.splice(index, i);
        
        const dt = new DataTransfer()
        const input = document.getElementById('fiel_upload')
        const { files } = input
        for (let i = 0; i < files.length; i++) {
            const file = files[i]
            if (index !== i) dt.items.add(file) // here you exclude the file. thus removing it.
            input.files = dt.files
        }

        this.images.splice(index, 1);

        if(!this.image.length){

            this.$refs.im.value = '';
        }

        this.reloadKey++ 
    },

    createImage(file) {
        var image = new Image();
        var reader = new FileReader();
        var vm = this;

        reader.onload = (e) => {
            vm.image = e.target.result;
            // this.chatFormData.chat_document = vm.image;

        };
        reader.readAsDataURL(file);

        console.log('image', image);
    },

    openFileWindow(){
    this.$refs.file_attached.click()
    },

    focusUser(i){
        console.log('focus user', i);
        $('li.aside_li').removeClass('focus_user')
        $('.user_list'+i).removeClass('focus_user').addClass('focus_user')
        
    },

    chatTime(date){
        return moment(date).calendar()
    },

    showCaret(data){
        this.isCaretShow = false
        this.isActionBoxShow = false
        this.isCaretShow = data.id 
        console.log('show caret', data);
    },


    //  hideCaret(){

    //      this.isCaretShow = null 
    //  },

    showToolPan(data){
        this.$modal.show('actionBox'+data.id)
        this.isActionBoxShow = data.id
    },

    hidePanBox(){
    // this.isActionBoxShow = false  
    },

    removeMessaeItem(arr, id) {
        var i = arr.length;
        if (i) {   // (not 0)
            while (--i) {
                var cur = arr[i];
                if (cur.id == id) {
                    arr.splice(i, 1);
                    console.log('after delete', arr.length);
                }
            }
        }               
        
    },

    deleteSingleMessage(data, message, index){
        console.log('data', data);
        this.removeMessaeItem(message, index)
        axios.post(this.url+'/api/delete-helpdesk-single-message', data)
        .then(res => {
            this.isMessageShow = data.id
            this.isCaretShow = false
            this.isActionBoxShow = false
            this.$modal.hide('actionBox'+data.id)
            console.log(res); 
            

            if(res.data.status == 'success'){

            axios.post(this.url+'/api/get-helpdesk-pair-message', data)
            .then(response => {
                console.log('pair message', response.data);
                
                this.send_message = response.data

                console.log('return message', response.data);
            })

            }
            
        })
    },

    deleteAllConversation(data){
        axios.post(this.url+'/api/delete-helpdesk-all-message', data)
        .then(res => {

            this.isMessageShow = data.id
            this.isCaretShow = false
            this.isActionBoxShow = false
           
            

        })
    },

}

}
</script>

<style scoped>
*{
	box-sizing:border-box;
}
body{
	background-color:#abd9e9;
	font-family:Arial;
}
#container{
    width: 50%;
    height: 498px;
    background: #eff3f7;
    margin: 0 auto;
    font-size: 0;
    border-radius: 5px;
    overflow: hidden;
    position: absolute;
    right: 3%;
    top: 11%;
    /* transform: translate(0, -50%); */
    z-index: 99999999999999999999999;
}

.vm--container{
    z-index: 9999999999;
}

.close_button{
	    right: 0;
    position: absolute;
    top: 0;
    padding: 10px;
    font-weight: 900;
    cursor: pointer;
}

.focus_user{
    background: #419FD9;
    color:#fff;
}

aside{
   width:30%;
	height:527px;
	background-color:#fff;
	display:inline-block;
	font-size:15px;
	vertical-align:top;
}


aside li.aside_li{
	padding: 5px 10px;
    text-align: center;
    cursor: pointer;
    /* border-bottom: 1px solid #EDEDED; */
    border: none;
    font-weight: 900;
    font-size: 19px;
    border-radius:0px;

}
aside li.aside_li:focus{
	background-color:#419FD9;
	cursor: pointer;
    color:#fff;
}

aside li.aside_li img{
	border-radius:50%;
	display: block;
    margin: 0 auto;
}
aside li.aside_li div{
	display:inline-block;
	vertical-align:top;
	margin-top:5px;
}
aside li.aside_li h2{
	font-size:14px;
	color: black;
	font-weight:normal;
	margin-bottom:5px;
}
aside li.aside_li h3{
	font-size:12px;
	color:#7e818a;
	font-weight:normal;
}

.customer-aside{
    width: 30% !important;
    left: 0!important;
}

main{
	 width:70%;
	height:800px;
	display:inline-block;
	font-size:15px;
	vertical-align:top;
    /* border: 5px solid #eff3f7; */
}

aside header{
	padding: 10.5px;
    background: #0073C5;
    /* background: #EDEDED; */
    height: auto;
    position:relative
}
aside input{
	    width: 100%;
    height: 30px;
    /* line-height: 50px; */
    padding: 20px;
    background-color: white;
    border: none;
    border-radius: 3px;
    color: green;
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_search.png);
    background-repeat: no-repeat;
    background-position: 170px;
    background-size: 40px;
    margin-top: 5px;
}
aside input::placeholder{
	color:#fff;
}


.header-tools{
    position: absolute;
    right: 10px;
    top: 20px;
}

.header-tools span{
    margin:5px;
}

.header-tools span i.f-search{

transform: rotateZ(
92deg
);
    position: absolute;
    right: 10px;
    top: -9px;
}

.tools{
	right: 4px;
    position: absolute;
    top: 0;
    padding: 10px;
    font-weight: 900;
    cursor: pointer;
    text-align: right;
    color: #d0e4f3;
    /* color: lightseagreen; */
}

.tools span{
    display:inline-block;
    padding:5px;
    cursor: pointer;
}
/* 
aside ul{
	padding-left:0;
	margin:0;
	list-style-type:none;
	overflow-y:scroll;
	height:690px;
}
aside li{
	padding: 10px 0 10px 0;
    text-align: center;
}
aside li:hover{
	background-color:#5e616a;
} */
h2,h3{
	margin:0;
}
/* aside li img{
	border-radius:50%;
    display: block;
    margin: 0 auto;
}
aside li div{
	display:inline-block;
	vertical-align:top;
	margin-top:12px;
}
aside li h2{
	font-size:14px;
	color:#fff;
	font-weight:normal;
	margin-bottom:5px;
}
aside li h3{
	font-size:12px;
	color:#7e818a;
	font-weight:normal;
} */

aside ul.aside_ul{
	padding-left: 0;
    margin: 0;
    list-style-type: none;
    scroll-behavior: auto;
    height: auto;
     /* scrollbar-width: thin; */
}

::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px #CCCCCC; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #CCCCCC; 
  border-radius: 3;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #CCCCCC; 
}



scrollbar {
  width: 5px;
}

/* Track */
::-moz-scrollbar-track {
  box-shadow: inset 0 0 5px #CCCCCC; 
  border-radius: 10px;
}
 
/* Handle */
::-moz-scrollbar-thumb {
  background: #CCCCCC; 
  border-radius: 3;
}

/* Handle on hover */
::-moz-scrollbar-thumb:hover {
  background: #CCCCCC; 
}

.status{
	width:8px;
	height:8px;
	border-radius:50%;
	display:inline-block;
	margin-right:7px;
}
.green{
	background-color:#58b666;
}
.orange{
	background-color:#ff725d;
}
.blue{
	background-color:#6fbced;
	margin-right:0;
	margin-left:7px;
}

main header{
    padding: 4px;
    /* background: #EDEDED; */
    background: #0073C5;
    width: 100%;
    display: inline-flex;
    position: relative;
}
main header > *{
	display:inline-block;
	vertical-align:top;
	color:#fff;
}
main header img:first-child{
	border-radius:50%;
}
main header img:last-child{
	width:24px;
	margin-top:8px;
}
.image{
    width: 11%;
}
.user-name{
    width: 89%
}
.user-name h2{
    /* transform: translate(-50%, -50%);
    position: absolute;
   
    left: 24%;
    top: 35%; */ 
    font-size: 19px;
}

.user-name h4{
    /* position: absolute;
    top: 49%;
    left: 16%;
    color:#5F5F5F; */
    font-size: 11px;
}


#chat{
    padding-left: 0;
    margin: 0;
    list-style-type: none;
    overflow-y: scroll;
    /* border: 5px solid #37a94e; */
    height: 337px;
    min-width: 300px;
    background: #E5DDD5;

}
#chat li{
	padding:10px 10px 10px 0px;
	margin-left: 20px;
}
#chat h2,#chat h3{
	display:inline-block;
	font-size:13px;
	font-weight:normal;
}
#chat h3{
	color:#bbb;
}
#chat .entete{
	margin-bottom:5px;
}
#chat .message{
	padding: 5px 11px;
    /* color: #fff; */
    line-height: 26px;
    max-width: 90%;
    display: inline-block;
    text-align: left;
    border-radius: 5px;
}

.panbox{
    width:300px;
}

.panbox .card-body ul{
    padding: 0;
    margin: 0;
}

.panbox .card-body ul li{
    list-style: none;
    padding: 0;
    margin:0;
}

.panbox .card-body ul li a{

    color:#3490dc !important;
}


#chat .me{
	text-align:right;
}
#chat .you .message{
	background-color:#FFFFFF;
}
#chat .me .message{
	background-color:#DCF8C6;
}
#chat .triangle{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 0 10px 10px 10px;
}
#chat .you .triangle{
		border-color: transparent transparent #58b666 transparent;
		margin-left:15px;
		display: none;
}
#chat .me .triangle{
		border-color: transparent transparent #6fbced transparent;
		margin-left:375px;
		display:none;
}

main footer{
	padding: 0px 10px;
    background: #F0F0F0;
}
main footer textarea{
   /*resize: none; */
    border: none;
    /* display: block; */
    /* width: 100%; */
    height: 48px;
    border-radius: 37px;
    padding: 13px;
    font-size: 15px;
    margin: 24px auto;
    /* scroll-behavior: auto; */
    overflow: hidden;
}

main footer span{
   
    color: #0073C5;
    position: absolute;
    /* left: 3%; */
    right: 12%;
    bottom: 6.5%;
    font-size: x-large;


}

main footer button{
   
    position: absolute;
    right: 4%;
    bottom: 6.5%;
    border: none;
    background: no-repeat;
    transform: rotate(
45deg
);
    font-size: x-large;
    color: #0073C5;
 
}

main footer button:focus{
    border: none !important;
    background: no-repeat;
}


main footer textarea:focus{
    border: none;
}
main footer textarea::placeholder{
	color:#ddd;
}
main footer img{
	height:30px;
	cursor:pointer;
}
main footer a{
	text-decoration:none;
	text-transform:uppercase;
	font-weight:bold;
	color:#6fbced;
	vertical-align:top;
	margin-left:333px;
	margin-top:5px;
	display:inline-block;
}

@media only screen and (max-width: 450px){
    #container{
        width: 100%;
    }
    aside{
        width: 35%;
    }
    main{
         width: 65%;
    }
}
@media only screen and (max-width: 768px){
    #container{
        top: 0!important;
        transform: translate(0, 0);
    }
}

</style>
