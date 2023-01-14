<?php

namespace App\Http\Controllers\API\Backend\ProductCategory;

use Auth;
use Helper;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Category\ProductCategoryResource;
use App\Models\ProductCategory\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?ProductCategory::where('company_id', $companyId)->orderBy('id', 'desc')->paginate($dataSorting):ProductCategory::where('company_id', $companyId)->where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('doctor_id', 'LIKE', "%{$search}%")
            ->orWhere('mobile_no', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('birth_day', 'LIKE', "%{$search}%")
            ->orWhere('m_day', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        return ProductCategoryResource::collection($data);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ProductCategory = ProductCategory::findOrFail($id);
        return new ProductCategoryResource($ProductCategory);
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
        $ProductCategory = ProductCategory::findOrFail($id)->update($request->all());
       
        if ($ProductCategory){
            return response()->json([
                'status' => 'success',
                'message' => 'ProductCategory has been updated!'
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
