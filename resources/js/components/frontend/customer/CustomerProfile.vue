<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header bg-primary">
                                <div v-if="status== true" class="alert alert-success text-center" v-text="successMsg"></div>
                                <h3 class="text-center mb-0 text-white">Update Profile</h3>
                            </div>
                            <div class="card-body">
                                <form class="form" @submit.prevent="updateProfile()">
                                    <input type="hidden" name="user_id" :value="user.user.id">
                                    <input type="text" class="form-control mb-4" name="name" :value="user.user.name" placeholder="Name">
                                    <input type="text" class="form-control mb-4" name="email" :value="user.user.email" placeholder="Email or Phone">
                                    <input type="password" class="form-control mb-4" name="password" placeholder="New Password">
                                    <input type="password" class="form-control mb-4" name="password_confirmation" placeholder="Confirm Password">
                                    <input type="file" class="form-control" name="photo">
                                    <img style="width:150px;height:150px;" class="mt-3" :src="userImage+user.user.photo" alt="">

                                    <button type="submit" class="btn btn-primary btn-block mt-2 mb-3">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        <br><br><br>
    </div>

</template>

<script>
import {mapGetters} from 'vuex'
import frmixin from '../../../src/mixin-frontend'
export default {
mixins:[frmixin],
data(){
    return{
        successMsg:'',
        status:false,

    }
},
computed:{
    ...mapGetters({
        user:'user'
    })
},
methods:{
    updateProfile(){
        let userData = new FormData($('.form')[0])
        axios.post(this.url+'/api/update-user-profile', userData)
        .then(res=>{
            this.status = true
            this.successMsg = this.user.user.name+' your profile is updated'
            console.log('profile', res);
            setTimeout(()=>{
                this.status = false
            }, 3000)
        })
        .catch(error=>{
            if(error.response.status == 422){
                this.error = error.response.data.errors

                $.each(error.response.data.errors, function(item,index){
                    let input = jQuery(document).find('input[name="'+item+'"]')
                    let inputAfter = jQuery(document).find('input[name="'+item+'"] + span')

                    input.addClass('is-invalid')

                    inputAfter.remove()
                    input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')

                })
            }
        })
    }
},
    // data(){
    //     return {
    //         url:window.location.origin,
    //         image:'',
    //         apiUrl : window.location.origin,
    //         carts:[],
    //         summary:[],
    //         imgUrl : window.location.origin+'/frontend/assets/uploads/products/',
    //         address:{},
    //     }
    // },

}
</script>

<style scoped>

.title {
    border-bottom: 2px solid #F1F1F1;
    margin: 0 30px;
    padding-bottom: 10px;
}
.cart_list ul {
    list-style: none;
}
.cart_list ul li {
    padding: 10px 30px;
}

.cart_list .li_span_right {
    float: right;
}

.left_side {
    border: 2px solid #F1F1F1;
}
.right_side {
    border-left: 2px solid #F1F1F1;
    border-right: 2px solid #F1F1F1;
}
.cart_image {
    background-color: #F1F1F1;
    text-align: center;
    padding: 10px 5px;
    border: 1px solid silver;
    border-radius: 5px;
    vertical-align: middle;
}

.right_bar ul {
    list-style: none;
}
.right_bar ul li:first-child{
    margin-left: 0 !important;
}
.right_bar ul li {
    float: left;
    margin-left: 22%;
}

.product_name[data-v-3016b4dd] {
    font-size: 18px;
    font-weight: 500;
    line-height: 26px;
}

.offer_price[data-v-3016b4dd] {
    font-size: 22px;
    font-weight: 600;
}

.selling_price {
    text-decoration: line-through;
    color: red;
    font-size: 16px;
}
.total_price[data-v-3016b4dd][data-v-3016b4dd] {
    font-size: 22px;
    font-weight: 600;
    text-align: right;
    padding-right: 5%;
    color: #6ABD48;
}

.delete_icon {
    cursor: pointer;
    padding: 5px 7px;
    background-color: red;
    border-radius: 33%;
    color: #fff;
    position: absolute;
    right: -1px;
    top: -1px;
}

.btn_color {
    background-color: #6ABD48;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
.single-cart_item{
    border: 1px solid silver;
    border-radius: 10px;
}
.cart-update-area{
    display: inline-flex;
}
input.cart-update-input {
    width: 50%;
    outline:none!important;
    border: 1px solid silver;
}
input.cart-update-input:focus {
    outline:none!important;
}
.summary-area{
    border: 1px solid silver;
    border-radius: 10px;
    padding-top: 10px;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
.address-area {
    width: 90%;
    margin: 25px auto 0;
}
.address-area input{
    margin: 5px 0;
}
.card{
    border: 2px solid rgb(64 144 220);
    border-radius: 0.5rem;
}
</style>
