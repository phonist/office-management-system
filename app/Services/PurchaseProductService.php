<?php

namespace App\Services;

use App\Repositories\Interfaces\IPurchaseProductRepository;
use Illuminate\Http\Request;
use App\PurchaseProduct;
use App\Exports\PurchaseProductExport;
use App\Repositories\Interfaces\IInventoryRepository;
use App\Repositories\Interfaces\IPurchaseRepository;

class PurchaseProductService{
    protected $purchaseProducts;
    protected $inventories;

    public function __construct(
        IPurchaseProductRepository $purchaseProducts,
        IInventoryRepository $inventories,
        IPurchaseRepository $purchases
    ){
        $this->purchaseProducts = $purchaseProducts;
        $this->inventories = $inventories;
        $this->purchases = $purchases;
    }

    public function getByPurchaseId($purchase_id){
        $this->purchaseProducts->getByPurchaseId($purchase_id);
    }

    public function updateReceivedAmt(Request $request){
        $total_received = 0;
        $total_quantity = 0;
        for($i = 0; $i< count($request->qty); $i++){
            // $purchaseQty = PurchaseProduct::select('quantity','receive')->where('id',(int)$request->purchase_prod_id[$i])->get();
            $purchaseQty = $this->purchaseProducts->getQuantity((int)$request->purchase_prod_id[$i]);

            $total_received += (int)$request->qty[$i];
            $total_quantity += $purchaseQty[0]['quantity'];

            $purchaesProds = $this->purchaseProducts->updateReceive(
                $request->purchaseId, 
                (int)$request->purchase_prod_id[$i],
                (int)$request->qty[$i],
                (int)$purchaseQty[0]['receive']
            );
        }

        if($total_received < $total_quantity && $total_received > 0){
            $status = "partial_received";
        }else if($total_received == $total_quantity){
            $status = "received";
        }else{
            $status = "pending_received";
        }
        $updateStatus = $this->purchases->updateStatus($request->purchaseId, $status);
        return ['result'=>true];
    }

    public function updateReturnAmt($request){
        $total_returned = 0;
        $total_quantity = 0;
        for($i=0;$i<count($request->return);$i++){
            $purchaseQty = $this->purchaseProducts->getQuantity((int)$request->purchase_prod_id[$i]);
            $total_returned += (int)$request->return[$i];
            $total_quantity += $purchaseQty[0]['quantity'];
            $purchaesProds = $this->purchaseProducts->updateReturn(
                $request->purchaseId, 
                (int)$request->purchase_prod_id[$i],
                (int)$request->return[$i],
                (int)$purchaseQty[0]['return']
            );
        }
        if($total_returned < $total_quantity && $total_returned > 0){
            $status = "partial_received";
        }else if($total_returned == $total_quantity){
            $status = "return_purchase";
        }else{
            $status = "pending_received";
        }
        $updateStatus = $this->purchases->updateStatus($request->purchaseId, $status);
        return ['result'=>true];
    }
    public function export(){
        return (new PurchaseProductExport)->download('receive.csv');
    }

    public function getName($id){
        return $this->inventories->getNameById($id);
    }

    public function all(){
        $purchases = $this->purchases->all();
        $purchaseproducts = $this->purchaseProducts->all();
        return [
            'purchases'=>$purchases,
            'purchaseproducts'=>$purchaseproducts
        ];
    }

    public function store($request){
        foreach($request->data_items as $purchase_item){
            $this->purchaseProducts->store(
                $purchase_item[0], 
                $purchase_item[1], 
                $purchase_item[2], 
                $purchase_item[3], 
                $purchase_item[4], 
                $purchase_item[5]
            );
        }
        return ['result'=>true];
    }
}