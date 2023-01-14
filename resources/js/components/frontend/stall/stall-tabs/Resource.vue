<template>
    <div>
        <ul class="list-group mb-5">
            <li class="list-group-item" v-for="(resource_data, index) in resource" :key = 'index'>
                <div class="row">
                    <div class="col-8">
                        {{resource_data.name}}
                    </div>
                    <div class="col-4 text-right">
                       <a :href="resource_data.resource_file_name"><button class="btn ml-3 btn-sm btn-success">Download</button></a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import frmixin from '../../../../src/mixin-frontend'
export default {
mixins:[frmixin],
name: "Resource",
    data(){
        return{
            resource:{},
            url: window.location.origin,
        }
    },
    created() {
         this.getStallResource()
    },
    methods:{
        getStallResource() {
             let stall_id = this.$route.params.stall_id
            axios.get(this.url+'/api/get-stall-resource?stall_id='+stall_id).then(res=>{
                this.resource = res.data.data
            })
        }
    }
}
</script>

<style scoped>

</style>
