import Home from '../../../components/backend/Home'
import SignIn from '../../../components/backend/auth/SignIn'
import User from '../../../components/backend/auth/users/Index'
import CreateUser from '../../../components/backend/auth/users/Create'
import Role from '../../../components/backend/auth/roles/Index'

import CreateRole from '../../../components/backend/auth/roles/Create'
import Permission from '../../../components/backend/auth/Permission'
import AssignRoleModel from '../../../components/backend/auth/AssignRoleModel'
import AssignPermissionModel from '../../../components/backend/auth/AssignPermissionModel'


// Event Category
import EventCategory from '../../../components/backend/pages/EventCategory/Index.vue'
import CreateEventCategory from '../../../components/backend/pages/EventCategory/Create.vue'

// Event Sub Category
import EventSubCategory from '../../../components/backend/pages/EventSubCategory/Index.vue'
import CreateEventSubCategory from '../../../components/backend/pages/EventSubCategory/Create.vue'

// StallAds
import StallAds from '../../../components/backend/pages/StallAds/Index.vue'
import CreateStallAds from '../../../components/backend/pages/StallAds/Create.vue'

// Company
import Company from '../../../components/backend/pages/Company/Index.vue'
import CreateCompany from '../../../components/backend/pages/Company/Create.vue'

// Company User
import CompanyUser from '../../../components/backend/pages/CompanyUser/Index.vue'
import CreateCompanyUser from '../../../components/backend/pages/CompanyUser/Create.vue'

// Product Categories
import ProductCategory from '../../../components/backend/pages/ProductCategory/Index.vue'
import CreateProductCategory from '../../../components/backend/pages/ProductCategory/Create.vue'

// Product Sub Categories
import ProductSubCategory from '../../../components/backend/pages/ProductSubCategory/Index.vue'
import CreateProductSubCategory from '../../../components/backend/pages/ProductSubCategory/Create.vue'


// Stall Layout
import StallLayout from '../../../components/backend/pages/StallLayout/Index.vue'
import CreateStallLayout from '../../../components/backend/pages/StallLayout/Create.vue'

// Stall
import Stall from '../../../components/backend/pages/Stall/Index.vue'
import CreateStall from '../../../components/backend/pages/Stall/Create.vue'
import DeliveryDistrict from '../../../components/backend/pages/Stall/DeliveryDistrict'
import ShippingCost from '../../../components/backend/pages/Stall/ShippingCost'

// Stall Product
import Product from '../../../components/backend/pages/Product/Index.vue'
import CreateProduct from '../../../components/backend/pages/Product/Create.vue'

// Product Img
import ProductImg from '../../../components/backend/pages/ProductImg/Index.vue'
import CreateProductImg from '../../../components/backend/pages/ProductImg/Create.vue'

// Stall Order
import Order from '../../../components/backend/pages/Order/Index.vue'
import CreateOrder from '../../../components/backend/pages/Order/Create.vue'
import OrderDetails from '../../../components/backend/pages/Order/Show.vue'

// Stall Order Details
import OrderDetail from '../../../components/backend/pages/OrderDetail/Index.vue'
import CreateOrderDetail from '../../../components/backend/pages/OrderDetail/Create.vue'

// Blog
import Blog  from '../../../components/backend/pages/Blog/Index.vue'
import CreateBlog  from '../../../components/backend/pages/Blog/Create.vue'

// VendorSiteVisitor
import VendorSiteVisitor  from '../../../components/backend/pages/VendorSiteVisitor/Index.vue'

// VisitorPoint
import VisitorPoint  from '../../../components/backend/pages/VisitorPoint/Index.vue'

// VisitorPointDistribution
import VisitorPointDistribution  from '../../../components/backend/pages/VisitorPointDistribution/Index.vue'

// StallVisitor
import StallVisitor  from '../../../components/backend/pages/StallVisitor/Index.vue'
import StallResource  from '../../../components/backend/pages/StallResource/Index'
import StallResourceCreate  from '../../../components/backend/pages/StallResource/Create'

// Webinar
import WebinarIndex  from '../../../components/backend/pages/Webinar/Index.vue'
import WebinarCreate  from '../../../components/backend/pages/Webinar/Create.vue'

// Webinar
import WebinarUserIndex  from '../../../components/backend/pages/WebinarUser/Index.vue'
import WebinarUserCreate  from '../../../components/backend/pages/WebinarUser/Create.vue'

// Ads
import AdsIndex from '../../../components/backend/pages/Ads/Index.vue'
import AdsCreate from '../../../components/backend/pages/Ads/Create.vue'

import StallUser from '../../../components/backend/auth/stall-user/Index.vue'
import StallUserCreate from '../../../components/backend/auth/stall-user/Create.vue'



let routeBackend = [
    {
        name:'Home',
        path:'/',
        component:Home,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'Home',

              }
          }

    },

    {
        name:'SignIn',
        path:'/signin',
        component:SignIn,
    },
    {
        name:'User',
        path:'/user',
        component:User,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'User',

              }
          }

    },

    {
        name:'CreateUser',
        path:'/user/create',
        component:CreateUser,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'CreateUser',

              }
          }

    },
    {
        name:'CreateUser',
        path:'/user/:id',
        component:CreateUser,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'CreateUser',

              }
          }

    },
    {
        name:'StallUser',
        path:'/stall-user',
        component:StallUser,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'StallUser',

              }
          }

    },

    {
        name:'StallUserCreate',
        path:'/stall-user/create',
        component:StallUserCreate,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'StallUserCreate',

              }
          }

    },
    {
        name:'StallUserCreate',
        path:'/stall-user/:id',
        component:StallUserCreate,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'StallUserCreate',

              }
          }

    },
    {
        name:'DeliveryDistrict',
        path:'/delivery-district',
        component:DeliveryDistrict,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'DeliveryDistrict',

              }
          }

    },
    {
        name:'ShippingCost',
        path:'/shipping-cost',
        component:ShippingCost,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'ShippingCost',

              }
          }
    },

    {
        name:'Role',
        path:'/role',
        component:Role,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'Role',

              }
          }

    },
    {
        name:'CreateRole',
        path:'/role/create',
        component:CreateRole,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'CreateRole',

              }
          }

    },
    {
        name:'CreateRole',
        path:'/role/:Id',
        component:CreateRole,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'CreateRole',

              }
          }

    },



    {
        name:'Permission',
        path:'/permission',
        component:Permission,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'Permission',

              }
          }

    },
    {
        name:'AssignRoleModel',
        path:'/assign-role-model',
        component:AssignRoleModel,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'AssignRoleModel',

              }
          }

    },
    {
        name:'AssignPermissionModel',
        path:'/assign-permission-model',
        component:AssignPermissionModel,

        meta: {
            auth: true,
            breadcrumb: {
                label: 'AssignPermissionModel',

              }
          }

    },

     // Vendor Site Visitor
     {
        name:'VisitorPoint',
        path:'/visitor-point',
        component: VisitorPoint,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },


     // Vendor Site Visitor
     {
        name:'VisitorPointDistribution',
        path:'/visitor-point-distribution',
        component: VisitorPointDistribution,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },

    // StallVisitor
    {
        name:'StallVisitor',
        path:'/stall-visitor',
        component: StallVisitor,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },


    // Event Category
    {
        name:'EventCategory',
        path:'/event-category',
        component:EventCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateEventCategory',
        path:'/event-category/create',
        component:CreateEventCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateEventCategory',
        path:'/event-category/:id',
        component:CreateEventCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

     // Event Sub Category
    {
        name:'EventSubCategory',
        path:'/event-subcategory',
        component:EventSubCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },

    {
        name:'CreateEventSubCategory',
        path:'/event-subcategory/create',
        component:CreateEventSubCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },

    {
        name:'CreateEventSubCategory',
        path:'/event-subcategory/:id',
        component:CreateEventSubCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },

    // Company
    {
        name:'Company',
        path:'/company',
        component:Company,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateCompany',
        path:'/company/create',
        component:CreateCompany,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }

    },

    {
        name:'CreateCompany',
        path:'/company/:id',
        component:CreateCompany,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

     // Company User
     {
        name:'CompanyUser',
        path:'/company-user',
        component:CompanyUser,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateCompanyUser',
        path:'/company-user/create',
        component:CreateCompanyUser,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }

    },

    {
        name:'CreateCompanyUser',
        path:'/company-user/:id',
        component:CreateCompanyUser,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

     // ProductCategory
     {
        name:'ProductCategory',
        path:'/product-category',
        component: ProductCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateProductCategory',
        path:'/product-category/create',
        component: CreateProductCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateProductCategory',
        path:'/product-category/:id',
        component: CreateProductCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

     // Product Sub Categories
    {
        name:'ProductSubCategory',
        path:'/product-subCategory',
        component: ProductSubCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateProductSubCategory',
        path:'/product-subCategory/create',
        component: CreateProductSubCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateProductSubCategory',
        path:'/product-subCategory/:id',
        component: CreateProductSubCategory,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    // Stall
    {
        name:'Stall',
        path:'/stall',
        component: Stall,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateStall',
        path:'/stall/create',
        component: CreateStall,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateStall',
        path:'/stall/:id',
        component: CreateStall,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },


    // // Stall Layout
    {
        name:'StallLayout',
        path:'/stall-layout',
        component: StallLayout,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateStallLayout',
        path:'/stall-layout/create',
        component: CreateStallLayout,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateStallLayout',
        path:'/stall-layout/:id',
        component: CreateStallLayout,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    // Stall Ads
     {
        name:'StallAds',
        path:'/stall-ads',
        component:StallAds,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateStallAds',
        path:'/stall-ads/create',
        component:CreateStallAds,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }

    },

    {
        name:'CreateStallAds',
        path:'/stall-ads/:id',
        component:CreateStallAds,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'StallResource',
        path:'/stall-resource',
        component:StallResource,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'StallResourceCreate',
        path:'/stall-resource/create',
        component:StallResourceCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'StallResourceCreate',
        path:'/stall-resource/:id',
        component:StallResourceCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },


    // Stall Products
    {
        name:'Product',
        path:'/product',
        component: Product,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateProduct',
        path:'/product/create',
        component: CreateProduct,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateProduct',
        path:'/product/:id',
        component: CreateProduct,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },


     // Product Img
     {
        name:'ProductImg',
        path:'/product-image',
        component:ProductImg,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateProductImg',
        path:'/product-image/create',
        component:CreateProductImg,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }

    },

    {
        name:'CreateProductImg',
        path:'/product-image/:id',
        component:CreateProductImg,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },


    // Stall Order
     {
        name:'Order',
        path:'/order',
        component:Order,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },


    // Stall Order
     {
        name:'OrderDetails',
        path:'/order/:id',
        component:OrderDetails,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },


    {
        name:'CreateOrder',
        path:'/order/create',
        component:CreateOrder,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateOrder',
        path:'/order/:id',
        component:CreateOrder,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

     // Stall Order Detail
     {
        name:'OrderDetail',
        path:'/order-detail',
        component:OrderDetail,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },
     {
        name:'CreateOrderDetail',
        path:'/order-detail/create',
        component:CreateOrderDetail,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

    {
        name:'CreateOrderDetail',
        path:'/order-detail/:id',
        component:CreateOrderDetail,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }

    },

      // Blog
      {
        name:'Blog',
        path:'/blog',
        component:Blog,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateBlog',
        path:'/blog/create',
        component:CreateBlog,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    {
        name:'CreateBlog',
        path:'/blog/:id',
        component:CreateBlog,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    // Vendor Site Visitor
    {
        name:'VendorSiteVisitor',
        path:'/vendor-site-visitor',
        component: VendorSiteVisitor,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },

    // Webinar
    {
        name:'WebinarIndex',
        path:'/webinar',
        component: WebinarIndex,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },
    {
        name:'WebinarCreate',
        path:'/webinar/create',
        component:WebinarCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },
    {
        name:'WebinarCreate',
        path:'/webinar/:id',
        component:WebinarCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

    // Webinar User
    {
        name:'WebinarUserIndex',
        path:'/webinar-user',
        component: WebinarUserIndex,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },
    {
        name:'WebinarUserCreate',
        path:'/webinar-user/create',
        component:WebinarUserCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },
    {
        name:'WebinarUserCreate',
        path:'/webinar-user/:id',
        component:WebinarUserCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },


    // ads
    {
        name:'AdsIndex',
        path:'/ads',
        component: AdsIndex,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            //   }
        }
    },
    {
        name:'AdsCreate',
        path:'/ads/create',
        component:AdsCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },
    {
        name:'AdsCreate',
        path:'/ads/:id',
        component:AdsCreate,

        meta: {
            auth: true,
            // breadcrumb: {
            //     label: 'AssignPermissionModel',
            // }
        }
    },

]

export default routeBackend
