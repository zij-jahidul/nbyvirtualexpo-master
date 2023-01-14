<?php

namespace App\Http\Controllers\API\Backend\Company;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use App\Models\Stall\StallUser;
use Illuminate\Support\Facades\DB;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use App\Models\EventCategory\EventSubCategory;
use App\Http\Resources\Backend\Company\CompanyUserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyUserController extends Controller
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
        $data =$search == 'false'?CompanyUser::orderBy('id', 'desc')->paginate($dataSorting):CompanyUser::where(function($query) use($search){
            $query->orWhere('user_id', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $company = Company::select('id', 'company_name')->get();    
        $user = User::select('id', 'name', 'email', 'role')->where('role', 'Company')->get();

        $eventSubCategory = EventSubCategory::select('id', 'event_sub_category_name')->get();
        
        return CompanyUserResource::collection($data)->additional(
            [
              'companies'           => $company,
              'users'                => $user,
              'event_subcategories' => $eventSubCategory
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyUserRequest $request
     * @return CompanyUserResource
     */
    public function store(Request $request)
    {
       $this->validate($request,[
           'company_id' => 'required',
           'user_id' => 'required'
       ]);
       
        $data = $request->all();
       
        DB::beginTransaction();
        $company_user = CompanyUser::create($data);
        
        StallUser::where('user_id', $request->user_id)->update([
            'company_id' => $request->company_id
        ]);

        DB::commit();
       
        if ($company_user){
            return response()->json([
                'status' => 'success',
                'message' => 'company_user has been created!'
            ]);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CompanyUserResource
     */
    public function show(int $id): CompanyUserResource
    {
        
        $company_user = CompanyUser::findOrFail($id);
        return new CompanyUserResource($company_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyUserRequest $request
     * @param int $id
     * @return CompanyUserResource
     */
    public function update(Request $request, int $id)
    {
        return $request->all();
        $company_user = CompanyUser::findOrFail($id)->update($request->all());

        StallUser::where('user_id', $request->user_id)->update([
            'company_id' => $request->company_id
        ]);
       
        if ($company_user){
            return response()->json([
                'status' => 'success',
                'message' => 'company_user has been updated!'
            ]);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return CompanyUserResource
     */
    public function destroy(int $id)
    {
        $company_user = CompanyUser::findOrFail($id);
        if ($company_user->delete()){
            return response()->json([
                'status' => 'danger',
                'message' => 'company user has been deleted!'
            ]);
        }
       
    }
}
