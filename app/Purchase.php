<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Purchase;
use App\Quotation;
use Carbon\Carbon;
use App\Http\Traits\UseUuid;
class Purchase extends Model
{
    use UseUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'b_reference',
        'status',
        'note',
        'total',
        'discount',
        'tax',
        'transport',
        'g_total',
        'paid',
        'balance'
    ];

    public function product(){
        return $this->belongsTo('App\Inventory');
    }

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }

    public function vendor($id){
        return Vendor::where('id',Purchase::where('id',$id)->first()->vendor_id)->first()->name;
    }
}
