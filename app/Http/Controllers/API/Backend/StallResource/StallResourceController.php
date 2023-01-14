<?php

namespace App\Http\Controllers\API\Backend\StallResource;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\StallResource\StallResourceResource;
use App\Models\Company\CompanyUser;
use App\Models\Stall\Stall;
use App\Models\StallResource\StallResource;
use Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StallResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        //$companyId = CompanyUser::select('company_id')->where('user_id', Auth::user()->id)->first();

        $stallId = Stall::where('company_id', $companyId)->first()->id;
        //$stallId = Stall::select('id')->where('company_id', $companyId)->first();

        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?StallResource::where('stall_id', $stallId)->orderBy('id', 'desc')->paginate($dataSorting):StallResource::where('stall_id', $stallId)->where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);
        $stalls = Stall::select('id', 'stall_name')->where('company_id', $companyId)->get();
        return StallResourceResource::collection($data)->additional(['stalls' => $stalls,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $fileName = Helper::imgProcess($request,'resource_file_name',$request->name, '', 'frontend/assets/resource', 'store', StallResource::class);
        $data= $request->except(['resource_file_name']);
        $data['resource_file_name']= $fileName;
        StallResource::create($data);
        return response()->json([
            'status' => 'success',
            'icon' => 'check',
            'message' => 'Stall Resource has been created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return StallResourceResource
     */
    public function show($id)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        //$companyId = CompanyUser::select('company_id')->where('user_id', Auth::user()->id)->first();

        $stallId = Stall::where('company_id', $companyId)->first()->id;
        //$stallId = Stall::select('id')->where('company_id', $companyId)->first();

        $stall_resource = StallResource::where('id', $id)->where('stall_id', $stallId)->first();
        return new StallResourceResource($stall_resource);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id):JsonResponse
    {
        $fileName = Helper::imgProcess($request,'resource_file_name',$request->name, $id, 'frontend/assets/resource', 'update', StallResource::class);
        $data= $request->except(['resource_file_name']);
        $data['resource_file_name']= $fileName;

        $stall_resource = StallResource::findOrFail($id);
        $stall_resource->update($data);
        return response()->json([
            'status' => 'success',
            'icon' => 'check',
            'message' => 'Stall Resource has been Updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id):JsonResponse
    {
       $stall_resource = StallResource::findOrFail($id);
        $stall_resource->delete();
        return response()->json([
            'status' => 'success',
            'icon' => 'check',
            'message' => 'Stall Resource has been Deleted!'
        ]);
    }

    /**
     * @param int $id
     * @return BinaryFileResponse
     */
    public function download_resource(int $id): BinaryFileResponse
    {
        $stall_resource = StallResource::findOrFail($id);
        $headers = array('Content-Type: application/pdf',);
        return Response::download(public_path('/frontend/assets/resource').'/'.$stall_resource->resource_file_name, str_replace(' ', '-',$stall_resource->name).'.pdf', $headers);
    }
}
