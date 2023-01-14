import Vue from 'vue'
import Router from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueResource from 'vue-resource'
import routeFirebase from './routes-firebase'


// Optionally install the BootstrapVue icon components plugin
axios.defaults.baseURL = window.location.origin

Vue.use(Router, VueAxios, axios, VueResource)

let router = new Router({
    mode: 'history',
    base: '/vnc',
    fallback: true,
    routes: [...routeFirebase]
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
    const user = JSON.parse(localStorage.getItem('user'))

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/signin')
        return
    } 
    // console.log('user', user); 
    
    next()

    
    
    
})

export default router