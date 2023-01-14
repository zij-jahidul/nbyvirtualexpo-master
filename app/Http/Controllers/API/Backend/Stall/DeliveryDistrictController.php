<?php

namespace App\Http\Controllers\API\Backend\Stall;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyUser;
use App\Models\District\District;
use App\Models\Stall\Stall;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Auth;

class DeliveryDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       $districts= District::orderBy('name', 'asc')->get();
       return response()->json($districts);
    }
    public function get_delivery_stall()
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $stallId = Stall::with('delivery_district')->where('company_id', $companyId)->get();
        return response()->json($stallId);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $stall = Stall::findOrFail($request->stall_id);
            $stall->delivery_district()->sync($request->district_id);
            return response()->json([
                'status'  => 'success',
                'message' => 'Delivery District Saved Successfully',
                'icon'    => 'check',
            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'status'  => 'cancel',
                'message' => 'Please Select Stall',
                'icon'    => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $stall = Stall::with('delivery_district')->findOrFail($id);
            $district = [];
            foreach ($stall->delivery_district as $dist){
                $district[] = $dist->id;
            }
            return response()->json($district);
        }
        catch (ModelNotFoundException $e){
            return response()->json(['msg'=>'Please Select Stall']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
