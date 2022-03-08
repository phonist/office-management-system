<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class EmployeeTermination extends Model
{
    use UseUuid;
    protected $fillable = [
        'employee_id',
        'date',
        'reason',
        'note',
    ];
}
