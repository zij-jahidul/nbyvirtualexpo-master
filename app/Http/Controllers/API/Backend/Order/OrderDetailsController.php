<?php

namespace App\Http\Controllers\API\Backend\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderDetailsRequest;
use App\Http\Resources\Backend\Order\OrderDetailsResource;
use App\Models\Order\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
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
        $data =$search == 'false'?OrderDetail::orderBy('id', 'desc')->paginate($dataSorting):OrderDetail::where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('doctor_id', 'LIKE', "%{$search}%")
            ->orWhere('mobile_no', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('birth_day', 'LIKE', "%{$search}%")
            ->orWhere('m_day', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);


        return OrderDetailsResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderDetailsRequest $request)
    {
        $OrderDetail = OrderDetail::insert($request->all());
       
        if ($OrderDetail){
            return response()->json([
                'status' => 'success',
                'message' => 'OrderDetail has been created!'
            ]);
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = OrderDetail::findOrFail($id);
        return new OrderDetailsResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderDetailsRequest $request, $id)
    {
        $order = OrderDetail::findOrFail($id)->update($request->all());
       
        if ($order){
            return response()->json([
                'status' => 'success',
                'message' => 'OrderDetail has been updated!'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = OrderDetail::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'OrderDetail has been deleted!',
                'icon'    => 'times',
            ]);   
        }
       
    }
}
