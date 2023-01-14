<template>
      <!-- Main Sidebar Container -->
  <aside v-if="user.user.role !='Customer'" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">NBY Virtual Expo</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <router-link to="#" class="d-block">{{ user.user.name }}</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <router-link to="/" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </router-link>

          </li>


          <li class="nav-item has-treeview" v-if="user.user.role == 'Admin' || user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item" v-if="user.user.role == 'Admin'">
                <router-link to="/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </router-link>
              </li>
              <li class="nav-item" v-if="user.user.role == 'Company' || user.user.role == 'GeneralStaff' || user.user.role == 'CustomerCare'">
                <router-link to="/stall-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stall User</p>
                </router-link>
              </li>
            <!--   <li class="nav-item">
                <router-link to="permission" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="assign-role" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Role</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="assign-permission" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Permission</p>
                </router-link>
              </li> -->
            </ul>
          </li>
           <li class="nav-item has-treeview" v-if="user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name:'Order'}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All order</p>
                </router-link>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview" v-if="user.user.role == 'Admin'">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Event Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/event-category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Event Category</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/event-subcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Event Sub Category</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview"  v-if="user.user.role == 'Admin' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Company
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/company" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Company</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="company-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company User</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview"  v-if="user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Stall
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/stall-layout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stall Layout</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/stall" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stall</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/stall-ads" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stall Ads</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/stall-resource" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stall Resource</p>
                </router-link>
              </li>
               <li class="nav-item">
                <router-link to="/delivery-district" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivery District </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/shipping-cost" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shipping Cost</p>
                </router-link>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview"  v-if="user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Stall Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/product-category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Category</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/product-subcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Sub Category</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/product" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </router-link>
              </li>

            </ul>
          </li>


           <!-- <li class="nav-item has-treeview"  v-if="user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Stall Resource
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/stall-resource" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stall Resource</p>
                </router-link>
              </li>
            </ul>
          </li> -->



          <li class="nav-item has-treeview"  v-if="user.user.role == 'Admin'">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Site Ads
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="ads" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Ads in Site</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview"  v-if="user.user.role == 'Admin' || user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Media Center
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/blog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Media Center Post</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview" v-if="user.user.role == 'Admin'">
            <router-link to="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Webinar
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/webinar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Webinar Schedule</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/webinar-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Webinar User</p>
                </router-link>
              </li>
            </ul>
          </li>
           <li class="nav-item"  v-if="user.user.role == 'Admin' || user.user.role == 'Company' || user.user.role == 'CustomerCare' || user.user.role == 'GeneralStaff' ">
                <router-link to="#" @click.native="signOut" class="nav-link">
                  <i class="fa fa-logout nav-icon"></i>
                  <p>Sign Out</p>
                </router-link>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    props:['signOut'],
    data(){
        return{
            permission:''
        }
    },
    computed:{
        ...mapGetters({
            user:'user'
        })
    },


}
</script>
