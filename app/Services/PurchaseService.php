<?php

namespace App\Services;

use App\Repositories\Interfaces\IPurchaseRepository;
use App\Repositories\Interfaces\IPaymentRepository;
use App\Repositories\Interfaces\IVendorRepository;
use App\Repositories\Interfaces\IInventoryRepository;
use App\Repositories\Interfaces\IPurchaseProductRepository;
use Illuminate\Http\Request;
use App\Purchase;
use Auth;
use App\Exports\PurchasesExport;
use App\Services\BaseService;

class PurchaseService extends BaseService{
    protected $purchases;
    protected $payments;
    protected $vendors;
    protected $inventories;
    protected $purchaseProducts;

    public function __construct(
        IPurchaseRepository $purchases,
        IPaymentRepository $payments,
        IVendorRepository $vendors,
        IInventoryRepository $inventories,
        IPurchaseProductRepository $purchaseProducts
    ){
        $this->purchases = $purchases;
        $this->payments = $payments;
        $this->vendors = $vendors;
        $this->inventories = $inventories;
        $this->purchaseProducts = $purchaseProducts;
    }

    public function getPurchaseTotal($purchase_id){
        return $this->purchases->getPurchaseTotal($purchase_id);
    }

    public function updatePaid($purchase_id,$total, $balance){
        return $this->purchases->updatePaid($purchase_id,$total, $balance);
    }

    public function getById($purchase_id){
        return $this->purchases->getById($purchase_id);
    }

    public function all(){
        $purchases = $this->purchases->all();
        $payments = $this->payments->all();
        $vendor = $this->vendors->all(Auth::user()->id);
        return ['purchases'=>$purchases,'payments'=>$payments,'vendor'=>$vendor];
    }

    public function create(){
        $vendors = $this->vendors->all(Auth::user()->id);
        $inventories = $this->inventories->all();
        return ['vendors'=>$vendors, 'inventories'=>$inventories];
    }

    public function store(Request $request, $inventories){
        $latest = Purchase::latest()->first();
        $request->invoice_number = $this->invoiceNumber($latest, 'PUR');
        $purchases = $this->purchases->store($request);
        for($i=0;$i<$inventories['count'];$i++){
            $purchaseProducts = $this->purchaseProducts->store(
                $inventories['id'][$i],
                $inventories['desc'][$i],
                $inventories['qty'][$i],
                $inventories['rate'][$i],
                $inventories['amt'][$i],
                $purchases['id']
            );
        }
        return ['result'=>true,'id'=>$purchases['id']];
    }

    public function show(Purchase $purchase){
        $purchases = $this->purchases->show($purchase);
        $purchase_products = $this->purchaseProducts->getByPurchaseId($purchase->id);
        $vendor = $this->vendors->getById($purchase->vendor_id);
        $payments = $this->payments->getByPurchaseId($purchase->id);
        return [
            'purchases'=>$purchases,
            'purchase_products'=>$purchase_products,
            'vendor'=>$vendor,
            'payments'=>$payments
        ];
    }

    public function edit(Purchase $purchase){
        $purchases = $this->purchases->getById($purchase->id);
        $purchaseProducts = $this->purchaseProducts->getByPurchaseId($purchase->id);
        return [
            'purchases'=>$purchases,
            'purchaseProducts'=>$purchaseProducts
        ];
    }

    public function export(){
        return (new PurchasesExport)->download('purchases.csv');
    }

    public function destroy(Purchase $purchase){
        return $this->purchases->destroy($purchase);
    }
}