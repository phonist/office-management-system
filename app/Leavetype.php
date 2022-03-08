<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class LeaveType extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'name',
        'user_id'
    ];
}
