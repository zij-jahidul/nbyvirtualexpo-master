<?php

namespace App\Http\Controllers\API\Backend\ProductCategory;

use Helper;
use Illuminate\Http\Request;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategory\ProductCategory;
use App\Models\ProductCategory\ProductSubCategory;
use App\Http\Resources\Backend\ProductCategory\ProductSubCategoryResource;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        // $productCategoryId = ProductCategory
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?ProductSubCategory::where('company_id', $companyId)->orderBy('id', 'desc')->paginate($dataSorting):ProductSubCategory::where('company_id', $companyId)->where(function($query) use($search){
            $query->orWhere('sub_category_name', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);
        
        $productcategory = ProductCategory::where('company_id', $companyId)->get();
        return ProductSubCategoryResource::collection($data)->additional(['productcategory' => $productcategory]);
    }


    public function getSubCategory(Request $request)
    {
        // return $request->product_id;

        $subCategory = ProductSubCategory::where('product_category_id', $request->product_id)->select('id', 'sub_category_name')->first();

        return response()->json([$subCategory]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $fileName = Helper::imgProcess($request,'sub_cat_img ',$request->sub_category_name ,'', 'frontend/assets/product-sub-category', 'store', ProductSubCategory::class);  
         Auth::user()->id;
        
        $data = $request->all();
        $data['sub_cat_img'] = $fileName;
        $data['company_id'] = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $data['created_by'] = Auth::user()->id;
 

        
        $ProductSubCategory = ProductSubCategory::create($data);
       
        if ($ProductSubCategory){
            return response()->json([
                'status' => 'success',
                'message' => 'ProductSubCategory has been created!'
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
        $ProductSubCategory = ProductSubCategory::findOrFail($id);
        return new ProductSubCategoryResource($ProductSubCategory);
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
        
        $fileName = Helper::imgProcess($request,'sub_cat_img ',$request->sub_category_name ,'', 'frontend/assets/product-sub-category', 'store', ProductSubCategory::class);  
         
        
        $data = $request->all();
        $data['sub_cat_img'] = $fileName;
        $data['company_id'] = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $data['updated_by'] = Auth::user()->id;

        $ProductSubCategory = ProductSubCategory::findOrFail($id)->update($data);
       
        if ($ProductSubCategory){
            return response()->json([
                'status' => 'success',
                'icon' => 'check',
                'message' => 'ProductSubCategory has been updated!'
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
        $delete = ProductSubCategory::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'ProductSubCategory has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
