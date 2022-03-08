<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class SalaryComponent extends Model
{
    //
    use UseUuid;
    
    protected $fillable = [
        'component_name',
        'type',
        'total_payable',
        'cost_company',
        'value_type'
    ];
}
