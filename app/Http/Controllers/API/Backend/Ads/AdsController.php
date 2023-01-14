<?php

namespace App\Http\Controllers\API\Backend\Ads;

use Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Ads\AdsResource;
use App\Models\Ads\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Ads::orderBy('id', 'desc')->paginate($dataSorting):Ads::where(function($query) use($search){
            $query->orWhere('ads_type', 'LIKE', "%{$search}%");
                 
           })->orderBy('id', 'desc')->paginate($dataSorting);
           
        $Ads      = Ads     ::all();
        return AdsResource::collection($data)->additional([
            'Ads'      => $Ads,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $fileName = Helper::imgProcess($request,'image','', '', 'images/Ads', 'store', Ads::class);  
        $data = $request->except(['image']);
        $data['image'] = $fileName;
        $Ads = Ads::insert($data);
        return response()->json([
            'status'  => 'success',
            'message' => 'Ads has been created!',
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
        $Ads = Ads::find($id);
        return new AdsResource($Ads);
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
       
        $fileName = Helper::imgProcess($request,'image',$request->name, $id, 'images/Ads', 'update', Ads::class);  

        $data                   = $request->all();
        $data['image']     = $fileName; 
        $data = Ads::find($id)->update($data);
      
        if($data){
            return response()->json([
                'status'  => 'success',
                'message' => 'Ads has been updated!',
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
        $delete = Ads::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Ads  has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
