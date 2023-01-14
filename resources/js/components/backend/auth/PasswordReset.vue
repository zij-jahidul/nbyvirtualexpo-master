<template>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <h3 class="page-title">Password Reset</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    
    <div class="row" id="div">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Password Reset form</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <br>
                    <div class="form-group row">
                        <label for="new_password"
                            class="col-md-4 col-form-label">New password</label>

                        <div class="col-md-4">
                            <input v-model="password" type="password" class="form-control"
                                placeholder="New password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password_confirm"
                            class="col-md-4 col-form-label">Confirm password</label>

                        <div class="col-md-4">
                            <input v-model="confirm_password" type="password" class="form-control" placeholder="Confirm password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label"></label>

                        <div class="col-md-4">
                            <input type="submit" @click.prevent="changePassword" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
data(){
    return{
        password:'',
        confirm_password:'',
        user_update_id:'',
        auth_id:'',
    }
},
methods:{
    changePassword(){
                if (this.password == '' || this.confirm_password == '') {
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
                if ((this.password).length<6) {
                    this.alert_text="Password must greater than 6 charecter"
                    this.alert_title="Required!",
                    this.alert_icon="error"
                    this.sweet_normal_alert();
                    return false;
                }
                this.init();
                var password_data={user_id:this.user_update_id,auth_id:this.auth_id,password:this.password}
                axios.post(this.BASE_URL+"api/change_password",password_data)
                .then(({ data }) => {
                    if (data.message=='no_permission') {
                    this.alert_text="You have no permission to change the password"
                    }else if(data.message=='password_changed'){
                    this.alert_text=this.myLang.password_changed
                    }else if(data.message=='required'){
                    this.alert_text="Password length must greater than 6 charecter"
                    }
                    this.alert_title=data.title
                    this.alert_icon=data.class_name
                    this.sweet_normal_alert();
                })
                .catch(() => {
                this.sweet_advance_alert();
                });
            },
},
created() {
    //LoadTableData
    this.user_update_id = this.$route.params.id;
    this.auth_id = this.$route.params.auth_id;
    this.init();
  },

}
</script>

<style>

</style>