<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class WorkShift extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'name',
        'from',
        'to'
    ];
}
