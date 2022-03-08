<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class JobTitle extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'title',
        'description'
    ];
}
