<?php

namespace App\Http\Controllers\API\Backend\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitorPointDistributionRequest;
use App\Http\Resources\Backend\Visitor\VisitorPointDistributionResource;
use App\Models\Visitor\VisitorPointDistribution;
use Illuminate\Http\Request;

class VisitorPointDistributionController extends Controller
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
        $data =$search == 'false'?VisitorPointDistribution::orderBy('id', 'desc')->paginate($dataSorting):VisitorPointDistribution::where(function($query) use($search){
            $query->orWhere('slug_name', 'LIKE', "%{$search}%")
            ->orWhere('point', 'LIKE', "%{$search}%");
           
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return VisitorPointDistributionResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorPointDistributionRequest $request)
    {
        $visitor = VisitorPointDistribution::insert($request->all());
        return response()->json([
            'status'  => 'success',
            'message' => 'VisitorPointDistribution has been created!',
            'icon'    => 'times',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = VisitorPointDistribution::findOrFail($id);
        return response()->json($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorPointDistributionRequest $request, $id)
    {
        $visitor = VisitorPointDistribution::findOrFail($id);
        $visitor->fill($request->all())->save();
        return response()->json([
            'status'  => 'success',
            'message' => 'VisitorPointDistribution has been updated!',
            'icon'    => 'times',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = VisitorPointDistribution::findOrFail($id);
        return response()->json($visitor);
    }
}
