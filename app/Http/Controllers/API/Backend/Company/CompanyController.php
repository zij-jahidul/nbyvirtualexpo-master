<?php

namespace App\Http\Controllers\API\Backend\Company;

use Auth;
use Helper;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use App\Models\Stall\StallUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EventCategory\EventSubCategory;
use App\Http\Requests\Backend\Company\CompanyRequest;
use App\Http\Resources\Backend\Company\CompanyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        //Company
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Company::orderBy('id', 'desc')->paginate($dataSorting):Company::where(function($query) use($search){
            $query->orWhere('company_name', 'LIKE', "%{$search}%")
            ->orWhere('company_expire_date', 'LIKE', "%{$search}%")
            ->orWhere('company_description', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $eventSubCategories = EventSubCategory::select('id', 'event_sub_category_name')->get();
        return CompanyResource::collection($data)->additional([
            'eventSubCategories' => $eventSubCategories ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return CompanyResource
     */
    public function store(CompanyRequest $request)
    {
        //Company

        $validated = $request->validated();

        $fileName = Helper::imgProcess($request,'company_img',$request->company_name, '', 'frontend/assets/company', 'store', Company::class);

        $data = $request->all();

        $data['company_img'] = $fileName;

        DB::beginTransaction();
        
        $company = Company::create($data);

        DB::commit();

        if ($company){
            return response()->json([
                'status' => 'success',
                'message' => 'Company has been created!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param   int $id
     * @return CompanyResource
     */
    public function show(int $id)
    {
        //Company
        $company = company::findOrFail($id);
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $request
     * @param   int $id
     * @return CompanyResource
     */
    public function update(CompanyRequest $request, int $id)
    {
        $fileName = Helper::imgProcess($request,'company_img',$request->company_name, '', 'frontend/assets/company', 'update', Company::class);

        $data = $request->all();

        $data['company_img'] = $fileName;

        $company = Company::findOrFail($id)->update($data);

        if ($company){
            return response()->json([
                'status' => 'success',
                'message' => 'Company has been updated!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return CompanyResource
     */
    public function destroy(int $id)
    {
        $company = company::findOrFail($id);
        if ($company->delete()){
            return response()->json([
                'status' => 'danger',
                'message' => 'Company has been deleted!'
            ]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function get_company_details(int $id) :JsonResponse
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
    }
}
