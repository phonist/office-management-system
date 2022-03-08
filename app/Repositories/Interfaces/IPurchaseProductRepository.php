<?php

namespace App\Repositories\Interfaces;

interface IPurchaseProductRepository{
    public function store($id, $desc, $qty, $rate, $amt, $purchase_id);
    public function getByPurchaseId($purchase_id);
    public function getQuantity($purchase_product_id);
    public function updateReceive($purchaseId,$purchase_prod_id,$qty,$purchaseQty);
    public function updateReturn($purchaseId, $purchase_prod_id,$return,$purchaseQty);
    public function all();
}