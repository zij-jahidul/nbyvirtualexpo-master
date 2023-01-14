<?php

namespace App\Http\Controllers\API\Frontend\Auth;

use Auth;
use Helper;
use App\Models\User;
use App\Models\ChatUser;
use App\Mail\OtpSentMail;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use App\Models\Stall\StallUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;
use phpDocumentor\Reflection\Types\Object_ as TypesObject_;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
    
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users,email',
            'password'  => 'required|string|min:3|confirmed'
        ]);

        $emailOrPhone = $request->email;

        $otp = Helper::autoOtp();  
        $message = "Your otp verification code: ". $otp;

        $name = $request['name'];
        $email = $request['email'];
 
        // if (strpos($emailOrPhone, '@') !== false) {
            
        //     $details = [
        //         'name' => $name,
        //         'body' => $message
        //     ];
           
        //     Mail::to($email)->send(new OtpSentMail($details));

        // } else {

        //     $message_status = Helper::sendSMS($email, $message);

        // }

        $fileName = Helper::imgProcess($request,'photo',$request->name, '', 'images/user', 'store', User::class); 


        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'photo'    => $fileName,
            'role'     => 'Customer',
            'otp'      => $otp,
            'password' => Hash::make($request->password), //bcrypt($request->password),
        ]);

        

        return response()->json([
            'status'   => 'success',
            'message'  => 'User has been created!',
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => 'Customer',
            'otp'      => $otp
        ]);

    }

    public function resentOtp(Request $request)
    {
        
        $check = User::where('email', $request->resent_otp)->exists();

        if($check){
            
            $user = User::where('email', $request->resent_otp)->first();

            $emailOrPhone = $request->resent_otp;

            $otp = Helper::autoOtp();  

            $message = "Your otp verification resent code: ". $otp;

            $name = $user->name;
            $emailOrPhone = $request['resent_otp'];

            if (strpos($emailOrPhone, '@') !== false) {

                User::where('email', $user->email)->update(['otp' => $otp]);
                
                $details = [
                    'name' => $name,
                    'body' => $message
                ];
            
                Mail::to($email)->send(new OtpSentMail($details));

                return response()->json([
                    'status'   => 'success',
                    'otp_status'   => 'success',
                    'message'  => 'User has been created!',
                    'email'    => $user->email,
                    // 'password' => $request->password,
                    'role'     => 'Customer',
                    'otp'      => $otp
                ]);

            } else {

                User::where('email', $user->email)->update(['otp' => $otp]);

                $message_status = Helper::sendSMS($email, $message);

                return response()->json([
                    'status'   => 'success',
                    'otp_status'   => 'success',
                    'message'  => 'Verification has been created!',
                    'email'    => $request->email,
                    'password' => $request->password,
                    'role'     => 'Customer',
                    'otp'      => $otp
                ]);

            }
        } else {
            return response()->json([
                'status' => 'failed',
                'otp_status' => 'failed',
                'message' => 'Invalid Email or Phone'
            ]);
        }
        
    }

    public function otpVerify(Request $request)
    {
        
        $getData = $request->except([
            'confirm_otp',
            'confirm_otp_resent', 
            'digit_1',
            'digit_2',
            'digit_3',
            'digit_4',
            'digit_5',
            'digit_6',
            'otp_status',
            'role',
            'web_token'

            ]);

        //  $data =  ;
       

        $credential = Auth::attempt($getData);
        // return $user = Auth::user();  
        // return $credential;
       if($credential == true){

        User::where('email', $request->email)->update([
            'web_token' => $request->web_token
        ]);

        $user = Auth::user();
        $checkStallUser = StallUser::where('user_id', $user->id)->exists();
        if($checkStallUser){

            StallUser::where('user_id', $user->id)->update(['activity_status' => 1]);
        }

        $token = $user->createToken('nbyvirtualexpo')->plainTextToken;

        $response = [
            'user'              => $user,
            'token'             => $token,
            'status'            => 'success',
            'message'           => 'Login successful!'
        ];

        return response($response, 201);

       } 
       
    //    else {

    //         return response()->json([
    //             [
    //                 'message' => 'These credentials do not match our records.',
    //                 'status'  => false
    //             ], 404
    //         ]);

    //    }
       
    }



    public function signIn(Request $request)
    {
        

        $this->validate($request, [
            'email'     => 'required|string',
            'password'  => 'required|string'
        ]);


        $credential = Auth::attempt($request->only('email', 'password'));

       if($credential == true){
        
        User::where('email', $request->email)->update([
            'web_token' => $request->web_token
        ]);

        $user = Auth::user();

        $checkChatUser = ChatUser::where('user_id', $user->id)->exists();
        if($checkChatUser){

            ChatUser::where('user_id', $user->id)->update([
                'online_status' => 1
            ]);
        }

        $checkStallUser = StallUser::where('user_id', $user->id)->exists();
        if($checkStallUser){

            StallUser::where('user_id', $user->id)->update(['activity_status' => 1]);
        }
        
        $token = $user->createToken('nbyvirtualexpo')->plainTextToken;

        $stallUser = StallUser::where('user_id', Auth::user()->id)->select('id', 'user_id', 'company_id', 'stall_id')->first();
        

        if($user->role == 'Company' || $user->role == 'CustomerCare' || $user->role == 'GeneralStaff'){
            
            $stall_name = Stall::where('id', $stallUser->stall_id)->first()->stall_name; 

        } else {

            $stall_name = '';
            
        }

        $response = [
            'user'              => $user,
            'stall_owner'       => $stallUser,
            'stall_name'       => strtolower(str_replace(' ','-', $stall_name)),
            'token'             => $token,
            'status'            => true,
            'message'           => 'Login successful!'
        ];

        return response($response, 201);

       } else {

            return response()->json([
                [
                    'message' => 'These credentials do not match our records.',
                    'status'  => false
                ], 404
            ]);

       }
    }
    
}
