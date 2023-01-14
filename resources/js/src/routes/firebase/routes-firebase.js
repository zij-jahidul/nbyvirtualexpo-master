import Home from '../../../components/firebase/Home.vue'

let routeFirebase = [

    {
        name:'Home',
        path:'/',
        component:Home,

        meta: {
            auth: true,
          }

    },


]

export default routeFirebase
