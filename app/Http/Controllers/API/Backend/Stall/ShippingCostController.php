<?php

namespace App\Http\Controllers\API\Backend\Stall;

use App\Http\Controllers\Controller;
use App\Models\Charge\Charge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShippingCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipping_cost = Charge::where('stall_id', $request->stall_id)->first();
        if ($shipping_cost){
            $shipping_cost->update($request->all());
        }else{
            Charge::create($request->all());
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Charges Saved Successfully',
            'icon'    => 'check',
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param   $id
     * @return JsonResponse
     */
    public function show($id):JsonResponse
    {
        $shipping_cost = Charge::where('stall_id', $id)->first();
        if ($shipping_cost){
            return response()->json($shipping_cost);
        }
        return response()->json(['msg'=>'notFound']);
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
