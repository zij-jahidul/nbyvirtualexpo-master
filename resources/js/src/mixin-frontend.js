export default{
    data(){

        return{
            url:window.location.origin,
            imageUrl:'',
            productImageUrl:'',
            cartImageUrl:'',
            blogImageUrl:'',
            blogDetailsImg:'',
            isNavbar:true,
            isFooter:true,
            soundUrl:'',
            userImage:'',
            footerImgUrl:'',
            companyImgUrl:'',
            windowWidth:'',
            windowHeight:'',
            webinarUserImage:'',

        }
    },

    created(){

        this.soundUrl = this.url+'/public/sound/'
        this.imageUrl = this.url+'/public/frontend/assets/home-images/'
        this.productImageUrl = this.url+'/public/frontend/assets/product-images/'
        this.cartImageUrl = this.url+'/public/frontend/assets/uploads/products/'
         this.blogImageUrl = this.url+'/public/frontend/assets/blog/'
        this.blogDetailsImg = this.url+'/public/images/blog/'
         this.userImage = this.url+'/public/images/user/'
         this.footerImgUrl = this.url+'/public/frontend/assets/footer-slider/'
         this.companyImgUrl = this.url+'/public/frontend/assets/company/'
         this.webinarImage = this.url+'/public/frontend/assets/webinar/'
         this.webinarUserImage = this.url+'/public/images/webinarUser/'
         this.stallImage = this.url+'/public/frontend/assets/stall/'
         this.assetsImage = this.url+'/public/frontend/assets/'
         this.chatImage = this.url+'/public/images/chat/'
         this.windowWidth = window.innerWidth
         this.windowHeight = window.innerHeight - 150

    },
    methods:{
        getStall(){
            axios.get(this.apiurl+'/api/stall-page?category_id='+this.$route.params.category_id)
            .then(response => {
                this.stalls = response.data.data
                console.log(response.data.data)
            })
        }
    }
}
