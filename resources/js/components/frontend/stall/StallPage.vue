<template>
  <div>

     <!-- Lobby Part Start -->
    <section id="shoppage_part">
            <LazyVideo style="width:100%; position:relative;" :src="imageUrl+'exibitionhall.mp4'" :poster="imageUrl+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>

          <div class="row full_stall">
            <strong class="text-light"></strong>

            <div class="col-lg-3 col-md-3 col-sm-12 col-12">

              <div class="shoppage_left mt-5">
                <!-- 'left_a' -->
                <div class="row justify-content-center my-3">
                      <div class="col-lg-6 col-md-12 col-sm-12 col-12">
<!--                          <input type="text" class="form-control" placeholder="Search Stall" @click="getStalls()">-->
                      </div>
                </div>

                <ul class="shoppage_left_ul" v-for="(category, index) in eventSubCategories" :key="index">

                  <li class="category" v-if="category !==null"><router-link  :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()" @click.native="getStall(category.id, category.event_sub_category_name.replace(/ /g, '-').toLowerCase())" :id="category.event_sub_category_name.replace(/ /g, '-').toLowerCase()" :class="routeParams == category.event_sub_category_name.replace(/ /g, '-').toLowerCase()?'active left_a':'left_a'">{{ category.event_sub_category_name }}</router-link>
                    <ul class="subcategory" style="display:none" v-for="(stallItem, sbIndex) in category.stall" :key="sbIndex" v-if="stallItem.event_sub_category_id == category.id">
                      <li><router-link :to="'/stall-details/'+stallItem.company_id+'/'+stallItem.id+'/'+stallItem.stall_name.replace(/ /g, '-').toLowerCase()" class="router_link_hover">{{ stallItem.stall_name }}</router-link></li>
                    </ul>
                  </li>

                </ul>
              </div>
            </div>


            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
              <div class="shoppage_right pr-md-2 mb-5">
                      <div class="row h-100 mb-5">
                        <div class="col-md-4 col-sm-6 col-12 stall-name-link h-100 text-center" v-for="(stall,index) in stalls" :key="index">
                            <div class="card stall-card mt-5  h-100">
                                <div class="card-body">
                                    <router-link :to="'/stall-details/'+stall.company_id+'/'+stall.id+'/'+stall.stall_name.replace(/ /g, '-').toLowerCase()" class="router_link_hover">
                                        <h3 class="text-center"><strong>{{stall.stall_name}}</strong></h3>
                                        <img :src="companyImgUrl+stall.company_logo" alt="stall-image" class="img-fluid ads_three company_stall_logo">
                                    </router-link>
                                </div>
                            </div>


                        </div>
                          <div class="col-md-4 col-sm-6 col-12 stall-name-link h-100 text-center">
                              <div class="card stall-card mt-5  h-100">
                                  <div class="card-body">
                                      <router-link :to="'/example-stall'" class="router_link_hover">
                                          <h3 class="text-center"><strong>Example IT </strong></h3>
                                          <img :src="companyImgUrl+'samsung-28-01-2021-1611828772.png'" alt="stall-image" class="img-fluid ads_three company_stall_logo">
                                      </router-link>
                                  </div>
                              </div>
                          </div>
                      </div>

              </div>
            </div>

           </div>
    </section>
   <!-- Lobby Part Start -->

  </div>
</template>

<script>
import VideoLazy from 'vue-lazyload-video'
import frmixin from '../../../src/mixin-frontend'
export default {
  mixins:[frmixin],
  data(){
        return {
            url:window.location.origin,
            apiurl:window.location.origin,
            imageUrl:'',
            stalls: {},
            eventSubCategories:[],
            routeParams:this.$route.params.category_name,
            searchStalls: '',
        }
  },

  created(){
      $('body').css('background-color', '#c7c1cb')
    axios.get(this.apiurl+'/api/stall-page?category_id='+this.$route.params.category_id)
      .then(response => {
        this.stalls = response.data.data
        console.log('this.stalls',  this.stalls);
    })

    axios.get(this.apiurl+'/api/frontend-event-sub-category-wise-stall')
    .then(res => {
      console.log(res.data.data);
      this.eventSubCategories = res.data.data
    })

    setTimeout(()=>{
      axios(this.url+'/api/search-stalls').then(response=>{
          this.searchStalls = response.data.data;
          console.log('SearchStalls', this.searchStalls)
      })
    }, 1000)
  
  },
  methods: {

    getStall(i, id) {
        this.routeParams=this.$route.params.category_name

        $('#'+id).siblings('.subcategory').toggle()
        $('#'+id).parent('.category').parent('.shoppage_left_ul').siblings('.shoppage_left_ul').children('.category').children('.subcategory').hide()

        axios.get(this.apiurl+'/api/stall-page?category_id='+i)
        .then(response => {
          if(response){
            this.stalls = response.data.data
            console.log('this.stalls', this.stalls);
          }

      })
    }
  },
   components: {
        VideoLazy
    },

}
</script>

<style scoped>

.router_link_hover {
  color: #222;
  text-decoration: none;
}
.router_link_hover:hover {
  color: #222;
  text-decoration: none;
}


.direction_to {
left: 0;
right: 0;

/* font-size: 49em; */
z-index: 99999999999;
top: 0;
}
.menu_colored{
  color:red !important;

}
.direction_to >a{
  padding: 6px !important;
  margin: 5px;
}
.full_stall {
	position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  top: 8%;
}

.shoppage_left {
	background: rgba(255, 255, 255, 0.8);
	margin-top: 0px;
	position: absolute;
	right: 0;
	top: 0;
	left: 0;
    height: 100%;
}

.shoppage_left_ul {
  list-style: none;
    margin-bottom: 0;
}

/*.shoppage_left_ul li:first-of-type{*/
/*    padding-top: 10px;*/
/*}*/

.shoppage_left_ul .left_a {
    color:#222;
    text-decoration: none;
    font-size: 20px;
    transition: all linear .5s;
    padding-left: 10%;
}

.shoppage_left_ul .left_a:hover {
   color: #E32329;
}

.active {
    color: #E32329 !important;
}

.shop_maindiv {
    background: rgba(255,255,255,.6);
    border-radius: 15px;
    margin-top: 10%;
    padding: 15px;
}

  .shop_subdiv {
    padding: 30px;
}


#footer_part {
	margin-top: -6px !important;
}

#shoppage_part {
  padding-bottom: .9%;
}
.stall-name-link:hover{
    text-decoration: none;
}
.left-menu{
    z-index: 999;
    position: absolute;
    left: 0;
    top: 14%;
    background: rgba(255,255,255,0.7);;
    width: 100%;
    padding: 20px 0 20px 40px;
}
li.category {
    padding: 5px;
    background: rgba(0,0,0,.2);
    margin: 5px;
}
li.category:hover {
    background: rgba(255,0,0,.2);
}
ul.subcategory {
    border-top: 1px solid white;
    padding: 5px 0 5px 50px;
    list-style: none;
}

@media only screen and (max-width: 991px) and (min-width: 768px){
    #shoppage_part .shoppage_left .shoppage_left_ul {
        list-style: none;
        margin-top: 0 !important;
        padding-left: 0 !important;
    }
}
@media only screen and (max-width: 767px) and (min-width: 250px){
    #shoppage_part .shoppage_left .shoppage_left_ul {
        list-style: none;
        margin-top: 0;
        display: block !important;
        padding-left: 0 !important;
    }
    #shoppage_part .shoppage_left {
        background: rgba(255, 255, 255, 0.8);
        margin-top: 0;
        position: static;
        margin-left: 0;
        padding-left: 0;
    }
}
.stall-card{
    background: rgba(255,255,255,.8);
}

@media only screen and (max-width: 575px) {
    .stall-card{
        border: 1px solid gray;

    }
    .shoppage_right{
        margin-bottom: 100px !important;
    }
}
</style>
