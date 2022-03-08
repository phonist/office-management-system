<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class PayGrade extends Model
{
    use UseUuid;
    //
    protected $fillable=[
        'name',
        'minimum',
        'maximum'
    ];
}
