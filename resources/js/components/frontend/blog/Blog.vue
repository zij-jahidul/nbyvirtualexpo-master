<template>

  <div>

    <section id="blog_part">

        <div class="row justify-content-center">
          <div class="col-md-11">
              <div class="row">

                    <div class="col-md-4 text-center col-sm-6 col-12" v-for="(item,index) in blogs" :key="index">
                        <!-- v-for="(item,index) in blogs.data" :key="index" -->
                        <div class="blog-wrap">
                            <div class="blog-image">
                                <img :src="item.feature_image" alt="Blog One" class="blog_image">
                                <!-- <img :src="item.feature_image" alt="Blog One" class="blog_image"> -->

                                <ul>
                                    <li>{{item.created_day}}</li>
                                    <li>{{item.created_month}}</li>
                                </ul>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <ul class="blog_ul">
                                        <li><a href="#"><i class="fa fa-user mr-1"></i> {{item.user.name}}</a></li>
                                        <li class="pull_right"><a href="#"><i class="fas fa-clock mr-1"></i> {{item.created_date}}</a></li>
                                    </ul>
                                </div>

                                <br>
                                <h3>{{item.title}}</h3>

                                <p> {{ item.description }}</p>

                                <router-link :to="'blog-details/'+item.slug">
                                    <button class="blog_button btn btn-info text-light">Read More</button>
                                </router-link>
                            </div>
                        </div>
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
mixins:[frmixin],

    data(){
        return {
         
            blogs:[],
        }

    },
    created() {
        axios(this.url+'/api/blog-page')
        .then(response=>{
                this.blogs = response.data.data
                console.log(response.data.data)
            })
        // this.getBlog()
        
    },


    //  methods:{
    //     getBlog()
    //     {

    //     },
    // },

}
</script>

<style scoped>

/*--------blog-area start--------*/
#blog_part {
    margin: 30px 0;
}

.blog_button {
	border: 1px solid gray;
	padding: 7px 40px;
	border-radius: 10px;
	margin: 20px 0;
	background-color: #0073C5 !important;
}

.blog-wrap {
    margin-bottom: 30px;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    overflow: hidden;
}
.blog-image {
    position: relative;
}

.blog-image ul {
    position: absolute;
    left: 10px;
    top: 10px;
    outline: 2px solid #fff;
    outline-offset: 3px;
    height: 60px;
    width: 50px;
    text-align: center;
    background: #fff;
    padding: 8px 0px;
}
.blog-image ul li {
    display: inline-block;
    position: relative;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 12px;
    display: block;
}
.blog-image ul li:first-child {
    color: #ff9000;
    font-size: 18px;
}

.blog-image iframe {
    height: 235px;
    width: 100%;
}
.blog-image img {
    width: 100%;
}
.blog-content {
    padding: 20px 15px;
}
.blog-content .blog-meta {
    margin: 0px 0 20px;
}
.blog-content .blog-meta ul li {
    margin-right: 10px;
}
.blog-content .blog-meta ul li:last-child {
    margin-right: 0px;
}
.blog-content .blog-meta ul li a {
    font-weight: 400;
    color: #888;
}
.blog-content .blog-meta ul li a i {
    font-size: 12px;
}
.blog-content h3 {
    font-size: 20px;
    line-height: 28px;
    text-align: left !important;
    color: #6ABD48;
}
.blog-content p {
    margin-top: 20px;
    margin-bottom: 15px;
    text-align: left !important;
}
.blog-meta ul li{
    display: inline-block;
}
.pull_right {
    float: right;
}
.blog_ul {
    text-align: left;
}

/*--------blog-area end--------*/

</style>
