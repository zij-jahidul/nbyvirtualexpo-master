<template>
  <div>
      <div id="signup">
          <div class="container">
            <div class="row justify-content-center signupfull_div">

                <div class="col-md-6  form-area">
                    <div class="row justify-content-center">
                        <form class="signup" @submit.prevent="signUp()">
                        <div class="col-md-12 text-center">
                            <h4 class="mt-3 mb-2">Registration</h4>
                            <h4 class="mb-2"> <strong>Welcome to Digital DITF 2021</strong> </h4>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <input type="text" name="name" class="form-control input_field" placeholder="Enter your name" required>
                                </div>

                                <div class="col-md-12 my-2">
                                    <input type="text" name="email" class="form-control input_field" placeholder="Enter your email or phone number" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <input type="password" name="password" class="form-control input_field" placeholder="Enter your password" required>
                                </div>

                                <div class="col-md-12 my-2">
                                    <input type="password" name="password_confirmation" class="form-control input_field" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <div class="row" v-if="isOtp == false">
                                <div class="col-md-12 mt-2"> 

                                    <input type="file" name="photo" class="file_upload" style="display:none;">
                                    <div class="drag-drop text-center" @click="openFile()">
                                      <i class="fas fa-cloud-upload-alt icon-size"></i>
                                    </div>

                                </div>
                            </div>


                            <button v-if="isOtp == false" type="submit" class="btn btn_design btn-block my-2 mb-3">Registration</button>

                            <strong v-if="isOtp == false" @click.prevent="trySignIn()" class="text-center">Already Have a account?<a href="" class="login_button">Login</a></strong>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
      </div>
      </div>
      
  </div>
</template>

<script>
export default {
    props:['signUp', 'trySignIn', 'isOtp'],
    data(){
        return {
            formData:{},
            url:window.location.origin,


        }
    },
    methods:{
        
        openFile(){
            $('.file_upload').trigger('click')
        }
    }
}
</script>

<style scoped>
.drag-drop{
    color: #3399ff;
    border: 0.4px dotted;
}
.icon-size{
        font-size: 220%;
}
.btn_design {
    background-color: #0073C5;
    color:#fff;
}

.signupfull_div{
	margin: 5% 5%;
	border-radius: 3%;
    
}
.input_field {
    background-color: #EAEAEA;
    border-radius: 5px;
}
.input_fieldtwo{
    padding: 10%;
    background-color: #EAEAEA;
    border-radius: 5px;
}
::placeholder {
    color: #453B54;
}
.login_button {
    color: #130727;
    margin-left: 10px;
}

</style>