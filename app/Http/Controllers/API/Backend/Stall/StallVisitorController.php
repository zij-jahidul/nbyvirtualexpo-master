<?php

namespace App\Http\Controllers\API\Backend\Stall;

use App\Http\Controllers\Controller;
use App\Http\Requests\StallVisitorRequest;
use App\Http\Resources\Backend\Stall\StallVisitorResource;
use App\Models\Stall\StallVisitor;
use Illuminate\Http\Request;

class StallVisitorController extends Controller
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
        $data =$search == 'false'?StallVisitor::orderBy('id', 'desc')->paginate($dataSorting):StallVisitor::where(function($query) use($search){
            $query->orWhere('stall_id', 'LIKE', "%{$search}%")
            ->orWhere('customer_id', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

    
        return StallVisitorResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StallVisitorRequest $request)
    {
        $visitor = StallVisitor::create($request->all());
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
        $visitor = StallVisitor::findOrFail($id);
        return response()->json($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StallVisitorRequest $request, $id)
    {
        $visitor = StallVisitor::findOrFail($id);
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
        $visitor = StallVisitor::findOrFail($id);
        return response()->json($visitor);
    }
}
