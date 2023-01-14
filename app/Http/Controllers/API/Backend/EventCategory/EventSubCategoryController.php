<?php

namespace App\Http\Controllers\API\Backend\EventCategory;

use Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EventCategory\EventCategory;
use App\Models\EventCategory\EventSubCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\Backend\EventCategory\EventSubCategoryRequest;
use App\Http\Resources\Backend\EventCategory\EventSubCategoryResource;

class EventSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?EventSubCategory::orderBy('id', 'desc')->paginate($dataSorting):EventSubCategory::where(function($query) use($search){
            $query->orWhere('event_sub_category_name', 'LIKE', "%{$search}%");
            
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $eventCategory = EventCategory::get();

        return EventSubCategoryResource::collection($data)->additional(['eventCategories' => $eventCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventSubCategoryRequest $request
     * @return EventSubCategoryResource
     */
    public function store(EventSubCategoryRequest $request)
    {
        $validated = $request->validated();
        
        $fileName = Helper::imgProcess($request, 'event_sub_cat_img', $request->event_sub_category_name, '', 'frontend/assets/event-sub-category', 'store', EventSubCategory::class);

        $data = $request->all();

        $data['event_sub_cat_img'] = $fileName;
        $event_sub_category = EventSubCategory::create($data);
    
        if ($event_sub_category){
            return response()->json([
                'status' => 'success',
                'message' => 'EventSubCategory has been created!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return EventSubCategoryResource
     */
    public function show(int $id)
    {
       $event_sub_category = EventSubCategory::findOrFail($id);
       return new EventSubCategoryResource($event_sub_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventSubCategoryRequest $request
     * @param int $id
     * @return EventSubCategoryResource
     */
    public function update(Request $request, int $id)
    {
        $fileName = Helper::imgProcess($request, 'event_sub_cat_img', $request->event_sub_category_name, '', 'frontend/assets/event-sub-category', 'update', EventSubCategory::class);
        $data = $request->all();
        $data['event_sub_cat_img'] = $fileName;
        $event_sub_category = EventSubCategory::findOrFail($id)->update($request->all());
       
        if ($event_sub_category){
            return response()->json([
                'status' => 'success',
                'message' => 'EventSubCategory has been updated!'
            ]);
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return EventSubCategoryResource
     */
    public function destroy(int $id)
    {
        $delete = EventSubCategory::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'EventSubCategory has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
