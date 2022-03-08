<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class Tax extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'name',
        'rate',
        'type',
    ];
}
