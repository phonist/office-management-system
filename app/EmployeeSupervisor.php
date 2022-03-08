<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class EmployeeSupervisor extends Model
{
    use UseUuid;
    
    protected $fillable=[
        'department_id',
        'supervisor_id',
        'employee_id'
    ];
}
