<template>
   <div>
    <!-- Banner Part Start -->
    <section id="banner_part">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">

                    <LazyVideo id="autoplay_on" style="width:100%; z-index:-1; position:relative; margin-top:-6%;" :src="imageUrl+'homepage.mp4'" :poster="imageUrl+'banner.png'" :attrs="{controls: false, playsinline: true, loop: false, autoplay: true, muted: true}"/>

                    <div class="header_ads_one">
                        <div class="header_ads_body">
                            <ul class="ads_ul">
                                <li class="ads_center_li">
                                    <!-- v-for="(adds, index) in lobbyAds" :key="index" -->
                                    <!-- :src="adds.ads_position == 5?adds.video_link:''" -->
                                    <img v-if="showElement" :src="imageUrl+'homebanner.png'" alt="ads_banner" class="banner_ads_image">
                                    <iframe v-if="showElement"  class="iframe" :src="headerAds.video_link+'?autoplay=1&controls=0&mute=0'" frameborder="0" allow="autoplay; accelerometer; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <router-link v-if="showElement" to="lobby" class="btn text-center btn_success"> Click to Enter the Lobby</router-link>

                </div>
            </div>
        </section>
   <!-- Banner Part Start -->
   </div>
</template>

<script>
import VideoLazy from 'vue-lazyload-video'
import carousel from 'vue-owl-carousel'
import frmixin from '../../../src/mixin-frontend'
export default {
 mixins:[frmixin],

    data(){
        return {
           
            stallads: {},
            showElement:false,
            headerAds: '',
        }

    },

     components: {
         VideoLazy,
         carousel
     },

    created(){
    
        setTimeout(()=>{
            axios(this.url+'/api/header-ads').then(response=>{
                this.headerAds = response.data;
                console.log('header-ads', this.headerAds)
            })
        }, 1000)

    },


    mounted(){
        setTimeout(()=>{
            this.showElement = true
        }, 10000)

        // setTimeout(() => {
        //     // document.getElementById('autoplay_on').play();
        // }, 1000)
        // document.getElementById('autoplay_on').play();
    },

}

</script>

<style scoped>

#banner_part .btn_success{
    left: !important;
    transform: translateX(-55%)!important;
    top: 63.5%!important;
    background-color: #0073C5 !important;
}
</style>>
