<?php

namespace App\Http\Controllers\API\Backend\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\Backend\Cart\CartResource;
use App\Models\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
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
        $data =$search == 'false'?Cart::orderBy('id', 'desc')->paginate($dataSorting):Cart::where(function($query) use($search){
            $query->orWhere('stall_id', 'LIKE', "%{$search}%")
            ->orWhere('customer_id', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return CartResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $cart = Cart::insert($request->all());
        return response()->json([
            'status'  => 'success',
            'message' => 'Cart has been created!',
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
        $cart = Cart::findOrFail($id);
        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $id)
    {
        $data = $request->all();
        $data = Cart::find($id)->update($data); 

        return response()->json([
            'status'  => 'success',
            'message' => 'Cart has been updated!',
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
        $delete = Cart::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Cart has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
