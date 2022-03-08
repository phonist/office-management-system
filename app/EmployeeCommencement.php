<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeCommencement extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'join_date',
        'probation_end',
        'dop',
        'employee_id'
    ];
}
