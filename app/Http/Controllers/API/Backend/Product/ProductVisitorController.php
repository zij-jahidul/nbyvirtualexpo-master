<?php

namespace App\Http\Controllers\API\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVisitorRequest;
use App\Http\Resources\Backend\Product\ProductVisitorResource;
use App\Models\Product\ProductVisitor;
use Illuminate\Http\Request;

class ProductVisitorController extends Controller
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
        $data =$search == 'false'?ProductVisitor::orderBy('id', 'desc')->paginate($dataSorting):ProductVisitor::where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('doctor_id', 'LIKE', "%{$search}%")
            ->orWhere('mobile_no', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('birth_day', 'LIKE', "%{$search}%")
            ->orWhere('m_day', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        
        return ProductVisitorResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductVisitorRequest $request)
    { 
        $ProductVisitor = ProductVisitor::insert($request->all());
       
        if ($ProductVisitor){
            return response()->json([
                'status' => 'success',
                'message' => 'ProductVisitor has been created!'
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
        $visitor = ProductVisitor::findOrFail($id);
        return new ProductVisitorResource($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductVisitorRequest $request, $id)
    {
        $visitor = ProductVisitor::findOrFail($id)->update($request->all());
       
        if ($visitor){
            return response()->json([
                'status' => 'success',
                'message' => 'visitor has been updated!'
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

        $delete = ProductVisitor::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'ProductVisitor has been deleted!',
                'icon'    => 'times',
            ]);   
        }
        
        
    }
}
