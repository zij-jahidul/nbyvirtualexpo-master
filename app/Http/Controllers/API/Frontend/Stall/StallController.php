<?php

namespace App\Http\Controllers\API\Frontend\Stall;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Stall\StallResource;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;

class StallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Auth::user();
        $stall_list = $request->category_id == 0 ? Stall::where('status' , 1)->paginate(15) : Stall::where('event_sub_category_id',$request->category_id)->where('status' , 1)->paginate(15);
        return StallResource::collection($stall_list);
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
