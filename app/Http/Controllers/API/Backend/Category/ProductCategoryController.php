<?php

namespace App\Http\Controllers\API\Backend\Category;

use Auth;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory\ProductCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Backend\Category\ProductCategoryResource;
use App\Http\Requests\Backend\ProductCategory\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?ProductCategory::orderBy('id', 'desc')->paginate($dataSorting):ProductCategory::where(function($query) use($search){
            $query->orWhere('category_name', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);
      
       return ProductCategoryResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCategoryRequest $request
     * @return ProductCategoryResource
     */
    public function store(Request $request)
    {
       
       
        //  $validated = $request->validate();

         $fileName = Helper::imgProcess($request,'cat_img',$request->category_name, '', 'frontend/assets/product-category', 'store', ProductCategory::class);  

        $data = $request->all();

         $user_id = Auth::user()->id;

        $data['cat_img'] = $fileName;

        $data['company_id'] = CompanyUser::where('user_id', $user_id)->first()->company_id;


        $ProductCategory = ProductCategory::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Product category has been created!',
            'icon'    => 'times',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ProductCategoryResource
     */
    public function show($id)
    {
        $product_category = ProductCategory::findOrFail($id);
        return new ProductCategoryResource($product_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductCategoryRequest $request
     * @param int $id
     * @return ProductCategoryResource
     */
    public function update(Request $request, int $id)
    {
        $fileName = Helper::imgProcess($request,'cat_img',$request->category_name, $id, 'frontend/assets/product-category', 'update', ProductCategory::class);  

        $data = $request->all();

        $data['cat_img'] = $fileName;


        $data = ProductCategory::find($id)->update($data); 

        return response()->json([
            'status'  => 'success',
            'message' => 'ProductCategory has been updated!',
            'icon'    => 'times',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ProductCategoryResource
     */
    public function destroy(int $id)
    {
        $delete = ProductCategory::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'ProductCategory has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
