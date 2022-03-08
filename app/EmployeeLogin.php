<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeLogin extends Model
{
    use UseUuid;
    
    protected $fillable=[
        'name',
        'password',
        'active',
        'employee_id'
    ];
}
