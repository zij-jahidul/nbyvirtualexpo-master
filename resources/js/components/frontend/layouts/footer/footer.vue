<template>
  <div>

        <!-- Footer Part Start -->
        <section id="footer_part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <button class="btn_success">Exhibitor</button>
                </div>
                <div class="col-md-10">

                        <carousel :autoplay="true" :nav="false" :dots="false" :loop="true" :autoplayTimeout = "3000" :autoplaySpeed="3000" :responsive="{0:{items:1,nav:false},600:{items:2},900:{items:4},1200:{items:5}}">
                            <!-- :autoplaySpeed="1000" -->

                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                            <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray">
                            </div>

                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                                <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray">
                            </div>

                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                            <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray">
                            </div>

                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                                <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray">
                            </div>

                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                            <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray">
                            </div>

                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                                <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray">
                            </div>
                        
                        </carousel>

                </div>

            </div>
        </div>
        </section>
         <!-- Footer Part Start -->


  </div>
</template>

<script>

import carousel from 'vue-owl-carousel'

export default {
    components: { carousel },
    data(){
    return {
        imageUrl:window.location.origin,
        image:''
    }
    },
    created(){
        this.imageUrl = this.imageUrl+'/frontend/assets/home-images/'
    }

}



</script>

<style scoped>

.owl-carousel .owl-item img {
    display: block;
    width: 75%!important;
}

.btn_success {
	font-size: 24px;
	font-weight: 500;
	background: #6ABD48;
	color: #fff;
	padding: 6% 25%;
	margin-left: -15px;
}


.btn_gray {
    background: #f8f8f8;
    border-radius: 5px;
    margin-top: 4%;
}
</style>