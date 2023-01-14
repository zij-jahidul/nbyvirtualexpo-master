<?php

namespace App\Http\Controllers\API\Backend\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitorPointRequest;
use App\Http\Resources\Backend\Visitor\VisitorPointResource;
use App\Models\Visitor\VisitorPoint;
use Illuminate\Http\Request;

class VisitorPointController extends Controller
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
        $data =$search == 'false'?VisitorPoint::orderBy('id', 'desc')->paginate($dataSorting):VisitorPoint::where(function($query) use($search){
            $query->orWhere('visitor_point_distribution_id', 'LIKE', "%{$search}%")
            ->orWhere('customer_id', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        
        return VisitorPointResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorPointRequest $request)
    {
        $visitor = VisitorPoint::insert($request->all());
        return response()->json([
            'status'  => 'success',
            'message' => 'VisitorPoint has been created!',
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
        $visitor = VisitorPoint::findOrFail($id);
        return response()->json($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorPointRequest $request, $id)
    {
        $visitor = VisitorPoint::findOrFail($id);
        $visitor->fill($request->all())->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'VisitorPoint has been created!',
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
        $delete = VisitorPoint::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'VisitorPoint has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
