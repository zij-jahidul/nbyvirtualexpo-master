<template>

  <div>
        <section id="blogdetails_part">

        <div class="row justify-content-center">
          <div class="col-md-8">

                <router-link to="/blog-page">
                    <a href=""> <i class="fas fa-angle-left mr-2"></i>  Back </a>
                </router-link>

                <div class="mb-3"></div>

                <div class="blog-wrap">
                    <div class="blog-image">
                        <img :src="blogs.feature_image" alt="Blog One" class="blog_image">
                        <ul>
                            <li>{{blogs.created_day}}</li>
                            <li>{{blogs.created_month}}</li>
                        </ul>
                    </div>
                    <div class="blog-content">

                        <div class="blog-meta">
                            <ul class="blog_ul">
                                <li><a href="#"><i class="fa fa-user mr-1"></i> {{blogs.user.name}}</a></li>
                                <li class="pull_right"><a href="#"><i class="fas fa-clock mr-2"></i>{{blogs.created_date}}</a></li>
                            </ul>
                        </div>



                        <h3 class="">{{blogs.title}}</h3>

                        <p class="mb-3">{{blogs.description}}</p>





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
            blogDetailsImg:window.location.origin,
            image:'',
            blogs: {},
            url: window.location.origin
        }

    },

    methods:{
        getStallAds()
        {
            axios(this.url+'/api/single-blog?slug='+this.$route.params.slug).then(response=>{
                this.blogs = response.data.data;
                console.log( this.blogs)

            })
        },
    },

    created() {
        this.getStallAds()
    }

}
</script>

<style scoped>

#blogdetails_part {
    margin: 0 0 20px;
}
/*--------blog-area start--------*/
.blog_button[data-v-714092bd] {
	border: 1px solid gray;
	padding: 7px 40px;
	border-radius: 10px;
	margin: 20px 0;
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
    font-size: 18px;
    margin-top: 20px;
    margin-bottom: 15px;
    text-align: left !important;
}
.pull_right {
    float: right;
}
.blog_ul {
    list-style: none;
    text-align: left;
}
/*--------blog-area end--------*/
</style>
