<?php

namespace App\Http\Controllers\API\Backend\Webinar;

use Helper;
use Illuminate\Http\Request;
use App\Models\Webinar\Webinar;
use App\Models\Webinar\WebinarUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Webinar\WebinarUserResource;

class WebinarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?WebinarUser::orderBy('id', 'desc')->paginate($dataSorting):WebinarUser::where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('webinar_id', 'LIKE', "%{$search}%")
                  ->orWhere('designation', 'LIKE', "%{$search}%");
           })->orderBy('id', 'desc')->paginate($dataSorting);
           
        $webinarList      = Webinar     ::all();
        return WebinarUserResource::collection($data)->additional([
            'webinarList'      => $webinarList,
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



        $fileName = Helper::imgProcess($request,'image','', '', 'images/webinarUser', 'store', WebinarUser::class);  
        $data = $request->except(['image']);
        $data['image'] = $fileName;
        $webinarUser = WebinarUser::insert($data);
        return response()->json([
            'status'  => 'success',
            'message' => 'Webinar user has been created!',
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
        $webinarUser = WebinarUser::find($id);
        return new WebinarUserResource($webinarUser);
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
        
        $fileName = Helper::imgProcess($request,'image',$request->name, $id, 'images/webinarUser', 'update', WebinarUser::class);  

        $data                   = $request->all();
        $data['image']     = $fileName; 
        $data = WebinarUser::find($id)->update($data);
      
        if($data){
            return response()->json([
                'status'  => 'success',
                'message' => 'Webinar user has been updated!',
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
        $delete = WebinarUser::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Webinar user has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
