<?php

namespace App\Http\Controllers\API\Backend\EventCategory;

use Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventCategory\EventCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\Backend\EventCategory\EventCategoryRequest;
use App\Http\Resources\Backend\EventCategory\EventCategoryResource;

class EventCategoryController extends Controller
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
        $data =$search == 'false'?EventCategory::orderBy('id', 'desc')->paginate($dataSorting):EventCategory::where(function($query) use($search){
            $query->orWhere('event_category_name', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return EventCategoryResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.

     * @param EventCategoryRequest $request
     * @return EventCategoryResource
     */
    public function store(EventCategoryRequest $request)
    {
    
        $validated = $request->validated();
        
        $fileName = Helper::imgProcess($request,'event_cat_img',$request->event_category_name, '', 'frontend/assets/event-category', 'store', EventCategory::class);  
        
        $data = $request->all();
        $data['event_cat_img'] = $fileName;
        $event_category = EventCategory::insert($data);
       
        if ($event_category){
            return response()->json([
                'status' => 'success',
                'message' => 'event_category has been created!'
            ]);
        }

        
    }

    /**
     * Display the specified resource.
     *

     * @param int $id
     * @return EventCategoryResource
     */
    public function show(int $id)
    {
        $event_category = EventCategory::findOrFail($id);
        return new EventCategoryResource($event_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventCategoryRequest $request
     * @param int $id
     * @return EventCategoryResource
     */
    public function update(EventCategoryRequest $request, int $id)
    {
       $fileName = Helper::imgProcess($request,'event_cat_img',$request->name, '', 'frontend/assets/event-category', 'update', EventCategory::class);
       $data = $request->all();
       $data['event_cat_img'] = $fileName;
        $event_category = EventCategory::findOrFail($id)->update($data);
       
        if ($event_category){
            return response()->json([
                'status' => 'success',
                'message' => 'EventCategory has been updated!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *

     * @param int $id
     * @return EventCategoryResource
     */
    public function destroy(int $id)
    {
        $event_category = EventCategory::findOrFail($id);
        if ($event_category->delete()){
            return response()->json([
                'status' => 'danger',
                'message' => 'event_category has been deleted!'
            ]);
        }
       
    }
}
