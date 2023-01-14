<?php

namespace App\Http\Controllers\API\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Product\ProductAttributeResource;
use App\Models\Product\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
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
        $data =$search == 'false'?ProductAttribute::orderBy('id', 'desc')->paginate($dataSorting):ProductAttribute::where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('doctor_id', 'LIKE', "%{$search}%")
            ->orWhere('mobile_no', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('birth_day', 'LIKE', "%{$search}%")
            ->orWhere('m_day', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return ProductAttributeResource::collection($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ProductAttribute = ProductAttribute::insert($request->all());
       
        if ($ProductAttribute){
            return response()->json([
                'status' => 'success',
                'message' => 'ProductAttribute has been created!'
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
        $ProductAttribute = ProductAttribute::findOrFail($id);
        return new ProductAttributeResource($ProductAttribute);
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
        $ProductAttribute = ProductAttribute::findOrFail($id)->update($request->all());
       
        if ($ProductAttribute){
            return response()->json([
                'status' => 'success',
                'message' => 'ProductAttribute has been updated!'
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
        $delete = ProductAttribute::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'ProductAttribute has been deleted!',
                'icon'    => 'times',
            ]);   
        }
        
    }
}
