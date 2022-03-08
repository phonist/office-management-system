<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeDeposit extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'account_name',
        'number',
        'bank_name',
        'note',
        'employee_id'
    ];
}
