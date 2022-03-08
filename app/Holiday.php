<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class Holiday extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'name',
        'description',
        'start',
        'end',
        'user_id'
    ];
}
