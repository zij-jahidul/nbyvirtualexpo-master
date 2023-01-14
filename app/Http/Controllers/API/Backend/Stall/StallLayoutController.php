<?php

namespace App\Http\Controllers\API\Backend\Stall;

use Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StallLayoutRequest;
use App\Http\Resources\Backend\Stall\StallLayoutResource;
use App\Models\Company\CompanyUser;
use App\Models\Company\Company;
use App\Models\EventCategory\EventSubCategory;
use App\Models\Stall\StallLayout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StallLayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;

        $event_sub_category_id = Company::where('id', $companyId)->pluck('event_sub_category_id');

        $event_sub_categories = EventSubCategory::where('id',$event_sub_category_id)->select('event_sub_category_name', 'id')->get();
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        
        $data =$search == 'false'?StallLayout::where('company_id', $companyId)->orderBy('id', 'desc')->paginate($dataSorting):StallLayout::where('company_id', $companyId)->where(function($query) use($search){
            $query->orWhere('layout_name', 'LIKE', "%{$search}%")
            ->orWhere('layout_color', 'LIKE', "%{$search}%")
            ->orWhere('layout_size', 'LIKE', "%{$search}%")
            ->orWhere('layout_description', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $companies = Company::where('id', $companyId)->select('company_name', 'id')->get();

        return  StallLayoutResource::collection($data)->additional(['event_sub_category'=>$event_sub_categories, 'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StallLayoutRequest $request
     * @return JsonResponse
     */
    public function store(StallLayoutRequest $request)
    {
          
        $data= $request->except(['logo_image', 'stall']);
            $fileName = Helper::imgProcess($request,'layout_img','', '', 'images/uploads/stall', 'store', StallLayout::class);

           // $data['layout_img']= $fileName;
            $data['status']= '1';
            $data['created_by'] = Auth::user()->id;

          StallLayout::create($data);
            return response()->json([
                'status'  => 'success',
                'message' => 'Stall Layout has been created!',
                'icon'    => 'check',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return StallLayoutResource
     */
    public function show(int $id): StallLayoutResource
    {
        $stall_layout = StallLayout::findOrFail($id);
        return new StallLayoutResource($stall_layout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StallLayoutRequest $request
     * @param int $id
     * @return StallLayoutResource
     */
    public function update(Request $request, int $id): StallLayoutResource
    {
        $stall_layout = StallLayout::findOrFail($id);
        $stall_layout->event_sub_category_id    = $request->event_sub_category_id;
        $stall_layout->layout_name              = $request->layout_name;
        $stall_layout->layout_img               =  $request->layout_img;
        $stall_layout->layout_color             = $request->layout_color;
        $stall_layout->layout_size              = $request->layout_size;
        $stall_layout->layout_description       = $request->layout_description;
        $stall_layout->status                   = $request->status;
        $stall_layout->created_by               = $request->created_by;
        $stall_layout->updated_by               = Auth::user()->id;

        if ($stall_layout->save()){
            return new StallLayoutResource($stall_layout);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return StallLayoutResource
     */
    public function destroy(int $id): StallLayoutResource
    {
        $stall_layout = StallLayout::findOrFail($id);
        if ($stall_layout->delete()){
            return new StallLayoutResource($stall_layout);
        }
    }

    public function get_stall_layout_images($id): JsonResponse
    {
        $stall_layout = StallLayout::with('company')->findOrFail($id);
        return \response()->json($stall_layout);
    }
    public function get_stall_layout_images_store(Request $request)
    {

        $stall_layout = StallLayout::where('company_id',$request->company_id)->first();

        $data['layout_img'] = $request->layout_img;
        if ($stall_layout!= null){
            $stall_layout->update($data);
        }else{
            $data1= $request->all();
            $data1['layout_name']= 'Demo';
           StallLayout::create($data1);
        }
    }
    public function get_stall_layout_image($id)
    {
       $layout_image = StallLayout::where('company_id', $id)->first();
       return response()->json($layout_image);
    }
}
