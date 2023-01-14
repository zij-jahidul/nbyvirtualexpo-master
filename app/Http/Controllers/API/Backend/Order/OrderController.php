<?php

namespace App\Http\Controllers\API\Backend\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\Backend\Order\OrderResource;
use App\Models\Company\CompanyUser;
use App\Models\Order\Order;
use App\Models\Stall\Stall;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Auth;
class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        //$companyId = CompanyUser::select('company_id')->where('user_id', Auth::user()->id)->first();

        $stallId = Stall::where('company_id', $companyId)->first()->id;

        //$stallId = Stall::select('id')->where('company_id', $companyId)->first();
        $search = $request->search;
        $dataSorting = $request->sorting === 'false'?10:$request->sorting;
        $data =$search == 'false'?Order::with('user')->where('stall_id', $stallId)->orderBy('id', 'desc')->paginate($dataSorting):Order::where('stall_id', $stallId)->where(function($query) use($search){
            $query->orWhere('order_number', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);
        return OrderResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(OrderRequest $request)
    {
        $Order = Order::insert($request->all());

        if ($Order){
            return response()->json([
                'status' => 'success',
                'message' => 'Order has been created!'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OrderResource
     */
    public function show($id)
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $stallId = Stall::where('company_id', $companyId)->first()->id;

        $order = Order::with('orderDetails', 'user', 'user.shippingAddress', 'shipping', 'invoice')->where('stall_id', $stallId)->where('id', $id)->first();
        return   new OrderResource($order);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(OrderRequest $request, $id)
    {
        $Order = Order::findOrFail($id)->update($request->all());

        if ($Order){
            return response()->json([
                'status' => 'success',
                'message' => 'Order has been updated!'
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $delete = Order::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Order has been deleted!',
                'icon'    => 'times',
            ]);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update_order_status(Request $request, int $id):JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json([
            'status'  => 'success',
            'message' => 'Order Status Updated Successfully!',
            'icon'    => 'times',
        ]);
    }
}
