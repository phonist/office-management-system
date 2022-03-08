<?php

namespace App\Http\Controllers;

use App\Payment;
use Session;
use Carbon\Carbon;
use App\Purchase;
use App\PurchaseProduct;
use App\Vendor;
use App\Order;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Services\OrderService;
use App\Services\PurchaseService;

class PaymentController extends Controller
{
    protected $payments;
    protected $orders;
    protected $purchases;

    public function __construct(
        PaymentService $payments, 
        OrderService $orders,
        PurchaseService $purchases
    ){
        $this->payments = $payments;
        $this->orders = $orders;
        $this->purchases = $purchases;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function add(Request $request){
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_name = $this->payments->attachFile($request);
        if(isset($request->invoiceId)){
            $result = $this->payments->storeByOrder($request, $file_name);
            if($result['result']){
                $total_paid = $this->payments->getOrderTotalPaid($result['order_id']);
                $total_of_purchase = $this->orders->getOrderTotal($result['order_id']);
                if(!empty($total_paid)){
                    $total = 0;
                    foreach($total_paid as $paid){
                        $total += $paid->received_amt;             
                    }
                    $balance = $total_of_purchase[0]['g_total'] - $total;
                    $this->orders->updatePaid($result['order_id'], $total, $balance);
                }
                Session::flash('success', 'Payment added!');
            }else{
                Session::flash('failure', 'Something went wrong');
            }
            return redirect()->route('orders.show',$result['order_id']);
        }else{
            //to be modify
            $result = $this->payments->storeByPurchase($request, $file_name);
            if($result['result']){
                $total_paid = $this->payments->getPurchaseTotalPaid($result['purchase_id']);
                $total_of_purchase = $this->purchases->getPurchaseTotal($result['purchase_id']);
                if(!empty($total_paid)){
                    $total = 0;
                    foreach($total_paid as $paid){
                        $total += $paid->received_amt;             
                    }
                    $balance = $total_of_purchase[0]['g_total'] - $total;
                    $this->purchases->updatePaid($result['purchase_id'],$total, $balance);
                }
                Session::flash('success', 'Payment added!');
            }else{
                Session::flash('failure', 'Something went wrong');
            }
            return redirect()->route('purchases.show',$request->purchaseId);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     * 
     */
    public function show(Payment $payment)
    {
        $result = $this->payments->show($payment);
        return response()->json([
            'payment'=>$result['payment'],
            'purchase'=>$result['purchase'],
            'invoice'=>$result['invoice']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        // return response()->json($payment);
        return $this->payments->edit($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $total = 0;
        $file_name = $this->payments->attachFile($request);
        
        if(isset($payment->purchase_id)){
            $result = $this->payments->updateByPurchase($request, $payment, $file_name);
            $payments = $this->payments->getByPurchaseId($result['purchase_id']);
            foreach($payments as $payment){
                $total += $payment->received_amt;
            }
            $purchase = $this->purchases->getById($result['purchase_id']);
            $updatePurchase = $this->purchases->updatePaid($result['purchase_id'],$total, $purchase[0]['g_total'] - $total);
            if($updatePurchase){
                Session::flash('success', 'Payment Updated!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            return redirect()->route('purchases.show',$payment->purchase_id);
        }else{
            $result = $this->payments->updateByOrder($request, $payment, $file_name);
            $payments = $this->payments->getByOrderId($result['order_id']);
            foreach($payments as $payment){
                $total += $payment->received_amt;
            }
            $order = $this->orders->getById($result['order_id']);
            $updateOrder = $this->orders->updatePaid($result['order_id'],$total, $order['g_total'] - $total);
            if($updateOrder){
                Session::flash('success', 'Payment Updated!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            return redirect()->route('orders.show',$payment->order_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if(isset($payment->purchase_id)){
            $purchase = $this->purchases->getById($payment->purchase_id);
            $updatePurchase = $this->purchases->updatePaid(
                $payment->purchase_id,
                $purchase['paid']-$payment->received_amt, 
                $purchase['balance']+$payment->received_amt
            );
            $result = $this->payments->destroy($payment);
            if($result){
                Session::flash('success', 'Payment Data Deleted!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            
            return redirect()->route('purchases.show',$payment->purchase_id);
        }else{
            $order = $this->orders->getById($payment->order_id);
            $updateOrder = $this->orders->updatePaid(
                $payment->order_id,
                $order['paid']-$payment->received_amt,
                $order['balance']+$payment->received_amt
            );
            $result = $this->payments->destroy($payment);
            if($result){
                Session::flash('success', 'Payment Data Deleted!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            // return response()->json('helo');
            return redirect()->route('orders.show',$payment->order_id);
        }
    }
}
