<template>
   <div>
    <!-- Lobby Part Start -->
    <section id="exhibition_part">
        <div class="row">
            <div class="col-lg-12">

                <LazyVideo style="width:100%; position:relative;" :src="imageUrl+'exibitionhall.mp4'" :poster="imageUrl+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>

                        <div class="header_ads_one" v-for="(adds, index) in exhibitionAds" :key="index">
                            <div class="header_ads_body">
                               <ul class="ads_ul">

                                    <li class="ads_left_li">
                                        <img :src="imageUrl+'02.png'" alt="" class="img-fluid banner_ads_image_left">
                                        <iframe class="iframe_left" :src="adds.ads_position == 9?adds.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                    </li>

                                     <li class="ads_center_li">
                                        <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_middle">
                                        <iframe class="iframe_middle" :src="adds.ads_position == 7?adds.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                    </li>

                                    <li class="ads_right_li">
                                        <img :src="imageUrl+'02.png'" alt="" class="img-fluid banner_ads_image_right">
                                        <iframe class="iframe_right" :src="adds.ads_position == 8?adds.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                        <!-- Walton ads -->
                                     </li>

                                 </ul>
                            </div>
                        </div>

                <div class="floating-menu-container d-block d-sm-block d-md-none d-xl-none">
                    <i class="fas fa-bars" @click="floatingMenu"></i>
                    <div v-if="!isActive" class="floating_menu"  id="floating_menu">
                        <div class="floating-menu-item" v-for="(category, catIndex) in eventCategories" :key="catIndex">
                            <router-link :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">{{ category.event_sub_category_name }}</router-link>
                        </div>
                    </div>
                </div>

                <div class="lobby_setup d-none d-sm-none d-md-block d-xl-block">
                    <div class="lobby">
                        <ul v-for="(category, catIndex) in eventCategories" :key="catIndex">
                             <li v-if="catIndex == 0">
                                <router-link class="lobby_one" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                   {{ category.event_sub_category_name }}
                                </router-link>
                             </li>

                             <li v-if="catIndex == 1">
                                 <router-link class="lobby_two" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                    {{ category.event_sub_category_name }}
                                 </router-link>
                             </li>
                             <li v-if="catIndex == 2">
                                 <router-link class="lobby_three" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                    {{ category.event_sub_category_name }}
                                 </router-link>
                             </li>
                             <li v-if="catIndex == 3">
                                 <router-link class="lobby_four" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                     {{ category.event_sub_category_name }}
                                 </router-link>
                             </li>
                             <li v-if="catIndex == 4">
                                 <router-link class="lobby_five" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                     {{ category.event_sub_category_name }}
                                 </router-link>
                             </li>
                        </ul>
                    </div>
                </div>

                <div class="footer_ads_left_li" v-for="adLeft in exhibitionAds">
                    <img :src="imageUrl+'bottomleft.png'" alt="ads_banner" class="img-fluid footer_ads_one">
                    <iframe class="iframe_footer_ads" :src="adLeft.ads_position == 10?adLeft.video_link+'?autoplay=1&controls=0&mute=1':''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                </div>

                <div class="footer_ads_right_li" v-for="adRight in exhibitionAds">
                    <img :src="imageUrl+'bottomright.png'" alt="ads_banner" class="img-fluid footer_ads_two">
                    <iframe class="iframe_footer_right" :src="adRight.ads_position == 11?adRight.video_link+'?autoplay=1&controls=0&mute=1':''"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                </div>

                <!-- <div class="bto">
                        <router-link to="#" @click.native="helpDeskOpen()">
                        <i class="far fa-comments"></i>
                        </router-link>
                </div> -->
            </div>
        </div>
    </section>
   <!-- Lobby Part Start -->          
   </div>
</template>

<script>
import frmixin from '../../src/mixin-frontend'
import VideoLazy from 'vue-lazyload-video'
export default {
 mixins:[frmixin],
    data(){
        return {
            exhibitionAds: {},
            eventCategories:[],
            isActive:false,
        }
    },
    created() {




        axios.get(this.url+'/api/frontend-event-sub-category')
        .then(res => {
            this.eventCategories = res.data.data
            // console.log('event sub cat', res);
        })

        setTimeout(()=>{

             axios(this.url+'/api/exhibition-ads').then(response=>{
                this.exhibitionAds = response.data.data;
                // console.log('ads', this.exhibitionAds)
            })

        }, 1000)



    },
     components: {
         VideoLazy
     },

    methods:{
        floatingMenu(){
            this.isActive = this.isActive != true;
        }
    },

}
</script>

<style scoped>
    .bto {
        position: fixed !important;
        bottom: 15%;
        right: 3%;
        z-index: 9999;
        cursor: pointer;
    }

    .bto i {
        width: 60px;
        height: 57px;
        border-radius: 50%;
        background-color: #0073C5;
        color: #fff;
        z-index: 9999;
        line-height: 60px;
        text-align: center;
        font-size: 32px;
    }
 /* Down to top button End */
    .bto[data-v-21a23404] {
        position: fixed !important;
        bottom: 15%;
        right: 3%;
        z-index: 9999;
        cursor: pointer;
    }

    .bto i[data-v-21a23404] {
        width: 60px;
        height: 57px;
        border-radius: 50%;
        background-color: #e23e38;
        color: #fff;
        z-index: 9999;
        line-height: 60px;
        text-align: center;
        font-size: 32px;
    }
    
@media only screen and (max-width: 767px){
    .lobby span {
        font-size: 2vw;
    }
}

element.style {
}
.floating-menu-container {
    position: absolute;
    top: 22%;
    color: red;
    background-color: rgba(255,255,255,.8) !important;
    z-index: 999999;
    left: 50%;
    padding: 5px 10px;
    text-align: right;
    transform: translate(-50%, 0);
}
.floating-menu-item a {
    color: #424242;
}
.floating-menu-container:hover{
    cursor: pointer;
}
.floating-menu-item {
    border-bottom: 1px solid #9e8585;
    font-size: 12px;
    padding-top: 2px;
}
.floating-menu-item:last-child {
    border: none;
}
.floating_menu{
    transition: .5s all linear;
}
.floating-menu a {
    color: silver;
}

</style>
