<?php

namespace App\Repositories\Eloquents;

use App\Payment;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Response;
use File;
use Session;
use Excel;
use DB;
use App\Repositories\Interfaces\IPaymentRepository;
use Carbon\Carbon;

class PaymentRepository implements IPaymentRepository
{
    protected $payments;

    public function __construct(Payment $payments){
        $this->payments = $payments;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->payments->get();
    }

    public function getByOrder($order_id){
        return $this->payments->where('order_id',$order_id)->get();
    }
    
    public function storeByOrder(Request $request, $file_name){
        $payment = $this->payments;
        $payment->date = Carbon::parse($request->payment_date)->format('Y-m-d');
        $payment->reference_no = $request->order_ref;
        $payment->received_amt = $request->amount;
        $payment->attachment = $file_name;
        $payment->payment_method = $request->payment_method;
        $payment->cc_name = $request->cc_namel;
        $payment->cc_number = $request->cc_number;
        $payment->cc_type = $request->cc_type;
        $payment->cc_month = $request->cc_month;
        $payment->cc_year = $request->cc_year;
        $payment->cvc = $request->cvc;
        $payment->payment_ref = $request->payment_ref;
        $payment->order_id = $request->invoiceId;
        return [
            'result'=>$payment->save(),
            'order_id'=>$payment->order_id
        ];
    }

    public function storeByPurchase(Request $request, $file_name){
        $payment = $this->payments;
        $payment->date = Carbon::parse($request->payment_date)->format('Y-m-d');
        $payment->reference_no = $request->order_ref;
        $payment->received_amt = $request->amount;
        $payment->attachment = $file_name;
        $payment->payment_method = $request->payment_method;
        $payment->cc_name = $request->cc_namel;
        $payment->cc_number = $request->cc_number;
        $payment->cc_type = $request->cc_type;
        $payment->cc_month = $request->cc_month;
        $payment->cc_year = $request->cc_year;
        $payment->cvc = $request->cvc;
        $payment->payment_ref = $request->payment_ref;
        $payment->purchase_id = $request->purchaseId;
        return [
            'result'=>$payment->save(),
            'purchase_id'=>$payment->purchase_id
        ];
    }
    
    public function getOrderTotalPaid($order_id){
        return $this->payments->select('received_amt')->where('order_id',$order_id)->get();
    }

    public function getPurchaseTotalPaid($purchase_id){
        return $this->payments->select('received_amt')->where('purchase_id',$purchase_id)->get();
    }

    public function show(Payment $payment){
        return $payment;
    }

    public function updateByOrder(Request $request, Payment $payment, $file_name){
        $payment = $this->payments->find($payment->id);
        $payment->date = Carbon::parse($request->payment_date)->format('Y-m-d');
        $payment->reference_no = $request->order_ref;
        $payment->received_amt = $request->amount;
        $payment->attachment = $file_name;
        $payment->payment_method = $request->payment_method;
        $payment->cc_name = $request->cc_namel;
        $payment->cc_number = $request->cc_number;
        $payment->cc_type = $request->cc_type;
        $payment->cc_month = $request->cc_month;
        $payment->cc_year = $request->cc_year;
        $payment->cvc = $request->cvc;
        return [
            'result'=>$payment->save(),
            'order_id'=>$payment->order_id
        ];
    }

    public function updateByPurchase(Request $request, Payment $payment, $file_name){
        $payment = $this->payments->find($payment->id);
        $payment->date = Carbon::parse($request->payment_date)->format('Y-m-d');
        $payment->reference_no = $request->order_ref;
        $payment->received_amt = $request->amount;
        $payment->attachment = $file_name;
        $payment->payment_method = $request->payment_method;
        $payment->cc_name = $request->cc_namel;
        $payment->cc_number = $request->cc_number;
        $payment->cc_type = $request->cc_type;
        $payment->cc_month = $request->cc_month;
        $payment->cc_year = $request->cc_year;
        $payment->cvc = $request->cvc;
        return [
            'result'=>$payment->save(),
            'purchase_id'=>$payment->purchase_id
        ];
    }

    public function getByPurchaseId($purchase_id){
        return $this->payments->where('purchase_id',$purchase_id)->get();
    }

    public function getByOrderId($order_id){
        return $this->payments->where('order_id',$order_id)->get();
    }

    public function edit(Payment $payment){
        return $payment;
    }

    public function destroy(Payment $payment){
        $payment = $this->payments->find($payment->id);
        return $payment->delete();
    }
}