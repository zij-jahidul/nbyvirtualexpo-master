<template>
<div class="row">
  <div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        
        <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
        <h3 class="page-title">{{myLang.role_management}}</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4" v-can="['role_create']">
        <div class="card card-small mb-4">
          <div class="card-header border-bottom">
            <h6 class="m-0">{{myLang.manage_role}}</h6>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
              <div class="row">
                <div class="col">
                  <form class="form-horizontal">
                    <input type="hidden" v-model="form.role_update_id" value="">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="role_name">{{myLang.role_name}}</label>
                        <input type="text" id="role_name" v-model="form.role_name" :placeholder="myLang.please_role_name" class="form-control" :class="{ 'is-invalid': form.errors.has('role_name') }" />
                        <has-error :form="form" field="role_name"></has-error>
                      </div>
                    </div>
                    <!-- old  -->
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label class="typo__label" for="permissions">{{myLang.permission_name}}</label>
                        <multiselect v-model="form.permissions" id="permissions" :placeholder="myLang.permission_name" label="name" track-by="id" :options="all_permissions" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" open-direction="bottom"></multiselect>
                        <has-error :form="form" field="permissions"></has-error>
                      </div>
                    </div>
                    
                    <!-- old  -->

                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="role_description">{{myLang.desc}}</label>
                        <textarea class="form-control" v-model="form.role_description" :placeholder="myLang.role_desc" rows="5"></textarea>
                        <has-error :form="form" field="role_description"></has-error>
                      </div>
                    </div>
                    <b-button pill variant="primary" @click.prevent="SubmitRole" type="submit">
                      <b-icon icon="inbox-fill" font-scale="1.2"></b-icon> {{form.submit_button}}
                    </b-button>
                  </form>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-8" v-can="['role_view']">
        <div class="col" id="role_list_tbl">
          <div class="card card-small mb-8">
            <div class="card-header border-bottom">
              <h6 class="m-0">{{myLang.role_list}}</h6>
            </div>
            <div class="card-body p-0 pb-3">
              <table id="role_list" class="table mb-0">
                <thead class="bg-light">
                  <tr>
                    <th>Sl</th>
                    <th>{{myLang.role_name}}</th>
                    <th>{{myLang.role_permission}}</th>
                    <th>{{myLang.role_action}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, i) in role_permissions" :key="item.role_id">
                    <td style="width:5%;">{{ (i+1) }}</td>
                    <td style="width:15%;">{{ item.role_name }}</td>
                    <td style="" v-html="item.role_permissions">
                    </td>
                    <td style="width:20%;">
                      <b-button variant="info" v-can="['role_update']" @click.prevent="editRole(item)">
                        <b-icon icon="pencil-square" font-scale="1.2"></b-icon>
                      </b-button>
                      <b-button variant="danger" :disabled="is_disabled(item.is_system)" v-can="['role_delete']" @click="deleteRole(item.role_id)">
                        <b-icon icon="trash-fill" font-scale="1.2"></b-icon>
                      </b-button>
                    </td>
                  </tr>
                </tbody>
              </table>
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
  data() {
    return {
      role_permissions: {},
      role_permissions_id: {},
      all_permissions: [],
      user_data:null,
      form: new Form({
        role_name: "",
        permissions: [],
        role_description: "",
        role_update_id:"",
        submit_button:Globals.save,
      })
    };
  },
  methods: {
    //get Table data
    loadTableData() {
      this.init();
      axios.get(this.BASE_URL+"api/role").then(({ data }) => {
          this.role_permissions = data.role_permissions;
          this.all_permissions = data.role_permissions[0].all_permissions;
        })
        .catch(() => {
          console.log("Error...");
        });
    },

    //Insert role
    SubmitRole() {
      this.init();
      this.form
        .post(this.BASE_URL+"api/role")
        .then(({data}) => {
          if (data.alert_text=='required') {
            this.alert_text=this.myLang.role_name_required
          }else if(data.alert_text=='updated'){
            this.alert_text=this.myLang.role_updated
            this.loadTableData();
            this.form.clear();
            this.form.reset();
          }else if(data.alert_text=='duplicated'){
            this.alert_text=this.myLang.role_duplicated
          }else if(data.alert_text=='created'){
            this.alert_text=this.myLang.role_setup_completed
            this.loadTableData();
            this.form.clear();
            this.form.reset();
          }
          this.alert_title=data.title
          this.alert_icon=data.class_name
          this.sweet_normal_alert();
        })
        .catch(() => {
          this.sweet_advance_alert();
        });
    },
    editRole(item) {
      this.init();
      this.form.clear();
      this.form.reset();
       this.form.role_name=item.role_name;
       this.form.role_description=item.role_description;
       this.form.permissions=item.permissions;
       this.form.submit_button=Globals.update;
       this.form.role_update_id=item.role_id;
      //  window.scrollTo(0,0);
       $("html, body").animate({ scrollTop: 0 }, "slow");
    },
    //Delete role
            deleteRole(id){
              this.init();
              this.delete_sweet().then((result) => {     
              if (result.value) { 
                //Send Request to server
                this.form.delete(this.BASE_URL+'api/role/'+id)
                    .then(({data})=> {
                      if (data.alert_text=='success') {
                        this.alert_text=this.myLang.role_deleted
                      }else if(data.alert_text=='faild'){
                        this.alert_text=this.myLang.role_not_deleted
                      }
                      this.alert_icon=data.class_name
                      this.alert_title=data.title
                      this.sweet_normal_alert();
                      this.loadTableData();
                    }).catch(() => {
                        this.sweet_advance_alert();
                    })
                }

            })
            }
    //Pagination
    // getResults(page = 1) {
    //   axios.get("api/role?page=" + page).then(response => {
    //     this.tabledata = response.data;
    //   });
    // }
  },

  created() {
    //LoadTableData
    this.loadTableData();
  },
  mounted() {
    console.log("Role page loaded");
  }
};
</script>
