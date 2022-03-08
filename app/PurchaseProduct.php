<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inventory;
use App\Http\Traits\UseUuid;
use App\Purchase;
use App\Vendor;

class PurchaseProduct extends Model
{
    use UseUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'inventory_id',
        'description',
        'quantity',
        'rate',
        'amount',
        'receive',
        'return',
        'receiver',
        'purchase_id',
        'created_at',
        'updated_at'
    ];

    public function inventory($inventory_id){
        return Inventory::select('name')->where('id',$inventory_id)->first()->name;
    }

    public function getPurchaseCode($purchase_id){
        return Purchase::select('invoice_number')->where('id',$purchase_id)->first()->invoice_number;
    }

    public function getVendor($purchase_id){
        return Vendor::where('id',Purchase::where('id',$purchase_id)->first()->vendor_id)->first()->name;
    }
}
