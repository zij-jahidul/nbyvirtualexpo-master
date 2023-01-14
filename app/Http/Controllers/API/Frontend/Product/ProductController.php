<?php

namespace App\Http\Controllers\API\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Stall\StallResource;
use App\Http\Resources\Frontend\Product\ProductResource;
use App\Models\Product\Product;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *(
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        // return $request->all();
        $products = Product::where('company_id', $request->company_id)->where('stall_id', $request->stall_id)->paginate(15);
        return ProductResource::collection($products);
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


    public function show(int $id): ProductResource
    {
        $product = Product::with('image', 'category', 'subCategory', 'stall')->findOrFail($id);
        return new ProductResource($product);
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
