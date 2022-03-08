<?php

namespace App\Repositories\Eloquents;

use App\QuotationProduct;
use App\Repositories\Interfaces\IQuotationProductRepository;
use Auth;

class QuotationProductRepository implements IQuotationProductRepository{
    protected $quotationProducts;

    public function __construct(QuotationProduct $quotationProducts){
        $this->quotationProducts = $quotationProducts;
    }

    public function store($id, $desc, $qty, $rate, $amt, $quotation_id){
        $quotationProduct = $this->quotationProducts;
        $quotationProduct->inventory_id = $id;
        $quotationProduct->description = $desc;
        $quotationProduct->quantity = $qty;
        $quotationProduct->rate = $rate;
        $quotationProduct->amount = $amt;
        $quotationProduct->quotation_id = $quotation_id;
        return [
            'result'=>$quotationProduct->save(),
            'quotationProduct'=>$quotationProduct
        ];
    }

    public function getByQuotationId($quotation_id){
        return $this->quotationProducts->where('quotation_id',$quotation_id)->get();
    }

    public function update($id, $desc, $qty, $rate, $amt, $quotation_id){
        // $quotationProduct = QuotationProduct::where('quotation_id',$quotation_id)->where('inventory_id',$id);
        //issue here
        $id = $this->quotationProducts->select('id')
                                    ->where('quotation_id',$quotation_id)
                                    ->where('inventory_id',$id)
                                    ->first();
        //issue here
        $quotationProduct = $this->quotationProducts->find($quotationProductId);
        $quotationProduct->description = $desc;
        $quotationProduct->quantity = $qty;
        $quotationProduct->rate = $rate;
        $quotationProduct->amount = $amt;
        return [
            'result'=>$quotationProduct->save(),
            'quotationProduct'=>$quotationProduct
        ];
    }

    public function updateOrCreate($id, $desc, $qty, $rate, $amt, $quotation_id){
        $this->quotationProducts->updateOrCreate(
            ['quotation_id'=>$quotation_id, 'inventory_id'=> $id],
            ['description'=> $desc , 'quantity'=>$qty, 'rate'=>$rate,'amount'=>$amt]
        );
        return true;
    }

    public function destroy($id){
        $remove = $this->quotationProducts->find($id);
        return [
            'result' => $remove->delete()
        ];
    }
}