import Meeting from '../../../components/webrtc/Meeting.vue'
import Home from '../../../components/webrtc/Home'
let routesWebRtc = [
 
    {
        name:'Home',
        path:'/',
        component:Home,

        meta: {
            auth: true,
          }

    },
    {
        name:'Meeting',
        path:'/meeting',
        component:Meeting,

        meta: {
            auth: true,
          }

    },
    {
        name:'Meeting',
        path:'/meeting/:meetingId/:nickname',
        component:Meeting,

        meta: {
            auth: true,
          }

    },


]

export default routesWebRtc
