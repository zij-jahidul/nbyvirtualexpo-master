<?php

namespace App\Http\Controllers\API\Frontend\Firebase;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ChatUser;
use App\Models\Chat\Chat;
use Illuminate\Http\Request;
use App\Models\Stall\StallUser;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;

class FirebaseController extends Controller
{
    public function sendTokenResponseToReceiver($message, $token)
    {
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization:key=AAAAzcpfwhk:APA91bHGdEE_kUxPl-TR71p02XKXVCT9g8JDrXwmzmmnwCo7ULkgix8A6mJ2VpHGO1_PH4L22t0gNR6fMnKwqHKwmMV14vnLylBbkmBFloG98SUosSX-uRsKw0mUWkVu-mnzcrwAJxNd',
            'Content-Type:application/json'
            
        );

        
        $data = array
        (
            'to'       => $token,
            'data'     => $message,
            'priority' => 'high',
            'sound' => 'default',
            // 'notification'     => array('sound' => 'default', 'title' => 'test title','body' => 'test message')
          );
        // Open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
        
        return $message;
    }

    public function makeCall(Request $request) 
    {
        // return $request->all();
        
        // $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;
        
        $company = User::find($request->user_id);
        StallUser::where('user_id', $request->user_id)->update(['activity_status' => 2]);
        $stall_token = $company->web_token;

        $customer = Auth::user();

        $filterRoomId            = str_replace(' ','', strtolower(Auth::user()->name));
        $roomId                  = str_replace('.','', $filterRoomId).time();

        $visitor_name = str_replace(' ','', strtolower($customer->name));
        $exhibitor_name = str_replace(' ','', strtolower($company->name));

        
        if(Auth::user()->role == 'Customer'){

            $chatRoomId = $visitor_name.Auth::user()->id.$exhibitor_name.$company->id;
        }

        if(Auth::user()->role == 'Company'){

            $chatRoomId = $exhibitor_name.$company->id.$visitor_name.Auth::user()->id;

        }

        // return $chatRoomId;


        $chat = Chat::create([
            'company_id'    => $request->company_id,
            'stall_id'      => $request->stall_id,
            'chat_time'     => Carbon::now(),
            'message'       => $request->chat_message,
            'chat_room_id'  => $chatRoomId,
            'missed_call'   => 1,
            'message_class' => 'me',
            'receiver_id'   => $customer->id,
            'user_id'       => $customer->id,
            'user_name'     => $customer->name,
            'user_photo'    => 'public/images/user/'.$customer->photo,
        ]);


        $check = ChatUser::where('receiver_id', $company->id)->where('user_id', $customer->id)->exists();

        if($check == false){

            ChatUser::create([
                'company_id'    => $request->company_id,
                'stall_id'      => $request->stall_id,
                'receiver_id'   => $company->id,
                'chat_room_id'  =>  $chatRoomId,
                'user_id'       => $customer->id,
                'user_name'     => $customer->name,
                'online_status' => 1,
                'user_photo'    => 'public/images/user/'.$customer->photo,
            ]);

        } else {

            $check = ChatUser::where('receiver_id', $customer->id)->where('user_id', $company->id)->update([
                'company_id'    => $request->company_id,
                'stall_id'      => $request->stall_id,  
                'chat_room_id'  =>  $chatRoomId,
                'user_photo'    => 'public/images/user/'.$company->photo,
            ]);

        }

        $message = [
            
            'call_state'         => 1,
            'call_status'        => 0,
            'call_type'          => $request->call_type,
            'roomId'             => $roomId,
            'company_user_token' => $stall_token,
            'company_id'         => $company->id,
            'customer_id'        => $customer->id,
            'customer_name'      => $customer->name,
            'customer_photo'     => $customer->photo,
            'company_user_name'  => $company->name,
            'company_user_photo' => $company->photo,

        ];

        self::sendTokenResponseToReceiver($message, $stall_token);
        
        return $message;
    }
    public function receiveCall(Request $request)
    {
    //    return $request->all();
        $customer_id = $request->customer_id; 
        $customer = User::find($customer_id);

        $company = Auth::user();
        
        $customer_token = $customer->web_token;


        $visitorName = str_replace(' ','', strtolower($customer->name));
        $exhibitorName = str_replace(' ','', strtolower($company->name));

        if(Auth::user()->role == 'Customer'){

            $chatRoomId = $exhibitorName.Auth::user()->id.$visitorName.$customer->id;

        }

        if(Auth::user()->role == 'Company'){
            
          $chatRoomId = $exhibitorName.Auth::user()->id.$visitorName.$customer->id;

        }

        
        Chat::where('chat_room_id', $chatRoomId)->update(['missed_call' => null]);

    

        $check = ChatUser::where('receiver_id', $customer->id)->where('user_id', $company->id)->exists();



        if($check == false){

            ChatUser::create([
                'company_id'    => $company->id,
                'stall_id'      => $request->stall_id,
                'receiver_id'   => $company->id,
                'chat_room_id'  => $chatRoomId,
                'user_id'       => $customer->id,
                'user_name'     => $customer->name,
                'online_status' => 1,
                'user_photo'    => 'public/images/user/'.$customer->photo,
            ]);

        } else {

            $check = ChatUser::where('receiver_id', $customer->id)->where('user_id', $company->id)->update([
                'company_id'    => $company->id,
                'stall_id'      => $request->stall_id,  
                'chat_room_id'  => $chatRoomId,
                'user_photo'    => 'public/images/user/'.$company->photo,
            ]);

        }

        $message = [
            'call_state'  => 1,
            'call_status' => 'received',
            'company_user_token' => $customer_token
        ]; 

        self::sendTokenResponseToReceiver($message, $customer_token);

        return $message;
    }
    public function joinCall(Request $request)
    {

    }
    public function cancelIncomingCall(Request $request)
    {
        
        $customer_id = $request->customer_id; 
        $customer = User::find($customer_id);
        
        $customer_token = $customer->web_token;
        StallUser::where('user_id', $request->user_id)->update(['activity_status' => 1]);
        $message = [
            'call_state' => 2
        ]; 

        self::sendTokenResponseToReceiver($message, $customer_token);

        return $message;
    }
    public function cancelOutgoingCall(Request $request)
    {
        // return $request->all();
        // $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;
        $company = User::find($request->user_id);

        StallUser::where('user_id', $request->user_id)->update(['activity_status' => 1]);
        

        $message = [
            'call_state'     => 2
        ];

        self::sendTokenResponseToReceiver($message, $company->web_token);
        
        return $message;

    }
}
