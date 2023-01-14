<template>

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{myLang.overview}}</span>
            <h3 class="page-title">{{myLang.user_profile}}</h3>
        </div>
    </div>
    <div class="row" id="div">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto" id="image_id">
                        <img class="rounded-circle" v-if="user_image" :src="user_image" :alt="myLang.image_set" width="110" />
                        <!-- <img class="rounded-circle" src="" alt="No image" width="110"> -->
                    </div>
                    <h4 class="mb-0" id="name_id">{{form.name}}</h4>
                    <span class="text-muted d-block mb-2" id="email_id">{{form.email}}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <!-- <strong class="text-muted d-block mb-2">Workload</strong> -->
                            <div class="px-4">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{myLang.profile_details}}</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row" id="div">
                            <div class="col">
                                <form enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="f_name">{{myLang.name}}</label>
                                            <input id="f_name" v-model="form.f_name" type="text" class="form-control" autofocus
                                                :placeholder="myLang.name">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="l_name">{{myLang.last_name}}</label>
                                            <input id="l_name" v-model="form.l_name" type="text" class="form-control" :placeholder="myLang.last_name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="update_full_name">{{myLang.full_name}}</label>
                                            <input id="update_full_name" v-model="form.name" type="text" class="form-control" :placeholder="myLang.name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="update_email">{{myLang.email}}</label>
                                            <input id="update_email" v-model="form.email" type="text" class="form-control"  :placeholder="myLang.email">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="update_phone">{{myLang.phone_number}}</label>
                                            <input id="update_phone" v-model="form.phone" type="number" class="form-control" placeholder="Eg: 0123456789">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="update_dob">{{myLang.date_birth}}</label>
                                            <input id="update_dob" type="date" class="form-control" v-model="form.dob">
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="image">{{myLang.profile_picture}}</label>
                                            <input id="image" type="file" class="form-control" @change="onFileChange">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender">{{myLang.gender}}</label>
                                            <multiselect v-model="form.gender" :options="genders" :searchable="true" :close-on-select="true" :show-labels="true" :placeholder="myLang.choose"></multiselect>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="postal_code">{{myLang.zip}}</label>
                                            <input id="postal_code" type="text" class="form-control" v-model="form.zip" :placeholder="myLang.postal_code">
                                        </div>
                                    </div>
                                    <b-button pill variant="accent" @click.prevent="updateUser" v-can="(user_id==form.auth_id)?['user_update','personal_user_update']:['user_update']">
                                       <b-icon icon="arrow-repeat" font-scale="1.2"></b-icon> {{update_button}}
                                    </b-button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</template>

<script>

export default {
  data() {
    return {
        update_button:Globals.update,
        form: new Form({
                f_name:null,
                l_name:null,
                name:null,
                email:null,
                phone:null,
                dob:null,
                image_url:null,
                gender:'',
                zip:null,
                user_id:'',
                auth_id:'',
                }),
      genders: ['Male', 'Female','Others'],
      user_id:'',
      user_image:'',
    //   BASE_URL:Globals.base_url,
    };
  },
  methods: {
    //get Table data
    loadUserDetailsData() {
        this.init();
      axios.get(this.BASE_URL+"api/user_details/"+this.user_id)
        .then(({ data }) => {
            var users=data.users[0];
            this.form.name=users.name
            this.form.email=users.email
// Details data
            this.form.f_name=users.first_name
            this.form.l_name=users.last_name
            this.form.phone=users.phone
            this.form.dob=users.date_of_birth
            this.form.gender=users.gender
            this.form.zip=users.postal_code
            this.user_image=this.BASE_URL+'storage/app/backend/images/users/'+users.image
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    onFileChange(e) {
        let file = e.target.files[0];
        // console.log(file);
        // console.log(file.type);
                let reader = new FileReader();
                if(file.size < 2111775){
                    if (file.type =="image/png" ||file.type =="image/jpeg") {
                        reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                     this.form.image_url = reader.result;
                     this.user_image = reader.result;
                    }
                     reader.readAsDataURL(file);
                    }else{
                        this.alert_text='File must me jpg or png'
                        this.alert_title="Warning!",
                        this.alert_icon="warning"
                        this.sweet_normal_alert();
                  $('#image').val('');
                    }
                }else{
                    this.alert_text='File size can not be bigger than 2 MB'
                    this.alert_title="Warning!",
                    this.alert_icon="warning"
                    this.sweet_normal_alert();
                  $('#image').val('');
                }
    //   this.form.image_url = URL.createObjectURL(file);
    },

    //User Update
    updateUser() {
        this.init();
      this.form.post(this.BASE_URL+"api/users_update")
        .then(({ data }) => {
            if (data.message=='fname_required') {
                this.alert_text=this.myLang.fname_required
            }else if(data.message=='lname_required'){
                this.alert_text=this.myLang.lname_required
          }else if(data.message=='full_name_required'){
              this.alert_text=this.myLang.full_name_required
          }else if(data.message=='email_required'){
              this.alert_text=this.myLang.email_required
          }else if(data.message=='phone_required'){
              this.alert_text=this.myLang.phone_required
          }else if(data.message=='dob_required'){
              this.alert_text=this.myLang.dob_required
          }else if(data.message=='postal_required'){
              this.alert_text=this.myLang.postal_required
          }else if(data.message=='no_permission'){
              this.alert_text=this.myLang.no_permission_change_email
          }else if(data.message=='exists'){
              this.alert_text=this.myLang.email_exist
          }else if(data.message=='updated'){
              this.alert_text=this.myLang.user_update
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
      this.user_id = this.$route.params.id;
      this.form.user_id = this.$route.params.id;
      this.form.auth_id = this.$route.params.auth_id;
    //LoadTableData
    this.loadUserDetailsData();
  },
  mounted() {
    console.log("User details page loaded");
  }
};
</script>
