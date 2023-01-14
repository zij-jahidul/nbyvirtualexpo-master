<template>
    <div>
       <banner v-if="show_banner"></banner>
    </div>
</template>
<script>
import Banner from '../../components/frontend/layouts/Banner';
export default {
    data(){
        return{
            show_banner:false
        }
    },
    components:{
        Banner
    }, 
    created(){
        this.show_banner = true
    },
    mounted(){
    //    this.show_banner = true
    },
    methods:{
       clickMe() {
           console.log('yes, you are clicked');
       }
    }
}
</script>
