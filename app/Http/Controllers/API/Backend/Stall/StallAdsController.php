<?php

namespace App\Http\Controllers\API\Backend\Stall;

use Auth;
use App\Models\Stall\Stall;
use App\Models\Company\CompanyUser;
use Illuminate\Http\Request;
use App\Models\Stall\StallAds;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Stall\StallAdsResource;
use Helper;

class StallAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;

        $stallId = Stall::where('company_id', $companyId)->first()->id;

        $search = $request->search;


        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?StallAds::where('stall_id', $stallId)->orderBy('id', 'desc')->paginate($dataSorting):StallAds::where('stall_id', $stallId)->where(function($query) use($search){
            // $query->orWhere('image', 'LIKE', "%{$search}%")
            // ->orWhere('adds_position', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);
        
         $stalls = Stall::where('company_id', $companyId)->get();

        return StallAdsResource::collection($data)->additional(['stalls' => $stalls]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fileName = Helper::imgProcess($request,'image','', '', 'images/StallAds', 'store', StallAds::class);  
        $data = $request->except(['image']);
        $data['image'] = $fileName;
        $Ads = StallAds::create($data);
        return response()->json([
            'status'  => 'success',
            'message' => 'Stall Ads has been created!',
            'icon'    => 'check',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
       
        $stall = StallAds::findOrFail($id);
        return new StallAdsResource($stall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $fileName = Helper::imgProcess($request,'image',$request->name, $id, 'images/StallAds', 'update', StallAds::class);  

        $data                   = $request->all();
        $data['image']     = $fileName; 
        $data = StallAds::find($id)->update($data);
      
        if($data){
            return response()->json([
                'status'  => 'success',
                'message' => 'StallAds has been updated!',
                'icon'    => 'check',
            ]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = StallAds::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'StallAds  has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
