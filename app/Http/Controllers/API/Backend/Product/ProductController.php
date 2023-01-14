<?php

namespace App\Http\Controllers\API\Backend\Product;

use Helper;
use Auth;
use App\Models\Company\CompanyUser;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductImage;
use App\Models\ProductCategory\ProductCategory;
use App\Models\ProductCategory\ProductSubCategory;
use App\Http\Requests\Backend\Product\ProductRequest;
use App\Http\Resources\Backend\Product\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        //$companyId = CompanyUser::select('company_id')->where('user_id', Auth::user()->id)->first();

       $stallId = Stall::where('company_id', $companyId)->first()->id;
        //$stallId = Stall::select('id')->where('company_id', $companyId)->first();

        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Product::where('stall_id', $stallId)->orderBy('id', 'desc')->paginate($dataSorting):Product::where('stall_id', $stallId)->where(function($query) use($search){
            $query->orWhere('product_name', 'LIKE', "%{$search}%")
            ->orWhere('product_code', 'LIKE', "%{$search}%")
            ->orWhere('product_img', 'LIKE', "%{$search}%")
            ->orWhere('color', 'LIKE', "%{$search}%")
            ->orWhere('size', 'LIKE', "%{$search}%")
            ->orWhere('cost_price', 'LIKE', "%{$search}%")
            ->orWhere('selling_price', 'LIKE', "%{$search}%")
            ->orWhere('wholesale_price', 'LIKE', "%{$search}%")
            ->orWhere('offer_price', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $productCategories = ProductCategory::where('company_id', $companyId)->get();
        $productSubCategories = ProductSubCategory::all();
        $stalls = Stall::where('company_id', $companyId)->get();
        return ProductResource::collection($data)->additional([
            'stalls' => $stalls,
            'productCategories' => $productCategories,
            'productSubCategories' => $productSubCategories
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *

     * @param ProductRequest $request
     * @return ProductResource
     */
    public function store(ProductRequest $request)
    {

        $validated = $request->validated();

        $fileName = Helper::imgProcess($request,'image',$request->product_name, '', 'frontend/assets/product-images', 'store', Product::class);
        $product_feature_image = Helper::imgProcess($request,'product_img',$request->product_name, '', 'frontend/assets/product-images', 'store', ProductImage::class);


        $data = $request->except(['image', 'product_img']);


        $data['company_id'] =  CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $data['product_img'] = $product_feature_image;
        $product = Product::create($data);

        foreach ($fileName as $key => $image) {

            $fileName[$key]['product_id'] = $product->id;

        }

        ProductImage::insert($fileName);


        if ($product){
            return response()->json([
                'status' => 'success',
                'icon' => 'check',
                'message' => 'Product has been created!'
            ]);
        }
    }


    /**
     * Display the specified resource.
     *

     * @param int $id
     * @return ProductResource
     */
    public function show(int $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *

     * @param ProductResource $request
     * @param int $id
     * @return ProductResource
     */
    public function update(Request $request, $id)
    {

        $fileName = Helper::imgProcess($request,'product_img',$request->product_name, $id, 'frontend/assets/product-images', 'update', Product::class);

        $data = $request->all();
        $data['product_img'] = $fileName;
        $product = Product::findOrFail($id)->update($data);

         if ($product){
             return response()->json([
                 'status' => 'success',
                 'message' => 'Product has been updated!'
             ]);
         }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ProductResource
     */
    public function destroy($id, Request $request)
    {
        // $delete = Product::find($id)->delete();
        // if($delete){
        //     return response()->json([
        //         'status'  => 'danger',
        //         'message' => 'Product has been deleted!',
        //         'icon'    => 'times',
        //     ]);
        // }



        if($request->optional_id == 'undefined'){

            $delete = Product::find($id)->delete();
            $message = 'Product has been deleted!';
            $images = ProductImage::where('product_id', $id)->get();

            foreach ($images as $key => $image) {

                if(!empty($image)){

                    $path = 'frontend/assets/product-images/'.$image->image;
                    unlink($path);

                    $delete = ProductImage::find($image->id)->delete();
                }


            }

        } else {

            $message = 'Image has been deleted';
            $image = ProductImage::find($request->optional_id)->image;

            $path = 'frontend/assets/product-images/'.$image;

            unlink($path);
            $delete = ProductImage::where('product_id', $id)->where('id', $request->optional_id)->delete();
        }

        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => $message,
                'icon'    => 'times',
            ]);
        }

    }
}
