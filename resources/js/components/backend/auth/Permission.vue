<template>

<div class="main-content-container container-fluid px-4">
	<!-- Page Header -->
	<div class="page-header row no-gutters py-4">
		<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
			<!-- <span class="text-uppercase page-subtitle">Overview</span> -->
			<h3 class="page-title">{{myLang.permission_management}}</h3>
		</div>
	</div>
	<div class="row" id="div">
		<div class="col-lg-4" v-can="['permission_create']">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">{{myLang.manage_permission}}</h6>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item p-3">
						<div class="row">
							<div class="col">
								<form class="">
									<input type="hidden" v-model="form.permission_update_id" value="">
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="permission_name">{{myLang.permission_name}}</label>
											<input type="text" v-model="form.permission_name" name="permission" class="form-control" id="permission_name" :placeholder="myLang.please_permission_name">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="permission_descr">{{myLang.permission_desc}}</label>
											<textarea id="permission_descr" v-model="form.permission_description" class="form-control" name="permission_descr" :placeholder="myLang.permission_desc" rows="5"></textarea>
										</div>
									</div>
									<b-button pill variant="primary" @click.prevent="SubmitPermission()"><b-icon icon="inbox-fill" font-scale="1.2"></b-icon> {{form.submit_button}}</b-button>
								</form>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-8" v-can="['permission_view']">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">{{myLang.permission_list}}</h6>
				</div>
				<div class="card-body p-0 pb-3">
					<table id="permission_list_tbl" class="table mb-0">
						<thead class="bg-light">
							<tr>
								<th style="width:10%">#</th>
								<th style="width:35%;">{{myLang.permission_name}}</th>
								<th style="width:35%">{{myLang.permission_desc}}</th>
								<th colspan="2" style="width:20%">{{myLang.permission_action}}</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item, i) in permissions" :key="item.id">
                                <td>{{ (i+1) }}</td>
								<td>{{item.name}}</td>
								<td>{{item.permission_description}}</td>
								<td>
									<b-button variant="info" :disabled="is_disabled(item.is_system)" @click.prevent="editPermission(item)" v-can="['permission_update']"> <b-icon icon="pencil-square" font-scale="1.2"></b-icon></b-button>
								</td>
								<td>
									<b-button variant="danger" :disabled="is_disabled(item.is_system)" @click.prevent="deletePermission(item.id)" v-can="['permission_delete']"><b-icon icon="trash-fill" font-scale="1.2"></b-icon></b-button>
								</td>
							</tr>
						</tbody>

					</table>
				</div>

			</div>
		</div>
	</div>

</div>
</template>
<script>

export default {
  data() {
    return {
      permissions: [],
      // BASE_URL:Globals.base_url,
      form: new Form({
        permission_name: "",
        permission_description: "",
        permission_update_id:"",
        submit_button:Globals.save,
      })
    };
  },
  methods: {
    //get Table data
    loadPermissionData() {
      this.init();
      axios.get(this.BASE_URL+"api/permission").then(({ data }) => {
            this.permissions=data.permissions;
        })
        .catch(() => {
          console.log("Error...");
        });
    },

    //Insert Permission
    SubmitPermission() {
      this.init();
      this.form.post(this.BASE_URL+"api/permission").then(({ data }) => {
        if (data.message=='created') {
            this.alert_text=this.myLang.permission_setup_completed
            this.loadPermissionData();
            this.form.clear();
            this.form.reset();
        }else if (data.message=='duplicated') {
          this.alert_text=this.myLang.permission_already_exists
        }else if (data.message=='updated') {
          this.alert_text=this.myLang.permission_updated
          this.loadPermissionData();
          this.form.clear();
          this.form.reset();
        }else if (data.message=='required') {
          this.alert_text=this.myLang.permission_name_blank
        }
          this.alert_title=data.title
          this.alert_icon=data.class_name
          this.sweet_normal_alert();
        })
        .catch(() => {
          this.sweet_advance_alert();
        });
    },
    editPermission(item) {
      this.init();
      this.form.clear();
      this.form.reset();
       this.form.permission_name=item.name;
       this.form.permission_description=item.permission_description;
       this.form.submit_button=Globals.update;
       this.form.permission_update_id=item.id;
       $("html, body").animate({ scrollTop: 0 }, "slow");
    },
    //Delete Permoission
            deletePermission(id){
              this.init();
              this.delete_sweet().then((result) => {     
              if (result.value) { 
                //Send Request to server
                this.form.delete(this.BASE_URL+'api/permission/'+id)
                    .then(({data})=> {
                      if (data.message=='deleted') {
                        this.alert_text=this.myLang.permission_deleted
                      }else if(data.message=='faild'){
                        this.alert_text=this.myLang.permission_not_deleted
                      }
                      this.alert_icon=data.class_name
                      this.alert_title=data.title
                      this.sweet_normal_alert();
                      this.loadPermissionData();

                    }).catch(() => {
                        this.sweet_advance_alert();
                    })
                }

            })
            },
    //Pagination
    // getResults(page = 1) {
    //   axios.get("api/role?page=" + page).then(response => {
    //     this.tabledata = response.data;
    //   });
    // }
  },

  created() {
    //LoadTableData
    this.loadPermissionData();
  },
  mounted() {
    console.log("Permission page loaded");
  }
};
</script>