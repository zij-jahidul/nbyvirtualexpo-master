<?php

namespace App\Http\Controllers\API\Frontend\Order;

use App\Http\Controllers\API\Frontend\Invoice\InvoiceController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Order\OrderResource;
use App\Models\Cart\Cart;
use App\Models\Charge\Charge;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\Models\Product\Product;
use App\Models\ShippingAddress\ShippingAddress;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index():AnonymousResourceCollection
    {
        $order = Order::with('orderDetails', 'invoice')->where('customer_id', Auth::user()->id)->latest()->get();
        $user = User::findOrFail(Auth::user()->id);
        return OrderResource::collection($order)->additional(['user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if($request->shipping_address_id){
            $shipping_address_id = $request->shipping_address_id;
        }else{
            $this->validate($request, [
                'address'   =>  'required|max:199',
                'district'  => 'required',
                'phone'     => 'required|digits:11',
            ]);
            $data = $request->except('shipping_address_id');
            $data['user_id'] = Auth::user()->id;
            $shipping = ShippingAddress::create($data);
            $shipping_address_id = $shipping->id;
        }

        $carts = Cart::where('customer_id', Auth::user()->id)->get(); //takes cart data from cart table using user id
        $total_quantity =0;
        $total_price = 0;
        foreach ($carts as $cart){
            $product = Product::findOrFail($cart->product_id); //get every single product for calculation
            if ($product->offer_price != null){
                $total_price += $product->offer_price * $cart->quantity;
            }else{
                $total_price += $product->selling_price * $cart->quantity;
            }
            $total_quantity+= $cart->quantity;
        }
        $stall_id = $carts->first()->stall_id;
        $charges = Charge::where('stall_id', $stall_id)->first();

        if($charges->shipping_cost != 0 && $charges->shipping_cost !=null) {
            $shipping_cost = $charges->shipping_cost;
            $total_price += (float) $charges->shipping_cost;
         }
        else{
            $shipping_cost = 0;
        }
        if($charges->offer != 0 && $charges->offer!=null){
            $offer =  (  $total_price * (float) $charges->offer) / 100;
            $total_price -= $offer;
        }
        else{
                $offer = 0;
        }
        if($charges->tax_cost!=0 && $charges->tax_cost!=null){
            $tax_cost = $total_price * $charges->tax_cost / 100;
            $total_price +=  $tax_cost;
        }
        else{
            $tax_cost = 0;
        }


//order place start
        $order_data['shipping_cost']=  $shipping_cost;
        $order_data['offer']=  $offer;
        $order_data['tax_cost']=  $tax_cost;
        $order_data['quantity']=  $total_quantity;
        $order_data['amount']=  $total_price;
        $order_data['customer_id']=  Auth::user()->id;
        $order_data['order_status']=  '0';
        $order_data['status']=  '0';
        $order_data['shipping_address_id']=  $shipping_address_id;
        $order_data['shipping_address']=  'null';
        $order_data['order_number']=   'NYB-'.rand(100000,999999);
        $order_data['stall_id']=  $carts->first()->stall_id ;
        $order = Order::create($order_data);
//order place end
//generate Invoice
        (new InvoiceController)->store($order);

//order details starts
        foreach ($carts as $cart){
            $product = Product::findOrFail($cart->product_id);
            $order_product_data['color'] = $product->color;
            $order_product_data['product_name'] = $product->product_name;
            $order_product_data['order_id'] = $order->id;
            if ($product->offer_price != null){
                $order_product_data['price'] = $product->offer_price;
            }else{
                $order_product_data['price'] = $product->selling_price;
            }
            $order_product_data['product_id'] = $product->id;
            $order_product_data['quantity'] = $cart->quantity;
            $order_product_data['size'] = $cart->size;
            // $order_product_data->except(['product_name']);
            OrderDetail::create($order_product_data);
        }
//delete cart items
        foreach ($carts as $cart){
            $cart->delete();
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Order Placed Successfully!',
            'icon'    => 'check',
            'order-number'    => $order->order_number,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OrderResource
     */
    public function show(int $id): OrderResource
    {
        $order = Order::with('orderDetails', 'user', 'user.shippingAddress', 'shipping', 'invoice')->findOrFail($id);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return JsonResponse
     */
    public function get_order_number(): JsonResponse
    {
        $order = Order::where('customer_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        return response()->json($order);
    }
}
