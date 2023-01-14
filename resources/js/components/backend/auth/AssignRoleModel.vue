<template>
<div class="main-content-container container-fluid px-4">
	<!-- Page Header -->
	<div class="page-header row no-gutters py-4">
		<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
			<!-- <span class="text-uppercase page-subtitle">Overview</span> -->
			<h3 class="page-title">{{myLang.role_permission_menu}}</h3>
		</div>
	</div>
	<div class="row" v-can="['assign_role_to_user_view']">
		<div class="col-sm-12">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">{{myLang.assign_role}}</h6>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item p-3">
						<div class="row">
							<div class="col">
								<!-- <form> -->
									<div class="form-group row">
										<label for="inputEmail3"
											class="col-sm-2 col-form-label">{{myLang.user_name}}</label>
										<div class="col-sm-4">
                       <multiselect v-model="user" :options="all_users" :searchable="true" :close-on-select="true" :show-labels="true" :placeholder="myLang.select_user" label="user_name" track-by="user_id" @select="showRoles($event)"></multiselect>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{myLang.select_role}}</label>
										<div class="col-md-10">  
                      <b-form-group v-if="user_id!=''">
                        <b-form-checkbox-group id="checkbox-group" v-model="selected_roles">
                          <b-form-checkbox class="btn outline-secondary" style="margin:3px; line-height:5px; height:25px;" v-for="(role, index) in all_roles" :value="role.role_id" :key="index" switch>{{role.role_name}}</b-form-checkbox>
                        </b-form-checkbox-group>
                    </b-form-group> 
                    <h6 v-else>{{myLang.user_no_select}}</h6>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-2 col-form-label"></label>
										<div class="col-sm-4">
											<b-button pill variant="primary" v-if="user_id!=''" @click.prevent="AssignRole()" v-can="['assign_role_to_user_update']"> <b-icon icon="inbox-fill" font-scale="1.2"></b-icon> {{submit_button}}</b-button>
										</div>
									</div>
								<!-- </form> -->
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
        all_users: [],
        user:'',
        all_roles:{},
        selected_roles:[],
        user_id:'',
        submit_button:Globals.save,
    //   })
    };
  },
  methods: {
    //Get user data
    loadUserData() {
      this.init();
      axios.get(this.BASE_URL+"api/all_users_roles").then(({ data }) => {
            this.all_users = data.users;
            this.all_roles = data.roles;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    showRoles(option){
      
      this.init();
       this.user_id=option.user_id;
       if (this.user_id) {
           axios.get(this.BASE_URL+"api/get_roles/"+this.user_id)
        .then(({ data }) => {
            // console.log(this.selected_roles);
            var roles=data.model_data
            var role_ids=[];
            for (let i = 0; i < roles.length; i++) {
              role_ids.push( roles[i]['role_id']);
              this.selected_roles=role_ids;
            }
            role_ids=[];
        })
        .catch(() => {
          console.log("Error...");
        }); 
       }
        
        },
    //Assign role
    AssignRole() {
      this.init();
      var assign_role_data={roles:this.selected_roles,user_id:this.user_id}
      axios
        .post(this.BASE_URL+"api/assign_role_to_user",assign_role_data)
        .then(({ data }) => {
          if (data.message=='success') {
            this.alert_text=this.myLang.assign_role_to_user
          }
          this.alert_title=data.title
          this.alert_icon=data.class_name
          this.sweet_normal_alert();
        })
        .catch(() => {
          this.sweet_advance_alert()
        });
    },
  },
  created() {
    //LoadTableData
    this.loadUserData();
  },
  mounted() {
    console.log("Assign Role to model page loaded");
  }
};
</script>