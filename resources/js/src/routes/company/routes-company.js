import Home from '../../../components/company/Home.vue'
import SignIn from '../../../components/company/auth/SignIn.vue'


let routeCompany = [

    {
        name:'Home',
        path:'/',
        component:Home,

        meta: {
            auth: true
          }

    },
    {
        name:'SignIn',
        path:'/signin',
        component:SignIn,

        meta: {
            auth: true
          }

    },

  
    

]

export default routeCompany
