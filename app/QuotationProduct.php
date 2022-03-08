<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class QuotationProduct extends Model
{
    use UseUuid;
    protected $fillable = [
        'inventory_id',
        'description',
        'quantity',
        'rate',
        'amount',
        'quotation_id'
    ];
}
