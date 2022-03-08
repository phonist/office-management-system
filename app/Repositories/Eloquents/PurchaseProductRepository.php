<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPurchaseProductRepository;
use App\PurchaseProduct;
use Auth;

class PurchaseProductRepository implements IPurchaseProductRepository
{
    protected $purchaseProducts;

    public function __construct(PurchaseProduct $purchaseProducts){
        $this->purchaseProducts = $purchaseProducts;
    }

    public function store($id, $desc, $qty, $rate, $amt, $purchase_id){
        $purchaseProducts = new PurchaseProduct;
        $purchaseProducts->inventory_id = $id;
        $purchaseProducts->description = $desc;
        $purchaseProducts->quantity = $qty;
        $purchaseProducts->rate = $rate;
        $purchaseProducts->amount = $amt;
        $purchaseProducts->purchase_id = $purchase_id;
        return ['result'=>$purchaseProducts->save(),'id'=>$purchaseProducts->id];
    }

    public function getByPurchaseId($purchase_id){
        return $this->purchaseProducts->where('purchase_id',$purchase_id)->get();
    }

    public function getQuantity($purchase_product_id){
        return $this->purchaseProducts->select('quantity','receive')->where('id',$purchase_product_id)->get();
    }

    public function updateReceive($purchaseId,$purchase_prod_id,$qty,$purchaseQty){
        $result = $this->purchaseProducts->where('purchase_id',$purchaseId)
        ->where('id',$purchase_prod_id)
        ->update([
            'receive' => $qty + $purchaseQty,
            'receiver' => Auth::user()->name
        ]);
        return ['result'=>true];
    }

    public function updateReturn($purchaseId, $purchase_prod_id,$return,$purchaseQty){
        $purchaseProds = PurchaseProduct::where('purchase_id',$purchaseId)
        ->where('id',$purchase_prod_id)
        ->update([
            'return' => $return +  $purchaseQty
        ]);
        return ['result'=>true];
    }

    public function all(){
        return $this->purchaseProducts->leftjoin('purchases','purchase_products.purchase_id','purchases.id')
                                    ->leftjoin('vendors','purchases.vendor_id','vendors.id')
                                    ->where('vendors.user_id',Auth::user()->id)
                                    ->orderBy('purchase_products.created_at','asc')
                                    ->get();
    }
}