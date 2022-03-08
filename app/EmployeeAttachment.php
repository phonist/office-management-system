<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeAttachment extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'name',
        'description',
        'added_by',
        'employee_id'
    ];
}
