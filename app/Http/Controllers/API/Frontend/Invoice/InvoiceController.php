<?php

namespace App\Http\Controllers\API\Frontend\Invoice;

use App\Models\Invoice\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * @param $order
     */
    public function store($order)
    {
        $invoice['order_id']= $order->id;
        $invoice['user_id']= Auth::user()->id;
        $invoice['invoice_number']=  'NYB-'.rand(100000,999999);
        $invoice['status']= 1;
        Invoice::create($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(int $id):JsonResponse
    {
       $invoice = Invoice::with('order', 'order.stall', 'order.stall.company', 'order.orderDetails', 'order.shipping','user')->where('id', $id)->where('user_id', Auth::user()->id)->first();
       return response()->json($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Invoice  $invoice
     * @return Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Invoice  $invoice
     * @return Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Invoice  $invoice
     * @return Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
