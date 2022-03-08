<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class SaleProduct extends Model
{
    use UseUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'description',
        'quantity',
        'rate',
        'amount',
        'invoice_id',
        'created_at',
        'updated_at'
    ];
}
