import vSelect from "vue-select";

require('../../bootstrap');
window.Vue = require('vue');

import master from '../../../components/frontend/layouts/Master'
import router from '../../routes/frontend/router'
import store from '../../store/store-frontend'
import moment from 'moment'

import VModal from 'vue-js-modal'
// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css'
Vue.use(VModal)
import Toasted from 'vue-toasted'
Vue.use(Toasted)

import VuejsDialog from 'vuejs-dialog'
import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js' // only needed in custom components
import 'vuejs-dialog/dist/vuejs-dialog.min.css'

Vue.use(VuejsDialog)
Vue.use(VuejsDialogMixin)
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)

import VueMobileDetection from 'vue-mobile-detection'
Vue.use(VueMobileDetection)

Vue.component('Navbar', require('../../../components/frontend/layouts/Navbar').default);
Vue.component('FooterContent', require('../../../components/frontend/layouts/FooterContent').default);

const app = new Vue({
    router,moment,store,
    created() {
        const userInfo = localStorage.getItem("user")
        if (userInfo) {
            const userData = JSON.parse(userInfo);
            this.$store.commit("setUserData", userData)
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
}).$mount('#app_frontend');
