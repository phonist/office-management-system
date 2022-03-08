<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeStatus extends Model
{
    //
    use UseUuid;
    
    protected $fillable = [
        'status'
    ];
}
