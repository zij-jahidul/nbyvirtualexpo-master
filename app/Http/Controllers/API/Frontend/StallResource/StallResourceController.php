<?php

namespace App\Http\Controllers\API\Frontend\StallResource;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\StallResoruce\StallResourceResource;
use App\Models\Company\CompanyUser;
use App\Models\Stall\Stall;
use App\Models\StallResource\StallResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Auth;

class StallResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //$companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        //$companyId = CompanyUser::select('company_id')->where('user_id', Auth::user()->id)->first();

       // $stallId = Stall::where('company_id', $companyId)->first()->id;
        //$stallId = Stall::select('id')->where('company_id', $companyId)->first();
      
        if(isset($request->stall_id)){
            $resource = StallResource::where('stall_id', $request->stall_id)->orderBy('id', 'desc')->get();
            return  StallResourceResource::collection($resource);
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
