<template>

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <h3 class="page-title">{{myLang.manage_users}}</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    
    <div class="row" v-can="['users_view']">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{myLang.manage_users}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>{{myLang.name}}</th>
                                <th>{{myLang.email}}</th>
                                <th>
                                    <b-button v-b-modal.modal-lg variant="primary" @click="fieldsEmpty()" v-can="['user_create']">
                                        <b-icon icon="person-plus-fill" font-scale="1.2"></b-icon>
                                        <span class="hide-menu"> {{myLang.create_new}}</span>
                                    </b-button>
                                </th>
                            </tr>
                            </thead>
                        <tbody>
                            <tr v-for="(user, i) in users" :key="i">
                                <td>{{(i+1)}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>
                                    <!-- <?php echo(\Config::get('app.url').'/user_update/'.$user->id)?> -->
                                    <router-link :to="{ name: 'users', params: { id: user.id,auth_id:global_user_id } }" class="btn btn-info" v-can="['user_profile_view']"><b-icon icon="eye-fill" font-scale="1.2"></b-icon> {{myLang.view}}</router-link>
                                    <router-link :to="{ name: 'password_reset', params: { id: user.id,auth_id:global_user_id } }" class="btn btn-warning" v-can="['change_password']"><b-icon icon="pencil-square" font-scale="1.2"></b-icon> {{myLang.change_password}}</router-link>
                                    <!-- <router-link to="/user_update/1" class="btn btn-info"><i class="fas fa-eye"></i> View</router-link> -->
                                    <!-- <a href="" class="btn btn-info" id="update_user"><i class="fas fa-eye"></i> View</a> -->
                                    <b-button variant="info" @click.prevent="permissionView(user.id,user.name)" v-can="['user_permission_view']">
                                        <b-icon icon="view-list" font-scale="1.2"></b-icon> <span class="hide-menu"> {{myLang.permission_view}} </span>
                                    </b-button>
                                    <!-- <button type="button" class="btn btn-info"><i
                                            class="fas fa-edit"></i> Permission view</button> -->
                                    <!-- <button type="button" class="btn btn-warning" @click.prevent="changePasswordModal(user.id,user.name)"><i
                                            class="fas fa-edit"></i> {{myLang.change_password}}</button> -->
                                    <button type="button" class="btn btn-danger" @click.prevent="deleteUser(user.id)" v-can="['user_delete']">
                                        <b-icon icon="trash-fill" font-scale="1.2"></b-icon> {{myLang.delete}}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Permission modal  -->
    <b-modal size="lg" :hide-backdrop="true" :title="permission_modal_title" v-model="permissionModalShow">
        <div>
            <h4>Total Permissions: {{total_permissions_by_user}}</h4>
        </div>
        <div v-html="permissions_for_user"></div>
    </b-modal>
    <!-- End Permission modal  -->
    <!-- Add new user Modal -->
    <b-modal id="modal-lg" size="lg" :hide-backdrop="true" title="Create User" ok-title="Save" @ok.prevent="save_user()" v-model="userModalShow">
        <form method="POST" id="user_create">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name" class="col-md-12 col-form-label">Name</label>
                                <div class="col-md-12">
                                    <b-form-input v-model="name" type="text" placeholder="Name"></b-form-input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-12 col-form-label">Email</label>
                                <div class="col-md-12">
                                    <b-form-input v-model="email" type="email" placeholder="Email"></b-form-input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password"
                                    class="col-md-12 col-form-label">Password</label>
                                <div class="col-md-12">
                                    <b-form-input v-model="password" type="password" placeholder="Password"></b-form-input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                    class="col-md-12 col-form-label">Confirm password</label>
                                <div class="col-md-12">
                                    <b-form-input v-model="confirm_password" type="password" placeholder="Confirm password"></b-form-input>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">
                                <label for="roles" class="col-md-12 col-form-label">Select roles</label>
                                <div class="col-md-12">
                                    <multiselect v-model="selected_roles" id="roles" placeholder="Search or add roles" label="role_name" track-by="role_id" :options="roles" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" open-direction="bottom" @input="permissionForRole($event)"></multiselect>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permission_for_user" class="col-md-12 col-form-label">Select permissions</label>
                                <!-- <multiselect v-model="selected_permissions" id="permission_for_user" placeholder="Search or add permissions" label="permission_name" track-by="permission_id" :options="permissions" :multiple="true" :close-on-select="true" :clear-on-select="false" :preserve-search="true" open-direction="bottom"></multiselect> -->
                                <b-form-group>
                                    <b-form-checkbox-group id="checkbox-group" v-model="selected_permissions">
                                    <b-form-checkbox v-for="(permission, index) in permissions" :value="permission.permission_id" :key="index" switch>{{permission.permission_name}}</b-form-checkbox>
                                    </b-form-checkbox-group>
                                </b-form-group> 
                            </div>
                        </div>

                    </div>
                </form>
    </b-modal>
<!-- Add new user Modal End -->
</div>

</template>
<script>
export default {
  data() {
    return {
        // global_user_id:Globals.user_info_id,
        name: '',
        email: '',
        password: '',
        confirm_password: '',
        users: {},
        roles: {},
        permissions:{},
        selected_roles: [],
        selected_permissions: [],
        
        permissions_for_user:'',
        total_permissions_by_user:0,
        permission_modal_title:'',
        permissionModalShow:false,
        userModalShow:false,
        password_modal_title:'',
        user_update_id:'',
        // BASE_URL:Globals.base_url,
    };
  },
  methods: {
    //get Table data
    loadUserData() {
        this.init();
      axios.get(this.BASE_URL+"api/users")
        .then(({ data }) => {
          this.users = data.users;
          this.roles = data.roles;
          this.permissions = data.permissions;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    permissionForRole(options){
        this.init();
        var role_id=[];
        options.forEach(element => {
            role_id.push(element.role_id);
        });
        var permission_data= { role_id: role_id }
        axios.post(this.BASE_URL+"api/get_permission_for_roles",permission_data)
        .then(({ data }) => {
            // made array unic 
            this.selected_permissions = Array.from(new Set(data.permission_for_role))
            // Or 
            // this.selected_permissions = (data.permission_for_role).filter((v, i, a) => a.indexOf(v) === i);
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    // User create 
    save_user(){
        this.init();
        var role_id=[];
        if (this.name == '' || this.email == '' || this.password == '' || this.confirm_password == '') {
                this.alert_text="All fields are required"
                this.alert_title="Required!",
                this.alert_icon="warning"
                this.sweet_normal_alert();
                return false;
             }
             if (this.password != this.confirm_password) {
                 this.alert_text="Password not matched"
                 this.alert_title="Required!",
                 this.alert_icon="error"
                 this.sweet_normal_alert();
                 return false;
             }
             
            (this.selected_roles).forEach(element => {
                role_id.push(element.role_id);
            });
        var user_data={name:this.name,email:this.email,password:this.password,roles:role_id,permissions:this.selected_permissions}
        axios.post(this.BASE_URL+"api/users",user_data)
        .then(({ data }) => {
        //   this.sweet_normal_alert();
          if (data.message=='exists') {
            this.alert_text=this.myLang.email_already_database
          }else if(data.message=='created'){
            this.alert_text=this.myLang.user_created
            this.loadUserData();
            this.fieldsEmpty();
            this.userModalShow=false;
          }else if(data.message=='name_required'){
              this.alert_text=this.myLang.name_length
          }else if(data.message=='email_required'){
              this.alert_text=this.myLang.email_length
          }else if(data.message=='password_required'){
              this.alert_text=this.myLang.password_length
          }
          this.alert_title=data.title
          this.alert_icon=data.class_name
          this.sweet_normal_alert();
        })
        .catch(() => {
          this.sweet_advance_alert();
        });

      },
      fieldsEmpty(){
        this.selected_roles=[];
        this.selected_permissions= [];
        this.name='';
        this.email='';
        this.password='';
        this.confirm_password='';
    },
    //Delete User
            deleteUser(id){
                this.init();
                this.delete_sweet().then((result) => {     
              if (result.value) { 
                //Send Request to server
                axios.delete(this.BASE_URL+'api/users/'+id)
                    .then(({data})=> {
                        if (data.message='deleted') {
                            this.alert_text=this.myLang.user_deleted
                        }
                        this.alert_title=data.title
                        this.alert_icon=data.class_name
                        this.sweet_normal_alert();
                        this.loadUserData();

                    }).catch(() => {
                        this.sweet_advance_alert();
                    })
                }

            })
            },
            permissionView(user_id,user_name){
                this.init();
                this.permissionModalShow=true;
                this.permission_modal_title="Permissions for "+user_name;
                var user_data={user_id:user_id}
                axios.post(this.BASE_URL+"api/permissions_by_users",user_data)
                .then(({ data }) => {
                    this.total_permissions_by_user=0;
                    this.permissions_for_user='';
                    this.total_permissions_by_user=data.total_permissions;
                    this.permissions_for_user=data.permissions_for_user;
                })
                .catch(() => {
                this.sweet_advance_alert();
                });
            },
  },

  created() {
    //LoadTableData
    this.loadUserData();
  },
  mounted() {
    console.log("User page loaded");
  }
};
</script>