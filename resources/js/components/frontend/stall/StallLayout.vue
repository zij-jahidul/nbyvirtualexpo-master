<template>

  <div>
    <!-- Lobby Part Start -->
    <section id="stalllayout_part">


      <div class="stall_layout">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
              <div class="stalllayout_img_div">

                 <img :src="this.url+'stall.PNG'" alt="Stall-Layout" class="img-fluid stall_layout_img">


                 <img :src="this.url+'walton_logo.png'" alt="Stall-Layout" class="img-fluid stall_logo">
                 <img :src="this.url+'wlogo.png'" alt="Stall-Layout" class="img-fluid stall_company_name">
                 <iframe class="iframedesign" src="https://www.youtube.com/embed/h7wWNIlYC7c?autoplay=1&controls=0&mute=1" frameborder="0" allow="autoplay; accelerometer;  clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                 <img :src="this.url+'banner_one.png'" alt="Stall-Layout" class="img-fluid stall_banner_left">
                 <img :src="this.url+'banner_two.png'" alt="Stall-Layout" class="img-fluid stall_banner_right">

                 <img :src="this.url+'banner_two.png'" alt="Stall-Layout" class="img-fluid stall_banner_left_two">
                 <img :src="this.url+'banner_one.png'" alt="Stall-Layout" class="img-fluid stall_banner_right_two">


              </div>

            </div>
          </div>
      </div>
    </section>


  </div>
</template>

<script>
import frmixin from '../../../src/mixin-frontend'
export default {
mixins:[frmixin]

}
</script>

<style scoped>
#stalllayout_part {
  margin: 0;
  padding: 0;
}
.stalllayout_img_div {
	position: relative;
	width: fit-content;
	margin: 0 auto;
}

/* .stall_layout_img {
  position: relative;
} */

.stall_logo {
	position: absolute;
	left: 50.4%;
	top: 2%;
	transform: translateX(-50%);
}

.stall_company_name {
	position: absolute;
	left: 50%;
	top: 19%;
	transform: translateX(-50%);
}

.iframedesign {
	position: absolute;
	left: 38%;
	right: 0;
	height: 21%;
	top: 38.5%;
	width: 24%;
}

.stall_banner_left {
	position: absolute;
	left: 6%;
	top: 62%;
	width: 9%;
	height: 28%;
}


.stall_banner_right {
	position: absolute;
	right: 6%;
	top: 62%;
	width: 8%;
	height: 28%;
}

.stall_banner_left_two {
	position: absolute;
	left: 16%;
	top: 71%;
	width: 8%;
	height: 17%;
}

.stall_banner_right_two {
	position: absolute;
	right: 16%;
	top: 72%;
	width: 8%;
	height: 16%;
}

</style>
