import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'



Vue.use(Vuex)

axios.defaults.baseURL = window.location.origin + '/api'

export default new Vuex.Store({
    state: {
        user: null
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData
            // console.log(userData[0]['message']);
            if(userData.token){

            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}` 

            } else {
                localStorage.setItem('error', JSON.stringify(userData))
            }
           
        },

        clearUserData() {
            localStorage.removeItem('user')
            localStorage.removeItem('web_token')
            localStorage.removeItem('visitor')
            localStorage.removeItem('authority')
            location.reload()
        }
    },

    actions: {
        signIn({ commit }, credentials) {
            return axios
                .post('/client-signin', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                   
                    // let user = data.user 
                    console.log('data', data);
                    
                  if(data.user.role == 'Customer' || data.user.role == 'Admin' || data.user.role == 'Secretary' || data.user.role == 'QueryAssistant'){

                   window.location.href = window.location.origin+'/lobby'  
                      
                  } else {
                    window.location.href = window.location.origin+'/stall-details/'+data.stall_owner.company_id+'/'+data.stall_owner.stall_id+'/'+data.stall_name
                  }
                })
        },

        signOut({ commit }, data) {
            localStorage.clear();
            commit('clearUserData')
            return axios.post('/signout', data)
            .then(res=>{
                console.log(res.data);
                if(res.data.status == 200){
                    
                    window.location.href = window.location.origin+'/lobby'
                }
                
            })
        }
    },

    getters: {
        isLogged: state => !!state.user,
        user: state => state.user,
        
    }
})
