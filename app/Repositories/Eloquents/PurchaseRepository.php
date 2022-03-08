<?php

namespace App\Repositories\Eloquents;

use App\Purchase;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPurchaseRepository;
use App\Vendor;
use Auth;

class PurchaseRepository implements IPurchaseRepository
{
    protected $purchases;

    public function __construct(Purchase $purchases){
        $this->purchases = $purchases;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->purchases
                    ->leftjoin('vendors','purchases.vendor_id','vendors.id')
                    ->addSelect([
                    'vendor'=> Vendor::select('name')->whereColumn('id','purchases.vendor_id')])
                    ->where('vendors.user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }

    public function getPurchaseTotal($purchase_id){
        return $this->purchases->select('g_total')->where('id',$purchase_id)->get();
    }

    public function updatePaid($purchase_id,$total, $balance){
        $purchase = $this->purchases->find($purchase_id);
        $purchase->paid = $total;
        $purchase->balance = $balance;
        return $purchase->save();
    }

    public function getById($purchase_id){
        return $this->purchases->find($purchase_id);
    }

    public function store(Request $request){
        $purchase = $this->purchases;
        $purchase->invoice_number = $request->invoice_number;
        $purchase->vendor_id = $request->vendorId;
        $purchase->b_reference = $request->b_reference;
        $purchase->status = 'pending_received';
        $purchase->note = $request->order_note;
        $purchase->total = $request->total;
        $purchase->discount = $request->discount;
        $purchase->tax = $request->tax;
        $purchase->transport = $request->transport;
        $purchase->g_total = $request->g_total;
        $purchase->paid = 0;
        $purchase->balance = 0;
        return [
            'result'=>$purchase->save(),
            'id'=>$purchase->id
        ];
    }

    public function show(Purchase $purchase){
        return $this->purchases->where('id',$purchase->id)->get();
    }

    public function destroy(Purchase $purchase){
        $purchase = $this->purchases->find($purchase->id);
        return $purchase->delete();
    }

    public function updateStatus($purchase_id, $status){
        $result = $this->purchases->select('status')->where('id',$purchase_id)
        ->update([
            'status' => $status,
        ]);
        return $result;
    }
}