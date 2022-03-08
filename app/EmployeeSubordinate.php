<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeSubordinate extends Model
{
    use UseUuid;
    
    protected $fillable=[
        'department_id',
        'subordinate_id',
        'employee_id'
    ];
}
