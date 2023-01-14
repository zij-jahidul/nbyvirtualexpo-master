importScripts("https://www.gstatic.com/firebasejs/7.21.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.21.1/firebase-messaging.js");

var config = {
  apiKey: "AIzaSyCj8JPFaU8AV8l90XMIgYWvSLSSRdfZwZ0",
  authDomain: "health-portal-8bba8.firebaseapp.com",
  databaseURL: "https://health-portal-8bba8.firebaseio.com",
  projectId: "health-portal-8bba8",
  storageBucket: "health-portal-8bba8.appspot.com",
  messagingSenderId: "1025676030546",
  appId: "1:1025676030546:web:828e6bad92555f5e6e258b",
  measurementId: "G-DG37FPC2R1"
};
  // Initialize Firebase
  firebase.initializeApp(config);

  const messaging = firebase.messaging();

  function requestPermission() {
    console.log('Requesting permission...');
    // [START request_permission]
    Notification.requestPermission().then((permission) => {
  
      if (permission === 'granted') {
  
        console.log('Notification permission granted.');
        
  
        // location.reload();
  
  
      } else {
  
        console.log('Unable to get permission to notify.');
  
      }
    });
    // [END request_permission]
  }

  // messaging.setBackgroundMessageHandler(function(payload){
  //   const title = "hello shereali";
  //   const options = {
  //       body:payload.data.status
  //   };
  //   return self.regisstration.showNotification(title, options);
  // });



  messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );


    /* Customize notification here */
    const notificationTitle = "Someone message you from nbyvirtualexpo";
    const notificationOptions = {
        body: "Please check your chatbox",
        icon: "/itwonders-web-logo.png",
        sound:"public/sound/cute-sms-ringtone.mp3"
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});

