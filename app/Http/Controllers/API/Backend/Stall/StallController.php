<?php

namespace App\Http\Controllers\API\Backend\Stall;

use Auth;

use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company\Company;
use App\Models\Stall\StallUser;
use App\Models\Stall\StallLayout;
use Illuminate\Support\Facades\DB;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use App\Models\EventCategory\EventSubCategory;
use App\Http\Requests\Backend\Stall\StallRequest;
use App\Http\Resources\Backend\Stall\StallResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StallController extends Controller
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
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Stall::where('company_id', $companyId)->orderBy('id', 'desc')->paginate($dataSorting):Stall::where('company_id', $companyId)->where(function($query) use($search){
            $query->orWhere('stall_name', 'LIKE', "%{$search}%")
            ->orWhere('brand_name', 'LIKE', "%{$search}%")
            ->orWhere('manufacturer_name', 'LIKE', "%{$search}%")
            ->orWhere('open_time', 'LIKE', "%{$search}%")
            ->orWhere('close_time', 'LIKE', "%{$search}%")
            ->orWhere('stall_brochure', 'LIKE', "%{$search}%")
            ->orWhere('stall_description', 'LIKE', "%{$search}%")
            ->orWhere('stall_live_boardcust', 'LIKE', "%{$search}%")
            ->orWhere('stall_announcement', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $eventSubCategories = EventSubCategory::where('id', $event_sub_category_id)->select('id', 'event_sub_category_name')->get();
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $companyName = Company::where('id', $companyId)->select('id', 'company_name')->get();
        $stallLayout = StallLayout::where('company_id', $companyId)->select('id', 'layout_name')->get();
        $stall = Stall::where('company_id', $companyId)->get();

        return StallResource::collection($data)->additional([
            'eventSubCategories' => $eventSubCategories , 
            'companyName' => $companyName,
            'stallLayout' => $stallLayout,
            'stall' => $stall
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StallRequest $request
     * @return StallResource
     */
    public function store(StallRequest $request)
    {
        
        DB::beginTransaction();

        $input = $request->all();

        $input['created_by'] = Auth::id();

        $stall = Stall::create($input);

        StallUser::where('user_id', Auth::user()->id)->update([
            'stall_id' => $stall->id
        ]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Stall has been created!'
        ]);  
        
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return StallResource
     */
    public function show(int $id): StallResource
    {
        $stall = Stall::findOrFail($id);
        return new StallResource($stall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StallRequest $request
     * @param int $id
     * @return StallResource
     */
    public function update(StallRequest $request, int $id)
    {
        DB::beginTransaction();

        $input = $request->all();
        $input['created_by'] = Auth::id();

        $stall = Stall::find($id)->update($input);

        StallUser::where('user_id', Auth::user()->id)->update([
            'stall_id' => $id
        ]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Stall has been updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return StallResource
     */
    public function destroy(int $id): StallResource
    {
        $stall = Stall::findOrFail($id);
        if ($stall->delete()){
            return response()->json([
                'status' => 'success',
                'message' => 'Stall has been deleted!'
            ]); 
        }
    }
}
