<?php

namespace App\Http\Controllers\API\Frontend\General;

use Auth;
use Helper;
use App\Models\User;
use App\Models\Ads\Ads;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use App\Models\Stall\StallAds;
use App\Models\Stall\StallUser;
use App\Models\Webinar\Webinar;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use App\Models\EventCategory\EventCategory;
use App\Models\EventCategory\EventSubCategory;
use App\Http\Resources\Backend\Ads\AdsResource;
use App\Http\Resources\Backend\Stall\StallResource;
use App\Http\Resources\Backend\Stall\StallAdsResource;
use App\Http\Resources\Backend\Stall\StallUserResource;
use App\Http\Resources\Backend\Webinar\WebinarResource;
use App\Http\Resources\Frontend\AllCategory\ESCResource;
use App\Http\Resources\Backend\EventCategory\EventCategoryResource;
use App\Http\Resources\Backend\EventCategory\EventSubCategoryResource;

class GeneralController extends Controller
{
    public function companyUser(Request $request)
    {
        $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;
        $user = User::find($userId);
        return response()->json($user);
    }

    public function getAdminUser()
    {
        $user = User::whereIn('role', ['Secretary','QueryAssistant'])->select('id', 'name', 'photo', 'role', 'email', 'web_token')->get();
        return response()->json($user);
    }



    public function updateUserProfile(Request $request)
    {
        
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255',
            'password'  => 'confirmed'
        ]);

        $fileName = Helper::imgProcess($request,'photo',$request->name, $request->user_id, 'images/user', 'update', User::class); 
        if($request->password === null){

            User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo'   => $fileName

            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Your Profile is udpated'
            ]);

           } else {

            User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo'   => $fileName
    
                ]);
         return response()->json([
             'status' => 'success',
             'message' => 'Your Profile is udpated'
         ]);
        }
        
    }


    public function eventRoomLive(){
        $ads = Ads::where('ads_position', 12)->first();
        return response()->json($ads);
    }

    public function webinarLiveSession()
    {
        $data = Webinar::paginate(10);
        return WebinarResource::collection($data);
    }

    
    public function eventCategory()
    {
        $eventCategory = EventCategory::all();
        return EventCategoryResource::collection($eventCategory);
    }

    public function eventSubCategory()
    {
        $eventSubCategory = EventSubCategory::all();
        return EventSubCategoryResource::collection($eventSubCategory);
    }

    public function subCategory()
    {
        $data = EventSubCategory::all();
        return ESCResource::collection($data);
    }

    public function getStall(Request $request)
    {
        $data = Stall::where('id', $request->stall_id)->first();
        return new StallResource($data);
    }

    public function getLobbyAds(){
        $ads = Ads::all();
        return AdsResource::collection($ads);
    }

    public function headerAds(){
        $headerAds = Ads::where('ads_position',1)->select('video_link')->first();
        return response()->json($headerAds);
    }

    // public function headerAds(){
    //     $headerAds = Ads::where('ads_position',1)->select('video_link')->first();
    //     return response()->json($headerAds);
    // }

    public function getExhibitionAds(){
        $ads = Ads::all();
        return AdsResource::collection($ads);
    }

    public function showAdsstall(Request $request){
        $stallads = StallAds::where('stall_id', $request->stall_id)->get();
        return StallAdsResource::collection($stallads);
    }

    public function searchStalls(){
        $searchstalls = Stall::all();
        return StallResource::collection($searchstalls);
    }

}
