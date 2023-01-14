<template>
  <div>
      <div id="signin">
          <div class="container m-20">
            <div class="row justify-content-center signupfull_div">

                <div class="col-md-6 form-area">
                    <div class="row mt-3 justify-content-center">
                        <form class="signInForm" @submit.prevent="signIn()">
                        <div class="col-md-12 text-center">
                            <h4 class="mt-3 mb-3">LogIn</h4>
                            <h2 class="mb-4">Welcome to Digital DITF 2021</h2>
                            <p class="sign_in_error"></p>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="row">

                                <div class="col-md-12 my-2">
                                    <input type="text" id="email" name="email"  class="form-control input_field" placeholder="Enter your email or phone number" required>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <input type="password" id="password" name="password" class="form-control input_fieldtwo" placeholder="Enter your password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn_design btn-block my-2 mb-3">Login</button>
                             <strong @click.prevent="trySignUp()" class="text-center">Don't have a account?<a href="" class="login_button">Register Now</a></strong>
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
props:['signIn', 'trySignUp'],
data(){
    return {
        url:window.location.origin
    }
}
}
</script>

<style scoped>
#signin {
	position: absolute;
	left: 50%;
	top: 50%;
	transform: translate(-50% ,0%);
	width: 100%;
    height: 100%;
    margin-top: 5%;
}

.form-area{
	background: rgba(255, 255, 255, 0.9);
    box-shadow: 0px 0px 25px black;
    border-radius: 8px;
}

.btn_design {
    background-color: #0073C5;
    color:#fff;
}

.signupfull_div {
	margin: 5% 5%;
	border-radius: 3%;
}
.input_field {
    padding: 3%;
    background-color: #EAEAEA;
    border-radius: 5px;
}
.input_fieldtwo{
    padding: 3%;
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