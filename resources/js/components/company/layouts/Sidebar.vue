<template>
    <div class="sidebar" :style="height">
        
        <ul class="main-menu">
            <li><i class="fa fa-user"></i> <router-link to="">Role & Permission <i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/user">User</router-link></li>
                    <li><router-link to="/role">Role</router-link></li>
                    <li><router-link to="/permission">Permission</router-link></li>
                    <li><router-link to="/assign-role">Assign Role</router-link></li>
                    <li><router-link to="/assign-permission">Assign Permission</router-link></li>
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Company<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/company">All Company</router-link></li>
                    <li><router-link to="/company-user">Company User</router-link></li>
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Event Category<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/event-category">All Category</router-link></li>
                    <li><router-link to="/event-subcategory">All SubCategory</router-link></li>
                </ul>
            </li>
           
            <li><i class="fa fa-user"></i> <router-link to="">Stall<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/stall-ads">All Stall Ads</router-link></li>
                    <li><router-link to="/stall-layout">All Layout</router-link></li>
                    <li><router-link to="/stall">All Stall</router-link></li>
                    <li><router-link to="/order">Stall Order</router-link></li>
                    <li><router-link to="/order-detail">All Stall Order Details</router-link></li>
                </ul>
            </li> 

            <li><i class="fa fa-user"></i> <router-link to="">Stall Products<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">

                    <li><router-link to="/product">All Product</router-link></li>
                    <li><router-link to="/product-image">Products Image</router-link></li>
                    <li><router-link to="/product-category">Products Categories</router-link></li>
                    <li><router-link to="/product-subCategory">Product Sub Categories</router-link></li>
                    <li><router-link to="/product-attribute">Product Attribute</router-link></li>
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Blog<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/blog">All Blog</router-link></li>
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Vendor Visitor<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/stall-visitor"> Stall Visitor</router-link></li>
                    <li><router-link to="/vendor-site-visitor">Vendor Site Visitor</router-link></li>
                    <li><router-link to="/visitor-point">Visitor Point</router-link></li>
                    <li><router-link to="/visitor-point-distribution">Visitor Point Distribution</router-link></li>
                </ul>
            </li>
             <li><i class="fa fa-user"></i> <router-link to="">Ads<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/ads">All Ads</router-link></li>
                    
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Webinar All<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/webinar"> Webinar</router-link></li>
                    <li><router-link to="/webinar-user">Webinar User</router-link></li>
                </ul>
            </li>


            <!-- <li><i class="fa fa-user"></i> <router-link to="">Media Center<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/media-blog">All Media</router-link></li>
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Media Blog Perticipents<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/media-blog-participents">All Perticipents</router-link></li>
                </ul>
            </li>

            <li><i class="fa fa-user"></i> <router-link to="">Webinar Metting Room<i class="fa fa-caret-right"></i></router-link>
                <ul class="dropdown">
                    <li><router-link to="/webinar-meeting-room">All Meeting</router-link></li>
                </ul>
            </li> -->


            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/event-category-model">Event Category</router-link></li> -->
            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/event-subcategory-model">Event Sub-Category</router-link></li> -->
            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/stall">Stall</router-link></li> -->
            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/stall-layout">Stall Layout</router-link></li> -->
            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/stall-product">Stall Products</router-link></li> -->
            <!-- <li><i class="fa fa-list"></i> <router-link to="/product-categories">Product Categories</router-link></li> -->

            <!-- <li><i class="fa fa-product-hunt" aria-hidden="true"></i> <router-link to="/product-sub-categories">Product Sub Categories</router-link></li> -->
            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/stall-product-attributes">Stall Product Attributes</router-link></li> -->

            <!-- <li><i class="fa fa-shopping-cart"></i> <router-link to="/stall-layout">Product Views</router-link></li> -->

            <!-- <li><i class="fa fa-music" aria-hidden="true"></i> <router-link to="/media-blog">Media Center</router-link></li> -->
            <!-- <li><i class="fa fa-music" aria-hidden="true"></i> <router-link to="/media-blog-participents">Media Blog Perticipents</router-link></li> -->

            <!-- <li><i class="fa fa-comment"></i> <router-link to="/webinar-meeting-room"></router-link></li> -->

            <li><i class="fa fa-sign-out"></i> <a href="javascript:void(0)" @click.prevent="signOut">Sign Out</a></li>
        </ul>
    </div>
</template>

<script>
import { log } from 'util'
export default {
    props:['signOut'],
    data(){
        return {
            height:''
        }
    },

    created(){
        this.height = 'height:'+screen.height+'px'
  
    }
}
</script>

<style scoped>
.sidebar{ 
    left: 0;
    right: 0;
    position: absolute;
}
</style>