<?php

namespace App\Services;

use App\Repositories\Interfaces\IPaymentRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\IPurchaseRepository;
use Illuminate\Http\Request;
use App\Payment;
use App\Order;
use App\Purchase;

class PaymentService {
    protected $payments;
    protected $purchases;
    protected $orders;

    public function __construct(
        IPaymentRepository $payments, 
        IOrderRepository $orders,
        IPurchaseRepository $purchases
    ){
        $this->payments = $payments;
        $this->orders = $orders;
        $this->purchases = $purchases;
    }

    public function all(){
        return $this->payments->all();
    }

    public function store(Request $request){
        return $this->payments->store($request);
    }

    public function attachFile(Request $request){
        if ($request->hasFile('bill')) {
            $file = $request->file('bill');
            $file_name = $file->getClientOriginalName();
            $destinationPath = public_path('/payments');
            $file->move($destinationPath, $name);
        }else{
            $file_name = "";
        }
        return $file_name;
    }

    public function storeByOrder(Request $request, $file_name){
        return $this->payments->storeByOrder($request, $file_name);
    }

    public function storeByPurchase(Request $request, $file_name){
        return $this->payments->storeByPurchase($request, $file_name);
    }

    public function getOrderTotalPaid($order_id){
        return $this->payments->getOrderTotalPaid($order_id);
    }

    public function getPurchaseTotalPaid($purchase_id){
        return $this->payments->getPurchaseTotalPaid($purchase_id);
    }

    public function show(Payment $payment){
        $payment = $this->payments->show($payment);
        $purchase = $this->purchases->getById($payment->purchase_id);
        $invoice = $this->orders->getById($payment->order_id);
        return [
            'payment'=>$payment, 
            'purchase'=>$purchase, 
            'invoice'=>$invoice
        ];
    }

    public function updateByOrder(Request $request, Payment $payment, $file_name){
        return $this->payments->updateByOrder($request, $payment, $file_name);
    }

    public function updateByPurchase(Request $request, Payment $payment, $file_name){
        return $this->payments->updateByPurchase($request, $payment, $file_name);
    }

    public function getByPurchaseId($purchase_id){
        return $this->payments->getByPurchaseId($purchase_id);
    }

    public function getByOrderId($order_id){
        return $this->payments->getByOrderId($order_id);
    }

    public function edit(Payment $payment){
        return $this->payments->edit($payment);
    }

    public function destroy(Payment $payment){
        return $this->payments->destroy($payment);
    }
}