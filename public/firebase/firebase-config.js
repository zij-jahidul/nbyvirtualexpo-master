var firebaseConfig = {
  apiKey: "AIzaSyAEsBEDDqVpqlfXrvU9ih7xsko8WJ92Z3A",
  authDomain: "ditf-58c17.firebaseapp.com",
  databaseURL: "https://ditf-58c17-default-rtdb.firebaseio.com",
  projectId: "ditf-58c17",
  storageBucket: "ditf-58c17.appspot.com",
  messagingSenderId: "883863568921",
  appId: "1:883863568921:web:c34e5f0bdb7dc4e0572088",
  measurementId: "G-8GC3KYG1Q3"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();

const messaging = firebase.messaging();

messaging.usePublicVapidKey("BPU-KuxypYnUjJQPLKyYhroFvIn4pxYFrp9ZhDofENaV-DA-uA2nOJG94mRSeqJvMpMhyl3IFb1GUA1EILp90Uc");


messaging.onMessage((payload) => {

  openIncomingWindow(payload);

  
  if(payload.data.call_state == 2){
    let close_outgoing_url = window.location.origin+'/receive-call';
    window.close(close_outgoing_url);
  }

});


function openIncomingWindow(payload){
  // console.log('data from open incoming window', payload);
  // let receive_call_url = window.location.origin+'/receive-call';
  // if(payload.data.call_state == 1 && payload.data.call_status != 'received'){
  //   let incoming_call = window.open(
  //     receive_call_url,
  //     "DescriptiveWindowName",
  //     "resizable,scrollbars,status",
  //   );
  //   incoming_call.window.customer_id        = payload.data.customer_id
  //   incoming_call.window.company_id         = payload.data.company_id
  //   incoming_call.window.customer_name      = payload.data.customer_name
  //   incoming_call.window.customer_photo     = payload.data.customer_photo
  //   incoming_call.window.company_user_name  = payload.data.company_user_name
  //   incoming_call.window.roomId             = payload.data.roomId
  //   incoming_call.window.company_user_token = payload.data.company_user_token
    

  // }
}


// [END receive_message]

var fb_token = '';

messaging.getToken().then((currentToken) => {
  if (currentToken) {
    sendTokenToServer(currentToken);
    fb_token = currentToken; 

    console.log(currentToken);
    localStorage.setItem('web_token', currentToken)
    
  } else {
    // Show permission request.
    console.log('No Instance ID token available. Request permission to generate one.');
    // Show permission UI.
    setTokenSentToServer(false);
  }
}).catch((err) => {
  console.log('An error occurred while retrieving token. ', err);
  setTokenSentToServer(false);
});


function sendTokenToServer(currentToken) {
  if (!isTokenSentToServer()) {
    console.log('Sending token to server...');
    // TODO(developer): Send the current token to your server.
    setTokenSentToServer(true);
  } else {
    console.log('Token already sent to server so won\'t send it again ' +
        'unless it changes');
  }

}

function isTokenSentToServer() {
  return window.localStorage.getItem('sentToServer') === '1';
}

function setTokenSentToServer(sent) {
  window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}



function requestPermission() {
  console.log('Requesting permission...');
  // [START request_permission]
  Notification.requestPermission().then((permission) => {

    if (permission === 'granted') {

      console.log('Notification permission granted.');
      

      location.reload();


    } else {

      console.log('Unable to get permission to notify.');

    }
  });
  // [END request_permission]
}



// messaging.setBackgroundMessageHandler(function(payload) {
//   console.log(
//       "firebase config",
//       payload,
//   );


//   /* Customize notification here */
//   const notificationTitle = "Background Message Title";
//   const notificationOptions = {
//       body: "Background Message body.",
//       icon: "/itwonders-web-logo.png",
//       sound:"public/sound/cute-sms-ringtone.mp3"
//   };

//   return self.registration.showNotification(
//       notificationTitle,
//       notificationOptions,
//   );
// });



// function makeConversation(call_type, patient_id, userType){

// var url = window.location.origin+'/make-call';


// var info = {
//     'callState':'1',
//     'callType':call_type,
//     'patient_id':patient_id,
//     'userType':userType
// };

// $.ajax({
//   url:url,
//   type:'GET',
//   data:info,
//   success:function(response){
//       console.log(response);
//       let room_url = window.location.origin+'/outgoing-call';
//       if(response){

//         var conversation_room = window.open(
//           room_url,
//           "DescriptiveWindowName",
//           "resizable,scrollbars,status",
//       );

      
//       conversation_room.sender_web_token        = response.sender_web_token;
//       conversation_room.sender_firebase_token   = response.sender_firebase_token;
//       conversation_room.receiver_web_token      = response.receiver_web_token;
//       conversation_room.receiver_firebase_token = response.receiver_firebase_token;
      
//       conversation_room.window.roomId           = response.roomId;
//       conversation_room.window.sender_image     = response.sender_image;
//       conversation_room.window.sender_name      = response.sender_name;
//       conversation_room.window.callType         = response.callType;
//       conversation_room.window.receiver_name    = response.receiver_name;
//       conversation_room.window.receiver_image   = response.receiver_image;

      
//       }
//   }
// });
// }

