require('../../bootstrap');
window.Vue = require('vue');
// import firebase from 'firebase'
// import '@firebase/analytics'
// import '@firebase/messaging'

import master from '../../../components/firebase/layouts/MasterFirebase.vue'
import router from '../../routes/firebase/routes'
import store from '../../store/store-firebase'

// var firebaseConfig = {
//     apiKey: "AIzaSyAEsBEDDqVpqlfXrvU9ih7xsko8WJ92Z3A",
//     authDomain: "ditf-58c17.firebaseapp.com",
//     databaseURL: "https://ditf-58c17-default-rtdb.firebaseio.com",
//     projectId: "ditf-58c17",
//     storageBucket: "ditf-58c17.appspot.com",
//     messagingSenderId: "883863568921",
//     appId: "1:883863568921:web:c34e5f0bdb7dc4e0572088",
//     measurementId: "G-8GC3KYG1Q3"
//   };

//   firebase.initializeApp(firebaseConfig);
// firebase.analytics();

// const messaging = firebase.messaging();

// messaging.usePublicVapidKey("BPU-KuxypYnUjJQPLKyYhroFvIn4pxYFrp9ZhDofENaV-DA-uA2nOJG94mRSeqJvMpMhyl3IFb1GUA1EILp90Uc");


// messaging.onMessage((payload) => {

//   console.log('append message method', payload);

//   openIncomingWindow(payload);

//   let close_outgoing_url = window.location.origin+'/outgoing-call';

//   if(payload.data.callState == '2'){
//     window.close(close_outgoing_url);
//   }

// });

// const app = new Vue({
//     router,store,
//     created() {
//         const userInfo = localStorage.getItem("user");
//         if (userInfo) {
//             const userData = JSON.parse(userInfo);
//             this.$store.commit("setUserData", userData);
//         }
//         axios.interceptors.response.use(
//             response => response,
//             error => {
//                 if (error.response.status === 401) {
//                     this.$store.dispatch('singOut')
//                 }
//                 return Promise.reject(error)
//             }
//         )
//     },
//     render: h => h(master)
// }).$mount('#app_firebase');