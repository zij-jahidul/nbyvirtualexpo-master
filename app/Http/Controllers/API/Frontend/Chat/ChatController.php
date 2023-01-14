<?php

namespace App\Http\Controllers\API\Frontend\Chat;

use Helper;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ChatUser;
use App\Models\Chat\Chat;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use App\Models\Stall\StallUser;
use App\Models\Chat\HelpdeskChat;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat\HelpdeskChatUser;
use App\Http\Resources\Frontend\Chat\ChatUserResource;
use App\Http\Resources\Backend\Stall\StallUserResource;

class ChatController extends Controller
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
    
    public function sendMessage(Request $request)
    {
        // return $request->all();
        $fileName = Helper::imgProcessNameOrigin($request, 'chat_document', '', '', 'images/chat', 'store', Chat::class);
        if($fileName != null) {

            $is_file = 1;

        } else {

            $is_file = 0;
        }

        $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;
        $company_user = User::find($userId);
        $stall_token = $company_user->web_token;

        $customer = Auth::user();

        $filterRoomId            = str_replace(' ','', strtolower(Auth::user()->name));
        $roomId_one                  = str_replace('.','', $filterRoomId);

        $filterRoomId            = str_replace(' ','', strtolower($company_user->name));
        $roomId_two                  = str_replace('.','', $filterRoomId);

        // room_id = visitor_name+id + exhibitor_name+id 

        $roomId = $roomId_one.Auth::user()->id.$roomId_two.$company_user->id;




        $chat = Chat::create([
            'company_id'    => $request->company_id,
            'stall_id'      => $request->stall_id,
            'chat_time'     => Carbon::now(),
            'message'       => $request->chat_message,
            'chat_document' => json_encode($fileName),
            'chat_room_id'  => $roomId,
            'message_class' => 'me',
            'receiver_id'   => $customer->id,
            'user_id'       => $request->user_id,
            'user_name'     => $request->user_name,
            'user_photo'    => 'public/images/user/'.$request->user_photo,
        ]);

        $check = ChatUser::where('receiver_id', $company_user->id)->where('user_id', $customer->id)->exists();

        if($check == false){

            ChatUser::create([
                'company_id'    => $request->company_id,
                'stall_id'    =>  $request->stall_id,
                'receiver_id'   => $company_user->id,
                'user_id'       => $customer->id,
                'chat_room_id'  => $roomId,
                'user_name'     => $customer->name,
                'online_status' => 1,
                'user_photo'    => 'public/images/user/'.$customer->photo,
            ]);

            // ChatUser::create([
            //     'company_id'    => $request->company_id,
            //     'stall_id'    =>  $request->stall_id,
            //     'receiver_id'   => $customer->id,
            //     'user_id'       => $company_user->id,
            //     'chat_room_id'  => $roomId,
            //     'user_name'     => $company_user->name,
            //     'online_status' => 1,
            //     'user_photo'    => 'public/images/user/'.$company_user->photo,
            // ]);

        } else {

            $check = ChatUser::where('receiver_id', $company_user->id)->where('user_id', $customer->id)->update([
                'company_id'    => $request->company_id,
                'stall_id'    =>  $request->stall_id,
                'chat_room_id'  => $roomId,
                'user_photo'    => 'public/images/user/'.$request->user_photo,
            ]);

        }


        $message = [
            'id'                 => $chat->id,
            'call_state'         => 3,
            'call_status'        => 0,
            'chat_document'      => json_encode($fileName),
            'is_file'            => $is_file,
            'chat_room_id'       => $roomId,
            'company_user_token' => $stall_token,
            'stall_id'           => $request->stall_id,
            'company_id'         => $request->company_id,
            'company_user_id'    => $company_user->id,
            'customer_id'        => $customer->id,
            'customer_name'      => 'public/images/user/'.$customer->name,
            'customer_photo'     => $customer->photo,
            'company_user_name'  => $company_user->name,
            'company_user_photo' => $company_user->photo,
            'chat_message'       => $request->chat_message,
            'message_class'      => $request->message_class,
            'user_id'            => $request->user_id,
            'user_name'          => $request->user_name,
            'user_photo'         => 'public/images/user/'.$request->user_photo

        ];

      

        self::sendTokenResponseToReceiver($message, $stall_token);
        
        return $message;
    }
    public function receiveMessage(Request $request)
    {
        // return $request->all();
        $fileName = Helper::imgProcessNameOrigin($request, 'chat_document', '', '', 'images/chat', 'store', Chat::class);

        if($fileName != null) {

            $is_file = 1;

        } else {

            $is_file = 0;
        }

        $customer_id = $request->customer_id; 
        $customer = User::find($customer_id);
        $company_user = Auth::user();

        $customer_token = $customer->web_token;

        $chat_time = Carbon::now()->diffForHumans();


        $filterRoomId = str_replace(' ','', strtolower($customer->name));
        $roomId_one   = str_replace('.','', $filterRoomId);

        $filterRoomId = str_replace(' ','', strtolower($company_user->name));
        $roomId_two   = str_replace('.','', $filterRoomId);

        $roomId = $roomId_one.$customer->id.$roomId_two.$company_user->id;


        $chat = Chat::create([
            'company_id'    => $request->company_id,
            'stall_id'      => $request->stall_id,
            'chat_time'     => Carbon::now(),
            'message'       => $request->chat_message,
            'chat_document' => json_encode($fileName),
            'chat_room_id'  => $roomId,
            'message_class' => 'you',
            'receiver_id'   => $customer->id,
            'user_id'       => $request->user_id,
            'user_name'     => $request->user_name,
            'user_photo'     => 'public/images/user/'.$request->user_photo,
        ]);

        $check = ChatUser::where('receiver_id', $customer->id)->where('user_id', $company_user->id)->exists();

        if($check == false){

            ChatUser::create([
                'company_id'    => $request->company_id,
                'stall_id'      => $request->stall_id,
                'receiver_id'   => $customer->id,
                'chat_room_id'  => $roomId,
                'user_id'       => $company_user->id,
                'user_name'     => $company_user->name,
                'online_status' => 1,
                'user_photo'    => 'public/images/user/'.$company_user->photo,
            ]);

        } else {

            $check = ChatUser::where('receiver_id', $customer->id)->where('user_id', $company_user->id)->update([
                'company_id'    => $request->company_id,
                'stall_id'      => $request->stall_id,  
                'chat_room_id'  => $roomId,
                'user_photo'    => 'public/images/user/'.$company_user->photo,
            ]);

        }

        $message = [
            'id'                 => $chat->id,
            'call_state'         => 3,
            'call_status'        => 'received',
            'company_id'         => $request->company_id,
            'stall_id'           => $request->stall_id,
            'company_user_id'    => $company_user->id,
            'company_user_token' => $company_user->web_token,
            'chat_message'       => $request->chat_message,
            'chat_document'      => json_encode($fileName),
            'is_file'            => $is_file,
            'customer_id'        => $customer->id,
            'chat_room_id'       => $roomId,
            'customer_name'      => $customer->name,
            'customer_photo'     => Helper::publicUrl('/images/user/'.$customer->photo),
            'chat_time'          => $chat_time,
            'compay_user_name'   => $company_user->name,
            'company_user_photo' => 'public/images/user/'.$company_user->photo,
            'message_class'      => $request->message_class,
            'user_id'            => $request->user_id,
            'user_name'          => $request->user_name,
            'user_photo'         => 'public/images/user/'.$request->user_photo
        ]; 


        self::sendTokenResponseToReceiver($message, $customer_token);

        return $message;

    }

    public function cancelIncomingMessage(Request $request)
    {
       
        $customer_id = $request->customer_id; 
        $customer = User::find($customer_id);

        $customer_token = $customer->web_token;

        $message = [
            'call_state' => 4
        ]; 

        self::sendTokenResponseToReceiver($message, $customer_token);

        return $message;
    }
    
    public function cancelOutgoingMessage(Request $request)
    {
        $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;
        $company = User::find($userId);
        

        $message = [
            'call_state'     => 4
        ];

        self::sendTokenResponseToReceiver($message, $company_user->web_token);
        
        return $message;
    }
    
    public function helpDeskSendMessage(Request $request)
    {
        //  return $request->all();

        $fileName = Helper::imgProcessNameOrigin($request, 'chat_document', '', '', 'images/helpdesk-chat', 'store', HelpdeskChat::class);
        // return $request->all();
        if($fileName != null) {

            $is_file = 1;

        } else {

            $is_file = 0;
        }


         $user  = User::find($request->authority_id);
         $adminToken = $user->web_token;
 
         $guestUser = Auth::user();
 
         $filterOne = str_replace(' ','', strtolower(Auth::user()->name));
         $nameOne   = str_replace('.','', $filterOne);

         $filterTwo = str_replace(' ','', strtolower($user->name));
         $nameTwo   = str_replace('.','', $filterTwo);

        $roomId = $nameOne.$nameTwo.$user->id.$guestUser->id;


         $chat_time = Carbon::now()->diffForHumans();

         $chat = HelpdeskChat::create([
            'chat_time'     => Carbon::now(),
            'message'       => $request->chat_message,
            'helpdesk_room_id'=>  $roomId,
            'chat_document' => json_encode($fileName),
            'message_class' => 'me',
            'receiver_id'   => $guestUser->id,
            'user_id'       => $guestUser->id,
            'user_name'     => $guestUser->name,
            'user_photo'    => 'public/images/user/'.$guestUser->photo,
        ]);

        $check = HelpdeskChatUser::where('receiver_id', $user->id)->where('user_id', $guestUser->id)->exists();

        if($check == false){

            HelpdeskChatUser::create([
                'receiver_id'   => $user->id,
                'helpdesk_room_id'=>  $roomId,
                'user_id'       => $guestUser->id,
                'user_name'     => $guestUser->name,
                'online_status' => 1,
                'user_photo'    => 'public/images/user/'.$guestUser->photo,
            ]);

        } else {

            $check = HelpdeskChatUser::where('receiver_id', $user->id)->where('user_id', $guestUser->id)->update([
                'user_photo'    => 'public/images/user/'.$guestUser->photo,
                'helpdesk_room_id'=>  $roomId,
            ]);

        }


         $message = [
             'id'               => $chat->id,
             'call_state'       => 5,
             'chat_message'     => $request->chat_message,
             'chat_document' => json_encode($fileName),
             'sender_id'        => $guestUser->id,
             'helpdesk_room_id'=>  $roomId,
             'sender_role'      => $guestUser->role,
             'sender_name'      => $guestUser->name,
             'sender_email'     => $guestUser->email,
             'sender_photo'     => 'public/images/user/'.$guestUser->photo,
             'sender_web_token' => $guestUser->web_token,
             'message_class'      => $request->message_class,
             'receiver_id'  => $guestUser->id,
             'user_id'      => $guestUser->id,
             'user_name'    => $guestUser->name,
             'user_photo'   => 'public/images/user/'.$guestUser->photo,
             'user_email'   => $guestUser->email,
             'user_role'    => $guestUser->role,
 
         ];
 
         self::sendTokenResponseToReceiver($message, $adminToken);
         
         return $message;
   
    }

    public function helpDeskReceiveMessage(Request $request)
    {
        // return $request->all();
        $fileName = Helper::imgProcessNameOrigin($request, 'chat_document', '', '', 'images/helpdesk-chat', 'store', HelpdeskChat::class);
        // return $request->all();
        if($fileName != null) {

            $is_file = 1;

        } else {

            $is_file = 0;
        }

         $guest_user_id = $request->guest_user_id; 
         $guestUser = User::find($guest_user_id);
 
         $adminUser = Auth::user();
  
         $guest_user_token = $guestUser->web_token;


         $filterOne = str_replace(' ','', strtolower($guestUser->name));
         $nameOne   = str_replace('.','', $filterOne);

         $filterTwo = str_replace(' ','', strtolower($adminUser->name));
         $nameTwo   = str_replace('.','', $filterTwo);

         $roomId = $nameOne.$nameTwo.$adminUser->id.$guestUser->id;



         $chat = HelpdeskChat::create([
            'chat_time'     => Carbon::now(),
            'message'       => $request->chat_message,
            'chat_document' => json_encode($fileName),
            'helpdesk_room_id'=>  $roomId,
            'message_class' => 'you',
            'receiver_id'   => $guestUser->id,
            'user_id'       => $adminUser->id,
            'user_name'     => $adminUser->name,
            'user_photo'     => 'public/images/user/'.$adminUser->photo,
        ]);

        $check = HelpdeskChatUser::where('receiver_id', $guestUser->id)->where('user_id', $adminUser->id)->exists();

        if($check == false){

            HelpdeskChatUser::create([
                'receiver_id'   => $guestUser->id,
                'user_id'       => $adminUser->id,
                'user_name'     => $adminUser->name,
                'helpdesk_room_id'=>  $roomId,
                'online_status' => 1,
                'user_photo'    => 'public/images/user/'.$adminUser->photo,
            ]);

        } else {

            $check = HelpdeskChatUser::where('receiver_id', $guestUser->id)->where('user_id', $adminUser->id)->update([
                'user_photo'    => 'public/images/user/'.$adminUser->photo,
            ]);

        }


         $chat_time = Carbon::now()->diffForHumans();
         $message = [
             'call_state'         => 5,
             'call_status'        => 'received',
             'chat_message'     => $request->chat_message,
             'chat_document'    => json_encode($fileName),
             'helpdesk_room_id'=>  $roomId,
             'sender_id'        => $adminUser->id,
             'sender_role'      => $adminUser->role,
             'sender_name'      => $adminUser->name,
             'sender_email'     => $adminUser->email,
             'sender_photo'     => 'public/images/user/'.$adminUser->photo,
             'sender_web_token' => $adminUser->web_token,
             'receiver_id'      => $guestUser->id,
             'user_id'      => $adminUser->id,
             'user_name'    => $adminUser->name,
             'user_photo'   => 'public/images/user/'.$adminUser->photo,
             'user_email'   => $adminUser->email,
             'user_role'    => $adminUser->role
            
         ]; 
 
         self::sendTokenResponseToReceiver($message, $guest_user_token);
 
         return $message;
    }


    public function getHelpdeskChatUser(Request $request){

        // return $request->all();
        $chatUser = HelpdeskChatUser::where('receiver_id', Auth::user()->id)->get();

        // return response()->json($chatUser);

        // $users = ChatUser::where('receiver_id', $request->user_id)->get();
        
        foreach ($chatUser as $key => $user) {

            if(Auth::user()->role == 'Customer' || Auth::user()->role == 'Company'){
                // return $user->user_id;
                $chatUser[$key]['message_reading'] = HelpdeskChat::where('user_id', Auth::user()->id)->where('receiver_id', Auth::user()->id)->where('helpdesk_room_id', $user->helpdesk_room_id)->where('message_reading', null)->count();
                
                $chatUser[$key]['message'] = HelpdeskChat::where('receiver_id', Auth::user()->id)->where('helpdesk_room_id', $user->helpdesk_room_id)->get();
                
            } else {

                $chatUser[$key]['message_reading'] = HelpdeskChat::where('user_id', Auth::user()->id)->where('helpdesk_room_id', $user->helpdesk_room_id)->where('message_reading', null)->count();

            }
        }

            return response()->json($chatUser);


    }

    public function createAuthorityChatUser(Request $request)
    {
        // return $request->all();
        $visitor = Auth::user();
        $authorityUsers = $request->all();

        

        // $check = HelpdeskChatUser::where('user_id', $visitor->id)->whereIn

        foreach ($authorityUsers as $key => $user) {
            
        for ($i=0; $i < count($authorityUsers) ; $i++) { 
            
            $check = HelpdeskChatUser::where('user_id', $user['id'])->where('receiver_id', $visitor->id)->exists();
               
            $filterOne = str_replace(' ','', strtolower($visitor->name));
            $nameOne   = str_replace('.','', $filterOne);
   
            $filterTwo = str_replace(' ','', strtolower($user['name']));
            $nameTwo   = str_replace('.','', $filterTwo);
   
            $roomId = $nameOne.$nameTwo.$user['id'].$visitor->id;
            
            if($check == false){
                  
                    $chatUser =  HelpdeskChatUser::create([
                            'receiver_id'      => $visitor->id,
                            'user_id'          => $user['id'],
                            'helpdesk_room_id'=>  $roomId,
                            'user_name'        => $user['name'],
                            'user_photo'       => 'public/images/user/'.$user['photo'],
                            'message_class'    => 'me',
                            // 'online_status' => 1
                        ]); 

                } else {
                
                    $chatUser =  HelpdeskChatUser::where('user_id', $user['id'])->where('receiver_id', $visitor->id)->update([
                        'user_name'        => $user['name'],
                        'user_photo'       => 'public/images/user/'.$user['photo'],
                        'helpdesk_room_id'=>  $roomId,
                        'message_class'    => 'me',
                        // 'online_status' => 1
                    ]);

                   

                }
            
        }

        }
                

        $userData = HelpdeskChatUser::where('receiver_id', $visitor->id)->get();

        return response()->json($userData);
    }

    public function getHelpdeskPairMessage(Request $request)
    {
    //    return $request->all();
        if(Auth::user()->role == 'Customer' || Auth::user()->role == 'Company'){

            $chat = HelpdeskChat::where('user_id', $request->user_id)->where('receiver_id', $request->receiver_id)->update([
             'message_reading' => 1
             ]); 
 
         } else {
 
             HelpdeskChat::where('user_id', $request->receiver_id)->where('receiver_id', $request->user_id)->update([
                 'message_reading' => 1
                 ]); 
         }
 
        //  $user_id = Auth::user()->role ==='Customer'?Auth::user()->id:$request->user_id;
 
         // $user_id = Auth::user()->role ==='Customer'?Auth::user()->id:$request->user_id;
         
         $chat = HelpdeskChat::where('helpdesk_room_id', $request->helpdesk_room_id)->get();
 
         return response()->json($chat);

    }


    public function getPairMessage(Request $request)
    {
 
        // return $request->all();
        if(Auth::user()->role == 'Customer'){

                Chat::where('user_id', $request->receiver_id)->where('chat_room_id', $request->chat_room_id)->where('stall_id', $request->stall_id)->update([
                    'message_reading' => 1,
                    ]); 

                Chat::where('user_id', $request->receiver_id)->where('chat_room_id', $request->chat_room_id)->where('stall_id', $request->stall_id)->where('missed_call', 1)->delete();

                $chat = Chat::where('chat_room_id', $request->chat_room_id)->get();
                
                return response()->json($chat);

            } 
            
            if(Auth::user()->role == 'Company') {

                Chat::where('user_id', $request->receiver_id)->where('chat_room_id', $request->chat_room_id)->where('stall_id', $request->stall_id)->update([
                    'message_reading' => 1,
                    ]); 

                Chat::where('user_id', $request->receiver_id)->where('chat_room_id', $request->chat_room_id)->where('stall_id', $request->stall_id)->where('missed_call', 1)->delete();
                
                $chat = Chat::where('chat_room_id', $request->chat_room_id)->get();
               
                return response()->json($chat);
            } 

    }

    public function chatUser(Request $request)
    {
        // return $request->all();

        if(Auth::user()->role == 'Customer'){

            $check = ChatUser::where('user_id', $request->user_id)->exists();

            if($check){

                $users = ChatUser::where('receiver_id', $request->user_id)->get();   

                foreach ($users as $key => $user) {
                
                    $users[$key]['message_reading'] = Chat::where('user_id', $user->user_id)->where('chat_room_id', $user->chat_room_id)->whereNull('message_reading')->count();

                    $users[$key]['missed_call_count'] = Chat::where('user_id', $user->user_id)->where('chat_room_id', $user->chat_room_id)->where('missed_call', 1)->count();
                    $users[$key]['message'] = Chat::where('chat_room_id', $user->chat_room_id)->get();

                }

                return response()->json($users);

            } else {

                $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;
                $company_user = User::find($userId);
                

                $customer = Auth::user();

                $filterRoomId            = str_replace(' ','', strtolower(Auth::user()->name));
                $roomId_one                  = str_replace('.','', $filterRoomId);

                $filterRoomId            = str_replace(' ','', strtolower($company_user->name));
                $roomId_two                  = str_replace('.','', $filterRoomId);

                // room_id = visitor_name+id + exhibitor_name+id 

                $roomId = $roomId_one.Auth::user()->id.$roomId_two.$company_user->id;

                $check = ChatUser::where('receiver_id', $company_user->id)->where('user_id', $customer->id)->exists();

                if($check == false){

                    ChatUser::create([
                        'company_id'    => $request->company_id,
                        'stall_id'      =>  $request->stall_id,
                        'receiver_id'   => $company_user->id,
                        'user_id'       => $customer->id,
                        'chat_room_id'  => $roomId,
                        'user_name'     => $customer->name,
                        'online_status' => 1,
                        'user_photo'    => 'public/images/user/'.@$customer->photo,
                    ]);

                }

                $users = ChatUser::where('receiver_id', $request->user_id)->get();   

                foreach ($users as $key => $user) {
                
                    $users[$key]['message_reading'] = Chat::where('user_id', $user->user_id)->where('chat_room_id', $user->chat_room_id)->whereNull('message_reading')->count();

                    $users[$key]['missed_call_count'] = Chat::where('user_id', $user->user_id)->where('chat_room_id', $user->chat_room_id)->where('missed_call', 1)->count();
                    $users[$key]['message'] = Chat::where('chat_room_id', $user->chat_room_id)->get();

                }

                return response()->json($users);
            }

        } 
        
        if(Auth::user()->role == 'Company') {
            // return $request->user_id;
            $check = ChatUser::where('user_id', $request->user_id)->exists();
            if($check){
            $users = ChatUser::where('receiver_id', $request->user_id)->get();

            foreach ($users as $key => $user) {
            

                $users[$key]['message_reading'] = Chat::where('user_id', $user->user_id)->where('chat_room_id', $user->chat_room_id)->whereNull('message_reading')->count();

                $users[$key]['missed_call_count'] = Chat::where('user_id', $user->user_id)->where('chat_room_id', $user->chat_room_id)->where('missed_call', 1)->count();
                $users[$key]['message'] = Chat::where('chat_room_id', $user->chat_room_id)->get();


                }

                return response()->json($users);
            }

        }
   
    }

    public function loadUser(Request $request)
    {
        $check = ChatUser::where('user_id', $request->user_id)->exists();
        if($check){
            $chatUser = ChatUser::where('user_id', $request->user_id)->first();

            $users = ChatUser::where('receiver_id', $chatUser->user_id)->get();
            
            return response()->json($users);

        }
    }

    public function getStallUser(Request $request){

        // return $request->all();
        if(Auth::user()->role == 'Customer'){

            $userId = StallUser::where('company_id', $request->company_id)
            ->where('stall_id', $request->stall_id)->pluck('user_id');

            $user = User::whereIn('id', $userId)->get();

            return StallUserResource::collection($user);

        }

        if(Auth::user()->role == 'Company'){

            $userIds = ChatUser::where('receiver_id', $request->user_id)->pluck('user_id');
            $users = User::whereIn('id', $userIds) ->get();
            return ChatUserResource::collection($users);

        }
        
    }

    public function deleteChatMessage(Request $request)
    {
        // return $request->all();
        Chat::where('id', $request->id)->where('user_id', Auth::user()->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Message has been deleted'
        ]);
    }

    public function deleteAllConversation(Request $request)
    {
        Chat::where('user_id', $request->receiver_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'All conversation has been deleted'
        ]);
    }


      public function  deleteHelpdeskMessage(Request $request)
      {
          HelpdeskChat::where('id', $request->id)->delete();
          return response()->json([
            'status' => 'success',
            'message' => 'Message has been deleted'
        ]);
      }

      public function  deleteAllHelpdeskConversation(Request $request)
      {
        HelpdeskChat::where('user_id', $request->receiver_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'All conversation has been deleted'
        ]);
      }

}
