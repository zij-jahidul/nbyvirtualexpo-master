<template>
  <div>
      <div class="container text-center">
            <div class="row justify-content-center signupfull_div">
                <div class="col-md-6 form-area">
                   
                    <div class="row justify-content-center">
                        <form class="otp form"  @submit.prevent="isResentOtp == false?otpVerify():resentOtp()">
                        <div class="col-md-12">
                            <h4 class="mt-5 mb-3">{{ isResentOtp == false?'Registration':'Resend Your OTP'}}</h4>
                            <h2 class="mb-4 verification" v-if="isResentOtp == false">Verifications</h2>
                            <h4 class="text-danger" v-if="otpStatus == 'failed'">{{ isOtpFailedMessage }}</h4>
                        </div>

                        <div class="col-md-12" v-if="isResentOtp">
                            <div class="form-group">
                                <input type="text"  class="form-control resent_otp" name="resent_otp" v-model="formData.resent_otp" placeholder="Enter email or phone number">
                            </div>
                            <button type="submit" v-if="isResentOtp" class="btn btn_design btn-block mb-3 mt-4">Resend</button>
                            
                        </div>
                        

                        <div class="col-md-12 mb-5">
                             <input type="hidden" name="confirm_otp_resent" v-model="formData.confirm_otp_resent">
                            <div class="row" v-if="isResentOtp == false">
                                <div class="col-md-12 my-2 mb-4 resent_otp_number">
                                    <input type="hidden" name="confirm_otp" v-model="formData.confirm_otp">

                                    <input type="hidden" v-if="otpStatus == 'success'" name="otp_status" v-model="formData.otp_status">

                                        <input type="hidden" class="form-control" name="email" v-model="formData.email">
                                        <input type="hidden" class="form-control" name="password" v-model="formData.password">
                                        <input type="hidden" class="form-control" name="role" v-model="formData.role">
                                     <!-- <form  class="digit-group form" data-group-name="digits" data-autosubmit="false" autocomplete="off"> -->
                                        <input type="text" id="digit-1" v-on:keyup.enter="$event.target.nextElementSibling.focus()" name="digit_1" v-model="formData.digit_1" data-next="digit-2" />
                                        <input type="text" id="digit-2" v-on:keyup.enter="$event.target.nextElementSibling.focus()" name="digit_2" v-model="formData.digit_2" data-next="digit-3" data-previous="digit-1" />
                                        <input type="text" id="digit-3" v-on:keyup.enter="$event.target.nextElementSibling.focus()" name="digit_3" v-model="formData.digit_3" data-next="digit-4" data-previous="digit-2" />
                                        <span class="splitter">&ndash;</span>
                                        <input type="text" id="digit-4" v-on:keyup.enter="$event.target.nextElementSibling.focus()" name="digit_4" v-model="formData.digit_4" data-next="digit-5" data-previous="digit-3" />
                                        <input type="text" id="digit-5" v-on:keyup.enter="$event.target.nextElementSibling.focus()" name="digit_5" v-model="formData.digit_5" data-next="digit-6" data-previous="digit-4" />
                                        <input type="text" id="digit-6" v-on:keyup.enter="$event.target.nextElementSibling.focus()" name="digit_6" v-model="formData.digit_6" data-previous="digit-5" />
                                    <!-- </form> -->
                                   
                                </div>
                            </div>

                            <strong class="otp_text_one" v-if="isResentOtp == false">We sent otp to your phone number <br>
                                <a href="" class="login_button mb-4"> {{ phone }} <i class="fas fa-edit fa_icon"></i> </a>
                            </strong>


                            <button type="submit" v-if="isResentOtp == false" class="btn btn_design btn-block mb-3 mt-4"> Complete Registration {{ otpStatus }}</button>

                            <strong class="otp_text_two" v-if="isResentOtp == false">Don't get OTP yet? <router-link  to="" @click.native="resentOtpLink()" class="login_button_two">Resend OTP</router-link></strong>
                        </div>
                    </form>
                    </div>
                   
                </div>

            </div>
      </div>
  </div>
</template>

<script>
export default {
props:['phone', 'otp', 'email', 'password', 'isOtp', 'role', 'otpVerify', 'resentOtp', 'resentOtpLink','otpStatus', 'isOtpFailedMessage', 'isResentOtp', 'hasResentOtp'],
data(){
    return {
        formData:{},
        url: window.location.origin,

    }
},

created(){


    this.formData.confirm_otp_resent = this.hasResentOtp
    this.formData.confirm_otp = this.otp

    this.formData.email = this.email
    this.formData.password = this.password
    this.formData.role = this.role
    this.formData.otp_status = this.otpStatus

   
    

},

mounted(){

    let final_otp = localStorage.getItem('otp')
    $(document).find('input[name=digit_1]').val(final_otp.charAt(1))
    $(document).find('input[name=digit_2]').val(final_otp.charAt(1))
    $(document).find('input[name=digit_3]').val(final_otp.charAt(2))
    $(document).find('input[name=digit_4]').val(final_otp.charAt(3))
    $(document).find('input[name=digit_5]').val(final_otp.charAt(4))
    $(document).find('input[name=digit_6]').val(final_otp.charAt(5))
},

methods:{
 

}
    

}


// $('.digit-group').find('input').each(function() {
// 	$(this).attr('maxlength', 1);
// 	$(this).on('keyup', function(e) {
// 		var parent = $($(this).parent());
		
// 		if(e.keyCode === 8 || e.keyCode === 37) {
// 			var prev = parent.find('input#' + $(this).data('previous'));
			
// 			if(prev.length) {
// 				$(prev).select();
// 			}
// 		} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
// 			var next = parent.find('input#' + $(this).data('next'));
			
// 			if(next.length) {
// 				$(next).select();
// 			} else {
// 				if(parent.data('autosubmit')) {
// 					parent.submit();
// 				}
// 			}
// 		}
// 	});
// });

</script>

<style scoped>
.resent_otp{
    width: 100% !important;
    /* height: 41px !important; */
    padding: 0px 23px !important;
    font-size: 22px !important;
    margin: 0px !important;
    font-size: 23px !important;
    
}
.form-area{
    background:#fff;
}
.btn_design {
    background-color: #6ABD48;
    color:#fff;
}
.fa_icon {
	margin-left: 10px;
	font-size: 20px;
}

.otp_text_one {
	font-size: 18px;
	font-weight: 400;
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


.login_button {
	color: #130727;
	font-size: 22px;
    text-decoration: none !important;
}

.login_button_two {
    color: #130727;
    margin-left: 10px;
    text-decoration: none !important;
}


input {
		width: 55px;
		height: 55px;
        border-radius: 5px;
		border: none;
		line-height: 50px;
        background-color: #EAEAEA;
		text-align: center;
		font-size: 24px;
		font-family: 'Raleway', sans-serif;
		font-weight: 200;
		margin: 0 2px;
}

.splitter {
		padding: 0 10px;
		color: black;
		font-size: 24px;
}

.prompt {
	margin-bottom: 20px;
	font-size: 20px;
	color: white;
}


</style>