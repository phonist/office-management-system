<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmergencyContact extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'name',
        'relationship',
        'home_tel',
        'mobile',
        'work_tel',
        'employee_id',
    ];
}
