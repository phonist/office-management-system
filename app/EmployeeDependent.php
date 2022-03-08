<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeDependent extends Model
{
    use UseUuid;
    
    protected $fillable=[
        'name',
        'relationship',
        'dob',
        'employee_id'
    ];
}
