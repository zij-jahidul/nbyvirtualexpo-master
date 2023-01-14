<template>
<div class="main-content-container container-fluid px-4">
	<!-- Page Header -->
	<div class="page-header row no-gutters py-4">
		<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
			<!-- <span class="text-uppercase page-subtitle">Overview</span> -->
			<h3 class="page-title">{{myLang.assign_permission_to_user}}</h3>
		</div>
	</div>
	<div class="row" v-can="['assign_permission_to_user_view']">
		<div class="col-sm-12">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
          <!-- {{myLang.assign_permission_to_role}} -->
					<h6 class="m-0">{{myLang.assign_permission_to_user}}</h6>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item p-3">
						<div class="row">
							<div class="col">
								<form method="post">
									<div class="form-group row">
										<label for="inputEmail3"
											class="col-sm-2 col-form-label">{{myLang.user_name}}</label>
										<div class="col-sm-4">
											<multiselect v-model="user" :options="all_users" :searchable="true" :close-on-select="true" :show-labels="false" :placeholder="myLang.select_user" label="user_name" track-by="user_id" @select="showPermissions($event)"></multiselect>
										</div>
									</div>
									<div class="row" v-if="user_id!=''">
										<div class="col-md-2 col-lg-2"></div>
										<div class="col-md-4 col-lg-4">
											<div class="select-permission-wrapper my-4">
												<h3>{{myLang.select_permission}}</h3>
												<div v-if="not_matches.length == 0">
													{{myLang.role_no_select}}
												</div>
												<div style="margin-left:-40px;" v-else>
													<b-form-group v-if="user_id!=''">
                            <b-form-checkbox-group id="checkbox-group" v-model="selected_permissions">
                              <ul style="list-style:none;">
                                <li v-for="(not_matche, index) in not_matches" :key="index">
                                  <b-form-checkbox :value="not_matche.id" switch><p class="btn btn-info" style="padding:5px;margin:3px;">{{not_matche.name}}</p></b-form-checkbox>
                                </li>
                              </ul>
                              
                            </b-form-checkbox-group>
                        </b-form-group>
												</div>
												<div>
													<b-button pill variant="primary" @click.prevent="AssignPermissions" v-can="['assign_permission_to_user_update']"><b-icon icon="inbox-fill" font-scale="1.2"></b-icon> {{submit_button}}</b-button>
												</div>
											</div>
										</div>


										<div class="col-md-5 col-lg-5">
											<div class="select-permission-wrapper my-4">
												<h3>{{myLang.previous_permission}}</h3>
												<div v-if="permissions_by_role.length != 0">
													<ol>
                            <li style="margin-top:3px;" v-for="(permission, i) in permissions_by_role" :key="i"><p class="btn btn-info" style="padding:5px;margin:0px;">{{permission}}</p></li>
                          </ol>
												</div>
                        <div v-else>
                         {{myLang.role_no_select}}
                        </div>

											</div>
										</div>

									</div>
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
        all_users: [],
        user:'',
        permissions_by_role:[],
        selected_permissions:[],
        not_matches:[],
        user_id:'',
        submit_button:Globals.save,
    //   })
    };
  },
  methods: {
    //Get user data
    loadUserData() {
      this.init();
      axios.get(this.BASE_URL+"api/all_users_permissions").then(({ data }) => {
            this.all_users = data.users;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    showPermissions(option){
      this.init();
       this.user_id=option.user_id;
       if (this.user_id) {
           axios.get(this.BASE_URL+"api/get_permission_model/"+this.user_id)
        .then(({ data }) => {
          this.not_matches=data.not_matches
          this.selected_permissions=data.permissions_exist_id
          this.permissions_by_role=data.all_permissions_for_user_array
        })
        .catch(() => {
          console.log("Error...");
        }); 
       }
        
        },
    //Assign role
    AssignPermissions() {
      this.init();
      var assign_permission_data={permission:this.selected_permissions,user_id:this.user_id}
      axios.post(this.BASE_URL+"api/assign_permission_to_user",assign_permission_data)
        .then(({ data }) => {
         this.permissions_by_role= data.all_permissions_for_user_array
         if (data.message=='success') {
            this.alert_text=this.myLang.permission_assigned
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
    this.loadUserData();
  },
  mounted() {
    console.log("Assign Permission to model page loaded");
  }
};
</script>