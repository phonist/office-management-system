<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class RoleUser extends Model
{
    use UseUuid;
    public $timestamps = false;
    protected $table = 'role_user';

    protected $fillable = [
        'role_id',
        'user_id'
    ];
}
