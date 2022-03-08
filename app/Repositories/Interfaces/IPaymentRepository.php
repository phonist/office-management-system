<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Payment;

interface IPaymentRepository
{
    public function all();
    public function getByOrder($order_id);
    public function storeByOrder(Request $request,$file_name);
    public function getOrderTotalPaid($order_id);
    public function storeByPurchase(Request $request, $file_name);
    public function getPurchaseTotalPaid($purchase_id);
    public function show(Payment $payment);
    public function updateByOrder(Request $request, Payment $payment, $file_name);
    public function updateByPurchase(Request $request, Payment $payment, $file_name);
    public function getByPurchaseId($purchase_id);
    public function getByOrderId($order_id);
    public function edit(Payment $payment);
    public function destroy(Payment $payment);
}