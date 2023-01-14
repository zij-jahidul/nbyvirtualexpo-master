import Home from '../../../components/frontend/Home'
import Lobby from '../../../components/frontend/Lobby'
import SignUp from '../../../components/frontend/auth/SignUp'
import SignIn from '../../../components/frontend/auth/SignIn'
import Otp from '../../../components/frontend/auth/Otp'
import Webinar from '../../../components/frontend/webinar/Webinar'

import ConferenceRoom from '../../../components/frontend/webinar/ConferenceRoom'
import ExhibitionHall from '../../../components/frontend/ExhibitionHall'

// import SponsorMediaCenter from '../../../components/frontend/helpdesk/SponsorMediaCenter'

import StallPage from '../../../components/frontend/stall/StallPage.vue'
import StallDetails from '../../../components/frontend/stall/StallDetails.vue'
import SingleProduct from '../../../components/frontend/stall/products/SingleProduct.vue'
import Blog from '../../../components/frontend/blog/Blog.vue'
import BlogDetails from '../../../components/frontend/blog/BlogDetails.vue'

import StallLayout from '../../../components/frontend/stall/StallLayout'

import Cart from '../../../components/frontend/stall/cart/CartPage.vue'
import CartAdd from '../../../components/frontend/stall/cart/CartAdd.vue'

import CheckOutPage from '../../../components/frontend/stall/cart/CheckOut.vue'
import OrderConfirm from '../../../components/frontend/stall/cart/OrderConfirm.vue'
import OrderConfirmation from '../../../components/frontend/stall/cart/OrderConfirmation.vue'

import Banner from '../../../components/frontend/layouts/Banner.vue'

// Chatting Bar
import HelpDesk from '../../../components/frontend/helpdesk/HelpDesk.vue'
import HelpDeskTwo from '../../../components/frontend/helpdesk/HelpDeskTwo.vue'
import StallChatting from '../../../components/frontend/helpdesk/StallChatting.vue'
import Notification from '../../../components/frontend/helpdesk/Notification.vue'

import MakeCall from '../../../components/frontend/stall/customer-care/MakeCall.vue'
import ReceiveCall from '../../../components/frontend/stall/customer-care/ReceiveCall.vue'
import JoinCall from '../../../components/frontend/stall/customer-care/JoinCall.vue'

import CustomerProfile from '../../../components/frontend/customer/CustomerProfile.vue'
import CustomerOrder from '../../../components/frontend/customer/CustomerOrder.vue'
import CustomerOrderDetails from '../../../components/frontend/customer/CustomerOrderDetails.vue'
import CustomerInvoice from '../../../components/frontend/customer/invoice.vue'
import StallExample from "../../../components/frontend/stall/StallExample"

let routeFrontend = [

    {
        name:'Notification',
        path:'/notification',
        component:Notification,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },
        {

        name:'StallExample',
        path:'/example-stall',
        component:StallExample,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
        }

    },

    {
        name:'StallLayout',
        path:'/stall-layout',
        component:StallLayout,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },


    {
        name:'CustomerProfile',
        path:'/customer-profile',
        component:CustomerProfile,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'CustomerOrder',
        path:'/customer-order',
        component:CustomerOrder,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'CustomerOrderDetails',
        path:'/customer-order/:id',
        component:CustomerOrderDetails,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'CustomerInvoice',
        path:'/customer-invoice/:id',
        component:CustomerInvoice,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'Cart',
        path:'/cart-page',
        component:Cart,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'CartAdd',
        path:'/cart-add',
        component:CartAdd,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },




    {
        name:'HelpDesk',
        path:'/help-desk',
        component:HelpDesk,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'HelpDeskTwo',
        path:'/help-desk-two',
        component:HelpDeskTwo,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'StallChatting',
        path:'/stall-chatting',
        component:StallChatting,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },





    {
        name:'CheckOutPage',
        path:'/checkout-page',
        component:CheckOutPage,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'OrderConfirm',
        path:'/order-confirm',
        component: OrderConfirm,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },


    {
        name:'OrderConfirmation',
        path:'/order-confirmation',
        component: OrderConfirmation,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'SingleProduct',
        path:'/single-product/:company_id/:stall_id/:id',
        component:SingleProduct,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },


    {
        name:'Otp',
        path:'/otp',
        component:Otp,

        meta: {
            // auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'Home',
        path:'/',
        component:Home,

        meta: {
            // auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },
    {
        name:'Banner',
        path:'/home',
        component:Banner,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },
    {
        name:'SignUp',
        path:'/signup',
        component:SignUp,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },
    {
        name:'SignIn',
        path:'/signin',
        component:SignIn,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    // Lobby
    {
        name:'Lobby',
        path:'/lobby',
        component:Lobby,

        meta: {
            // auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    // ExhibitionHall
    {
        name:'ExhibitionHall',
        path:'/exhibition-hall',
        component:ExhibitionHall,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'Webinar',
        path:'/webinar',
        component:Webinar,
        meta: {
            auth: true
          }
    },

    {

        name:'ConferenceRoom',
        path:'/event-room',
        component:ConferenceRoom,



        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name: Blog,
        path:'/blog-page',
        component: Blog,

        // meta: {
        //     auth: true,
        //     breadcrumb: {
        //         label: 'Home',

        //       }
        //   }
    },

    {
        name:'BlogDetails',
        path:'/blog-details ',
        component:BlogDetails,

        // meta: {
        //     auth: true,
        //     breadcrumb: {
        //         label: 'Home',

        //       }
        //   }

    },
    {
        name:'BlogDetails',
        path:'/blog-details/:slug',
        component:BlogDetails,

        // meta: {
        //     auth: true,
        //     breadcrumb: {
        //         label: 'Home',

        //       }
        //   }

    },


    // Stall-Page

    {

        name:'Stall',
        path:'/stall-page/:category_id/:category_name',
        component:StallPage,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'Home',

            //   }
          }

    },

    {
        name:'StallDetails',
        path:'/stall-details/:company_id/:stall_id/:stall_name/:target?',
        component:StallDetails,

        meta: {
            auth: true,
          }

    },

    {
        name:'MakeCall',
        path:'/make-call',
        component:MakeCall
    },

    {
        name:'ReceiveCall',
        path:'/receive-call',
        component:ReceiveCall
    },
    {
        name:'JoinCall',
        path:'/join-call',
        component:JoinCall
    },


]

export default routeFrontend
