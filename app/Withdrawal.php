<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class Withdrawal extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'inventory_id',
        'w_quantity',
        'withdrawer',
        'project_id',
    ];
}
