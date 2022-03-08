<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class WorkingDay extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'day',
        'work',
        'user_id'
    ];
}
