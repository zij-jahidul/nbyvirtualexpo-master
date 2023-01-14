require('../../bootstrap');
window.Vue = require('vue');

import master from '../../../components/webrtc/layouts/MasterWebrtc.vue'
import router from '../../routes/webrtc/routes'
import store from '../../store/store-webrtc'
import moment from 'moment'


import { ZoomMtg } from '@zoomus/websdk';

ZoomMtg.preLoadWasm();
ZoomMtg.prepareJssdk();


const app = new Vue({
    router,moment,store,
    created() {
        const userInfo = localStorage.getItem("user");
        if (userInfo) {
            const userData = JSON.parse(userInfo);
            this.$store.commit("setUserData", userData);
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('singOut')
                }
                return Promise.reject(error)
            }
        )
    },
    render: h => h(master)
}).$mount('#app_webrtc');