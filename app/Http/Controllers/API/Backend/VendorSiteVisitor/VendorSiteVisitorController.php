<?php

namespace App\Http\Controllers\API\Backend\VendorSiteVisitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorSiteVisitorRequest;
use App\Http\Resources\Backend\VendorSiteVisitor\VendorSiteVisitorResource;
use App\Models\VendorSiteVisitor\VendorSiteVisitor;
use Illuminate\Http\Request;

class VendorSiteVisitorController extends Controller
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
        $data =$search == 'false'?VendorSiteVisitor::orderBy('id', 'desc')->paginate($dataSorting):VendorSiteVisitor::where(function($query) use($search){
            $query->orWhere('product_id', 'LIKE', "%{$search}%")
            ->orWhere('customer_id', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return VendorSiteVisitorResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorSiteVisitorRequest $request)
    {
        $visitor = VendorSiteVisitor::create($request->all());
        return response()->json($visitor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = VendorSiteVisitor::findOrFail($id);
        return response()->json($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorSiteVisitorRequest $request, $id)
    {
        $visitor = VendorSiteVisitor::findOrFail($id);
        $visitor->fill($request->all())->save();
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = VendorSiteVisitor::findOrFail($id);
        return response()->json($visitor);
    }
}
